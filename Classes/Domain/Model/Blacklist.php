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

class Blacklist extends AbstractEntity
{

    /**
     * mail
     *
     * @var string
     */
    protected $mail = '';

    /**
     * domain
     *
     * @var string
     */
    protected $domain = null;

    /**
     * wholeDomain
     *
     * @var bool
     */
    protected $wholeDomain = false;

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return boolean
     */
    public function isWholeDomain()
    {
        return $this->wholeDomain;
    }

    /**
     * @return boolean
     */
    public function getWholeDomain()
    {
        return $this->wholeDomain;
    }

    /**
     * @param boolean $wholeDomain
     */
    public function setWholeDomain($wholeDomain)
    {
        $this->wholeDomain = $wholeDomain;
    }


}
