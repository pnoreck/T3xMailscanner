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

namespace T3x\Mailscanner\Domain\Model;


use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
/**
 * ImapFolder
 */
class ImapFolder extends AbstractEntity
{

    /**
     * fullName
     *
     * @var string
     */
    protected $fullName = '';

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * Returns the fullName
     *
     * @return string $fullName
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Sets the fullName
     *
     * @param string $fullName
     *
     * @return void
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return utf8_encode(imap_utf7_decode($this->name));
    }

    /**
     * Sets the name
     *
     * @param string $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}
