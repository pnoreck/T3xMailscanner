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
 * Test case for class T3x\T3xMailscanner\Controller\MailScannerController.
 *
 * @author Steffen Hastädt <mailscanner@t3x.ch>
 */
class MailScannerControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \T3x\T3xMailscanner\Controller\MailScannerController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('T3x\\T3xMailscanner\\Controller\\MailScannerController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMailScannersFromRepositoryAndAssignsThemToView()
	{

		$allMailScanners = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$mailScannerRepository = $this->getMock('T3x\\T3xMailscanner\\Domain\\Repository\\MailScannerRepository', array('findAll'), array(), '', FALSE);
		$mailScannerRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMailScanners));
		$this->inject($this->subject, 'mailScannerRepository', $mailScannerRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('mailScanners', $allMailScanners);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenMailScannerToMailScannerRepository()
	{
		$mailScanner = new \T3x\T3xMailscanner\Domain\Model\MailScanner();

		$mailScannerRepository = $this->getMock('T3x\\T3xMailscanner\\Domain\\Repository\\MailScannerRepository', array('add'), array(), '', FALSE);
		$mailScannerRepository->expects($this->once())->method('add')->with($mailScanner);
		$this->inject($this->subject, 'mailScannerRepository', $mailScannerRepository);

		$this->subject->createAction($mailScanner);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenMailScannerToView()
	{
		$mailScanner = new \T3x\T3xMailscanner\Domain\Model\MailScanner();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('mailScanner', $mailScanner);

		$this->subject->editAction($mailScanner);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenMailScannerInMailScannerRepository()
	{
		$mailScanner = new \T3x\T3xMailscanner\Domain\Model\MailScanner();

		$mailScannerRepository = $this->getMock('T3x\\T3xMailscanner\\Domain\\Repository\\MailScannerRepository', array('update'), array(), '', FALSE);
		$mailScannerRepository->expects($this->once())->method('update')->with($mailScanner);
		$this->inject($this->subject, 'mailScannerRepository', $mailScannerRepository);

		$this->subject->updateAction($mailScanner);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenMailScannerFromMailScannerRepository()
	{
		$mailScanner = new \T3x\T3xMailscanner\Domain\Model\MailScanner();

		$mailScannerRepository = $this->getMock('T3x\\T3xMailscanner\\Domain\\Repository\\MailScannerRepository', array('remove'), array(), '', FALSE);
		$mailScannerRepository->expects($this->once())->method('remove')->with($mailScanner);
		$this->inject($this->subject, 'mailScannerRepository', $mailScannerRepository);

		$this->subject->deleteAction($mailScanner);
	}
}
