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

namespace T3x\T3xMailscanner\Domain\Repository;

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
class ImapFolderRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{


	public function findFolderWithSender() {
		$query = $this->createQuery();
		$query->statement(
			'SELECT '.
				'folder.* '.
			'FROM '.
				'tx_t3xmailscanner_domain_model_imapfolder AS folder '.
			'LEFT JOIN '.
				'tx_t3xmailscanner_domain_model_sender AS sender '.
				'ON folder.uid = sender.imap_folder '.
			'WHERE '.
				'sender.uid > 0 AND 
				sender.hidden = 0 AND 
				sender.deleted = 0 AND 
				folder.hidden = 0 AND 
				folder.deleted = 0 
			'.
			'GROUP BY folder.uid ORDER BY folder.name'
		);

		return $query->execute();
	}

}
