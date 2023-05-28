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
use T3x\T3xMailscanner\Domain\Model\ImapFolder;
use T3x\T3xMailscanner\Domain\Model\Sender;
use T3x\T3xMailscanner\Domain\Repository\BlacklistRepository;
use T3x\T3xMailscanner\Domain\Repository\ImapFolderRepository;
use T3x\T3xMailscanner\Domain\Repository\SenderRepository;
use TYPO3\CMS\Backend\Module\ModuleData;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * MailScannerController
 */
final class MailScannerController extends ActionController
{
    protected ?ModuleData $moduleData = null;
    protected ModuleTemplate $moduleTemplate;

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        protected readonly SenderRepository $senderRepository,
        protected readonly ImapFolderRepository $imapFolderRepository,
        protected readonly BlacklistRepository $blacklistRepository
    ) {
    }

    /**
     * Init module state.
     * This isn't done within __construct() since the controller
     * object is only created once in extbase when multiple actions are called in
     * one call. When those change module state, the second action would see old state.
     */
    public function initializeAction(): void
    {
        $this->moduleData = $this->request->getAttribute('moduleData');
        $this->moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $this->moduleTemplate->setTitle(LocalizationUtility::translate('LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:mlang_tabs_tab'));
        $this->moduleTemplate->setFlashMessageQueue($this->getFlashMessageQueue());
    }

    /**
     * Assign default variables to ModuleTemplate view
     */
    protected function initializeView(): void
    {
        $this->moduleTemplate->assignMultiple([
            'dateFormat' => $GLOBALS['TYPO3_CONF_VARS']['SYS']['ddmmyy'],
            'timeFormat' => $GLOBALS['TYPO3_CONF_VARS']['SYS']['hhmm'],
        ]);
    }


    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->moduleTemplate->assign('folders', $folder);

        // $senders = $this->senderRepository->findAll();
        // $this->moduleTemplate->assign( 'senders', $senders );

        return $this->moduleTemplate->renderResponse('List');
    }

    /**
     * @param int $imapFolder
     *
     * @return ResponseInterface
     */
    public function listByFolderAction(ImapFolder $imapFolder = null): ResponseInterface
    {
        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->moduleTemplate->assign('folders', $folder);

        if ($imapFolder instanceof ImapFolder) {
            $senders = $this->senderRepository->findSenderByFolder($imapFolder);
            $this->setLastFolderUid($imapFolder->getUid());
        } else {
            $senders = $this->senderRepository->findSenderWithoutFolder();
            $this->setLastFolderUid(0);
        }
        $this->moduleTemplate->assign('senders', $senders);

        return $this->moduleTemplate->renderResponse('listByFolder');
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
        if (!session_id()) {
            session_start();
        }
        $_SESSION["lastFolderUid"] = $folderUid;
    }

    /**
     * @param ImapFolder $imapFolder
     *
     * @return ResponseInterface
     */
    public function updateListAction(ImapFolder $imapFolder): ResponseInterface
    {
        $senders = $this->senderRepository->findSenderByFolder($imapFolder);

        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->moduleTemplate->assign('folders', $folder);
        $this->moduleTemplate->assign('senders', $senders);

        return $this->moduleTemplate->renderResponse('updateList');
    }

    /**
     * action new
     *
     * @return ResponseInterface
     */
    public function newAction(): ResponseInterface
    {
        $this->assignImapFolder();
        return $this->moduleTemplate->renderResponse('new');
    }

    /**
     * Assign all ImapFolders to the view
     */
    private function assignImapFolder(): void
    {
        $imapFolders = $this->imapFolderRepository->findAll();
        $this->moduleTemplate->assign('imapFolders', $imapFolders);
    }

    /**
     * action create
     *
     * @param Sender $newSender
     *
     * @return ResponseInterface
     */
    public function createAction(Sender $newSender): ResponseInterface
    {
        $sender = $this->senderRepository->findSenderByEmail($newSender->getName());
        if ($sender->count() > 0) {
            $this->addFlashMessage(
                'Absender existiert bereits',
                '',
                ContextualFeedbackSeverity::WARNING
            );
            return $this->redirect('list');
        }

        $this->addFlashMessage('Absender wurde hinzugefügt');
        $this->senderRepository->add($newSender);
        return $this->redirect('list');
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
        $this->moduleTemplate->assign('sender', $sender);
        $this->assignImapFolder();
        return $this->moduleTemplate->renderResponse('edit');
    }

    /**
     * action update
     *
     * @param Sender $sender
     * @param bool   $blacklist
     * @param bool   $wholeDomain
     *
     * @return ResponseInterface
     */
    public function updateAction(Sender $sender, $blacklist, $wholeDomain): ResponseInterface
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
            return $this->redirect('listByFolder', null, null, ['imapFolder' => $lastFolderUid]);
        } else {
            return $this->redirect('list');
        }
    }

    /**
     * Return the last IMAP folder uid
     *
     * @return int
     */
    protected function getLastFolderUid()
    {
        if (!session_id()) {
            session_start();
        }
        return $_SESSION["lastFolderUid"];
    }

    /**
     * action delete
     *
     * @param Sender $sender
     *
     * @return ResponseInterface
     * @throws IllegalObjectTypeException
     */
    public function deleteAction(Sender $sender): ResponseInterface
    {
        $this->addFlashMessage('Der Absender wurde gelöscht', '', ContextualFeedbackSeverity::NOTICE);
        $this->senderRepository->remove($sender);
        return $this->redirect('list');
    }

}
