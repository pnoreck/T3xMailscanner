<?php
namespace T3fx\T3fxMailscanner\Domain\Repository;

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
 * The repository for MailScanners
 */
class SenderRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	/**
	 * Find a sender by given email address
	 *
	 * @param string $email
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findSenderByEmail($email) {
		$query = $this->createQuery();
		return $query->matching(
			$query->equals('name', $email)
		)->execute();
	}

	/**
	 * Find all sender by given imap folder
	 *
	 * @param int $folderUid
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findSenderByFolder($folderUid) {
		$query = $this->createQuery();
		return $query->matching(
			$query->equals('imap_folder', $folderUid)
		)->execute();
	}

	/**
	 * Find all senders with the same domain
	 *
	 * @param string $domain
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findSenderByDomain($domain) {
		$query = $this->createQuery();
		return $query->matching(
			$query->like('name', '%@'.$domain)
		)->execute();
	}

}