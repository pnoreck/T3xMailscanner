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

namespace T3x\Mailscanner\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for ImapFolder
 */
class ImapFolderRepository extends Repository
{


    public function findFolderWithSender(): array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $query = $this->createQuery();
        $query->statement(
            'SELECT ' .
            'folder.* ' .
            'FROM ' .
            'tx_t3xmailscanner_domain_model_imapfolder AS folder ' .
            'LEFT JOIN ' .
            'tx_t3xmailscanner_domain_model_sender AS sender ' .
            'ON folder.uid = sender.imap_folder ' .
            'WHERE ' .
            'sender.uid > 0 AND 
				sender.hidden = 0 AND 
				sender.deleted = 0 AND 
				folder.hidden = 0 AND 
				folder.deleted = 0 
			' .
            'GROUP BY folder.uid ORDER BY folder.name'
        );

        return $query->execute();
    }

}
