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
namespace T3x\T3xMailscanner\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Sender
 */
class Sender extends AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected string $name = '';

    /**
     * imapFolder
     *
     * @var ImapFolder
     */
    protected ?ImapFolder $imapFolder = null;

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Returns the imapFolder
     *
     * @return ImapFolder|null $imapFolder
     */
    public function getImapFolder(): ?ImapFolder
    {
        return $this->imapFolder;
    }

    /**
     * Sets the imapFolder
     *
     * @param ImapFolder $imapFolder
     *
     * @return void
     */
    public function setImapFolder(ImapFolder $imapFolder): void
    {
        $this->imapFolder = $imapFolder;
    }

}
