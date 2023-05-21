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

use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for Sender
 */
class SenderRepository extends Repository
{
    /**
     * Find a sender by given email address
     *
     * @param string $email
     *
     * @return array|QueryResultInterface
     */
    public function findSenderByEmail($email)
    {
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
     * @return array|QueryResultInterface
     */
    public function findSenderByFolder($folderUid)
    {
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
     * @return array|QueryResultInterface
     */
    public function findSenderByDomain($domain)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->like('name', '%@' . $domain)
        )->execute();
    }

}
