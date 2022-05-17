<?php

namespace T3fx\T3fxMailscanner\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Steffen Hastädt <mailscanner@t3x.ch>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use T3fx\T3fxMailscanner\Domain\Model\Blacklist;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * MailScannerController
 */
class MailScannerController extends ActionController
{

    /**
     * SenderRepository
     *
     * @var \T3fx\T3fxMailscanner\Domain\Repository\SenderRepository
     * @inject
     */
    protected $senderRepository = null;

    /**
     * imapFolderRepository
     *
     * @var \T3fx\T3fxMailscanner\Domain\Repository\ImapFolderRepository
     * @inject
     */
    protected $imapFolderRepository = null;

    /**
     * BlacklistRepository
     *
     * @var \T3fx\T3fxMailscanner\Domain\Repository\BlacklistRepository
     * @inject
     */
    protected $blacklistRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->view->assign('folders', $folder);

        // $senders = $this->senderRepository->findAll();
        // $this->view->assign( 'senders', $senders );
    }

    /**
     * @param int $folderUid
     */
    public function listByFolderAction($folderUid = 0)
    {
        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->view->assign('folders', $folder);

        $senders = $this->senderRepository->findSenderByFolder($folderUid);
        $this->view->assign('senders', $senders);

        $this->setLastFolderUid($folderUid);
    }

    /**
     * Set the last IMAP folder uid
     *
     * @param int $folderUid
     *
     * @return void
     */
    protected function setLastFolderUid($folderUid)
    {
        $GLOBALS['TSFE']->fe_user->setKey('ses', 'lastFolderUid', $folderUid);
    }

    /**
     * @param int $folderUid
     */
    public function updateListAction($folderUid = 0)
    {
        $senders = $this->senderRepository->findSenderByFolder($folderUid);

        $folder = $this->imapFolderRepository->findFolderWithSender();
        $this->view->assign('folders', $folder);
        $this->view->assign('senders', $senders);

    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $this->assignImapFolder();
    }

    /**
     * Assign all ImapFolders to the view
     */
    private function assignImapFolder()
    {
        $imapFolders = $this->imapFolderRepository->findAll();
        $this->view->assign('imapFolders', $imapFolders);
    }

    /**
     * action create
     *
     * @param \T3fx\T3fxMailscanner\Domain\Model\Sender $newSender
     *
     * @return void
     */
    public function createAction(\T3fx\T3fxMailscanner\Domain\Model\Sender $newSender)
    {
        $sender = $this->senderRepository->findSenderByEmail($newSender->getName());
        if ($sender->count() > 0) {
            $this->addFlashMessage(
                'Absender existiert bereits',
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING
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
     * @param \T3fx\T3fxMailscanner\Domain\Model\Sender $sender
     *
     * @return void
     */
    public function editAction(\T3fx\T3fxMailscanner\Domain\Model\Sender $sender)
    {
        $this->view->assign('sender', $sender);
        $this->assignImapFolder();
    }

    /**
     * action update
     *
     * @param \T3fx\T3fxMailscanner\Domain\Model\Sender $sender
     * @param bool                                      $blacklist
     * @param bool                                      $wholeDomain
     *
     * @return void
     */
    public function updateAction(\T3fx\T3fxMailscanner\Domain\Model\Sender $sender, $blacklist, $wholeDomain)
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

        $this->addFlashMessage('Absender wurde aktualisiert', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
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
     * @param \T3fx\T3fxMailscanner\Domain\Model\Sender $sender
     *
     * @return void
     */
    public function deleteAction(\T3fx\T3fxMailscanner\Domain\Model\Sender $sender)
    {
        $this->addFlashMessage('Der Absender wurde gelöscht', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::NOTICE);
        $this->senderRepository->remove($sender);
        $this->redirect('list');
    }

}
