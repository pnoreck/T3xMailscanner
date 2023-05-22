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
    protected string $mail = '';

    /**
     * domain
     *
     * @var string
     */
    protected string $domain = '';

    /**
     * wholeDomain
     *
     * @var bool
     */
    protected bool $wholeDomain = false;

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     *
     * @return self
     */
    public function setMail(string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     *
     * @return self
     */
    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return bool
     */
    public function isWholeDomain(): bool
    {
        return $this->wholeDomain;
    }

    /**
     * @param bool $wholeDomain
     *
     * @return self
     */
    public function setWholeDomain(bool $wholeDomain): self
    {
        $this->wholeDomain = $wholeDomain;
        return $this;
    }

}
