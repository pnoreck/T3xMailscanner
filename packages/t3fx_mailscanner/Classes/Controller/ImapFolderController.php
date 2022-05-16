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
 * ImapFolderController
 */
class ImapFolderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $imapFolders = $this->imapFolderRepository->findAll();
        $this->view->assign('imapFolders', $imapFolders);
    }
    
    /**
     * action delete
     *
     * @param \T3fx\T3fxMailscanner\Domain\Model\ImapFolder $imapFolder
     * @return void
     */
    public function deleteAction(\T3fx\T3fxMailscanner\Domain\Model\ImapFolder $imapFolder)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->imapFolderRepository->remove($imapFolder);
        $this->redirect('list');
    }

}