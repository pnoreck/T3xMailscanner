<?php
/*
 * Copyright 2023 - Steffen Hastädt
 *
 * info@t3x.ch | www.t3x.ch
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace T3x\T3xMailscanner\Controller\Backend;

use Psr\Http\Message\ResponseInterface;
use T3x\T3xMailscanner\Domain\Model\Blacklist;
use T3x\T3xMailscanner\Domain\Model\Sender;
use T3x\T3xMailscanner\Domain\Repository\BlacklistRepository;
use T3x\T3xMailscanner\Domain\Repository\ImapFolderRepository;
use T3x\T3xMailscanner\Domain\Repository\SenderRepository;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;

/**
 * MailScannerController
 */
final class MailScannerController extends ActionController
{

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        protected readonly SenderRepository $senderRepository,
        protected readonly ImapFolderRepository $imapFolderRepository,
        protected readonly BlacklistRepository $blacklistRepository
    ) {
    }

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->view->assign('folders', $folder);

        // $senders = $this->senderRepository->findAll();
        // $this->view->assign( 'senders', $senders );

        return $this->returnRequest();
    }

    /**
     * @return ResponseInterface
     */
    public function returnRequest(): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        // Adding title, menus, buttons, etc. using $moduleTemplate ...
        $moduleTemplate->setContent($this->view->render());
        return $this->htmlResponse($moduleTemplate->renderContent());
    }

    /**
     * @param int $folderUid
     *
     * @return ResponseInterface
     */
    public function listByFolderAction(int $folderUid = 0): ResponseInterface
    {
        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->view->assign('folders', $folder);

        $senders = $this->senderRepository->findSenderByFolder($folderUid);
        $this->view->assign('senders', $senders);

        $this->setLastFolderUid($folderUid);

        return $this->returnRequest();
    }

    /**
     * Set the last IMAP folder uid
     *
     * @param int $folderUid
     *
     * @return void
     */
    protected function setLastFolderUid(int $folderUid): void
    {
        $GLOBALS['TSFE']->fe_user->setKey('ses', 'lastFolderUid', $folderUid);
    }

    /**
     * @param int $folderUid
     *
     * @return ResponseInterface
     */
    public function updateListAction(int $folderUid = 0): ResponseInterface
    {
        $senders = $this->senderRepository->findSenderByFolder($folderUid);

        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->view->assign('folders', $folder);
        $this->view->assign('senders', $senders);

        return $this->returnRequest();
    }

    /**
     * action new
     *
     * @return ResponseInterface
     */
    public function newAction(): ResponseInterface
    {
        $this->assignImapFolder();
        return $this->returnRequest();
    }

    /**
     * Assign all ImapFolders to the view
     */
    private function assignImapFolder(): void
    {
        $imapFolders = $this->imapFolderRepository->findAll();
        $this->view->assign('imapFolders', $imapFolders);
    }

    /**
     * action create
     *
     * @param Sender $newSender
     *
     * @return void
     */
    public function createAction(Sender $newSender): void
    {
        $sender = $this->senderRepository->findSenderByEmail($newSender->getName());
        if ($sender->count() > 0) {
            $this->addFlashMessage(
                'Absender existiert bereits',
                '',
                ContextualFeedbackSeverity::WARNING
            );
            $this->redirect('list');
        }

        $this->addFlashMessage('Absender wurde hinzugefügt');
        $this->senderRepository->add($newSender);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param Sender $sender
     *
     * @return ResponseInterface
     */
    public function editAction(Sender $sender): ResponseInterface
    {
        $this->view->assign('sender', $sender);
        $this->assignImapFolder();
        return $this->returnRequest();
    }

    /**
     * action update
     *
     * @param Sender $sender
     * @param bool   $blacklist
     * @param bool   $wholeDomain
     *
     * @return void
     */
    public function updateAction(Sender $sender, $blacklist, $wholeDomain)
    {
        if ($blacklist) {
            $mail    = $sender->getName();
            $blocked = new Blacklist();
            if ($wholeDomain) {
                $mail = explode('@', $mail);
                $blocked->setDomain($mail[1]);
                $blocked->setWholeDomain(true);
                $sameSenders = $this->senderRepository->findSenderByDomain($mail[1]);
                if ($sameSenders) {
                    foreach ($sameSenders as $sameSender) {
                        $this->senderRepository->remove($sameSender);
                    }
                }
            } else {
                $blocked->setMail($mail);
            }

            $this->blacklistRepository->add($blocked);
            $this->senderRepository->remove($sender);
        }

        $this->addFlashMessage('Absender wurde aktualisiert', '', ContextualFeedbackSeverity::OK);
        $this->senderRepository->update($sender);
        $lastFolderUid = $this->getLastFolderUid();
        if ($lastFolderUid > 0) {
            $this->redirect('listByFolder', null, null, ['folderUid' => $lastFolderUid]);
        } else {
            $this->redirect('list');
        }
    }

    /**
     * Return the last IMAP folder uid
     *
     * @return int
     */
    protected function getLastFolderUid()
    {
        return (int)$GLOBALS['TSFE']->fe_user->getKey('ses', 'lastFolderUid');
    }

    /**
     * action delete
     *
     * @param Sender $sender
     *
     * @return void
     * @throws IllegalObjectTypeException
     */
    public function deleteAction(Sender $sender)
    {
        $this->addFlashMessage('Der Absender wurde gelöscht', '', ContextualFeedbackSeverity::NOTICE);
        $this->senderRepository->remove($sender);
        $this->redirect('list');
    }

}
