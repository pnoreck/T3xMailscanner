<?php
namespace T3fx\T3fxMailscanner\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Steffen Hastädt <mailscanner@t3x.ch>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class T3fx\T3fxMailscanner\Controller\ImapFolderController.
 *
 * @author Steffen Hastädt <mailscanner@t3x.ch>
 */
class ImapFolderControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \T3fx\T3fxMailscanner\Controller\ImapFolderController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('T3fx\\T3fxMailscanner\\Controller\\ImapFolderController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllImapFoldersFromRepositoryAndAssignsThemToView()
	{

		$allImapFolders = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$imapFolderRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$imapFolderRepository->expects($this->once())->method('findAll')->will($this->returnValue($allImapFolders));
		$this->inject($this->subject, 'imapFolderRepository', $imapFolderRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('imapFolders', $allImapFolders);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenImapFolderFromImapFolderRepository()
	{
		$imapFolder = new \T3fx\T3fxMailscanner\Domain\Model\ImapFolder();

		$imapFolderRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$imapFolderRepository->expects($this->once())->method('remove')->with($imapFolder);
		$this->inject($this->subject, 'imapFolderRepository', $imapFolderRepository);

		$this->subject->deleteAction($imapFolder);
	}
}
