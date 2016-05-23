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

/**
 * MailScannerController
 */
class MailScannerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * mailScannerRepository
     *
     * @var \T3fx\T3fxMailscanner\Domain\Repository\SenderRepository
     * @inject
     */
    protected $senderRepository = NULL;

    /**
     * imapFolderRepository
     *
     * @var \T3fx\T3fxMailscanner\Domain\Repository\ImapFolderRepository
     * @inject
     */
    protected $imapFolderRepository = NULL;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $senders = $this->senderRepository->findAll();
        $this->view->assign('senders', $senders);
    }
    
    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        
    }
    
    /**
     * action create
     *
     * @param \T3fx\T3fxMailscanner\Domain\Model\MailScanner $newMailScanner
     * @return void
     */
    public function createAction(\T3fx\T3fxMailscanner\Domain\Model\MailScanner $newMailScanner)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->mailScannerRepository->add($newMailScanner);
        $this->redirect('list');
    }
    
    /**
     * action edit
     *
     * @param \T3fx\T3fxMailscanner\Domain\Model\Sender $sender
     * @return void
     */
    public function editAction(\T3fx\T3fxMailscanner\Domain\Model\Sender $sender)
    {
        $this->view->assign('sender', $sender);

        $imapFolders = $this->imapFolderRepository->findAll();
        $this->view->assign('imapFolders', $imapFolders);
    }
    
    /**
     * action update
     *
     * @param \T3fx\T3fxMailscanner\Domain\Model\MailScanner $mailScanner
     * @return void
     */
    public function updateAction(\T3fx\T3fxMailscanner\Domain\Model\MailScanner $mailScanner)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->mailScannerRepository->update($mailScanner);
        $this->redirect('list');
    }
    
    /**
     * action delete
     *
     * @param \T3fx\T3fxMailscanner\Domain\Model\MailScanner $mailScanner
     * @return void
     */
    public function deleteAction(\T3fx\T3fxMailscanner\Domain\Model\MailScanner $mailScanner)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->mailScannerRepository->remove($mailScanner);
        $this->redirect('list');
    }

}