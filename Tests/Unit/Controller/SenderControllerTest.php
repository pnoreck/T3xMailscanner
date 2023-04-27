<?php
namespace T3x\T3xMailscanner\Tests\Unit\Controller;
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
 * Test case for class T3x\T3xMailscanner\Controller\SenderController.
 *
 * @author Steffen Hastädt <mailscanner@t3x.ch>
 */
class SenderControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \T3x\T3xMailscanner\Controller\SenderController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('T3x\\T3xMailscanner\\Controller\\SenderController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllSendersFromRepositoryAndAssignsThemToView()
	{

		$allSenders = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$senderRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$senderRepository->expects($this->once())->method('findAll')->will($this->returnValue($allSenders));
		$this->inject($this->subject, 'senderRepository', $senderRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('senders', $allSenders);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenSenderToView()
	{
		$sender = new \T3x\T3xMailscanner\Domain\Model\Sender();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('sender', $sender);

		$this->subject->showAction($sender);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenSenderToSenderRepository()
	{
		$sender = new \T3x\T3fxMailscanner\Domain\Model\Sender();

		$senderRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$senderRepository->expects($this->once())->method('add')->with($sender);
		$this->inject($this->subject, 'senderRepository', $senderRepository);

		$this->subject->createAction($sender);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenSenderToView()
	{
		$sender = new \T3fx\T3fxMailscanner\Domain\Model\Sender();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('sender', $sender);

		$this->subject->editAction($sender);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenSenderInSenderRepository()
	{
		$sender = new \T3fx\T3fxMailscanner\Domain\Model\Sender();

		$senderRepository = $this->getMock('', array('update'), array(), '', FALSE);
		$senderRepository->expects($this->once())->method('update')->with($sender);
		$this->inject($this->subject, 'senderRepository', $senderRepository);

		$this->subject->updateAction($sender);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenSenderFromSenderRepository()
	{
		$sender = new \T3fx\T3fxMailscanner\Domain\Model\Sender();

		$senderRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$senderRepository->expects($this->once())->method('remove')->with($sender);
		$this->inject($this->subject, 'senderRepository', $senderRepository);

		$this->subject->deleteAction($sender);
	}
}
