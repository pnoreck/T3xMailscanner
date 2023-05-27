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

use T3x\T3xMailscanner\Domain\Model\ImapFolder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * The repository for Sender
 */
class SenderRepository extends AbstractRepository
{

    /**
     * Find a sender by given email address
     *
     * @param string $email
     *
     * @return QueryResultInterface
     */
    public function findSenderByEmail($email): QueryResultInterface
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('name', $email)
        )->execute();
    }

    /**
     * Find all sender by given imap folder
     *
     * @param ImapFolder $imapFolder
     *
     * @return QueryResultInterface
     */
    public function findSenderByFolder(ImapFolder $imapFolder): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('imapFolder', $imapFolder)
        );

        return $query->execute();
    }

    /**
     * Find all sender without imap folder
     *
     * @return QueryResultInterface
     */
    public function findSenderWithoutFolder(): QueryResultInterface
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('imapFolder', 0)
        )->execute();
    }

    /**
     * Find all senders with the same domain
     *
     * @param string $domain
     *
     * @return QueryResultInterface
     */
    public function findSenderByDomain($domain): QueryResultInterface
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->like('name', '%@' . $domain)
        )->execute();
    }

}
