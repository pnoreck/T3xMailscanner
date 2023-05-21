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
 * Sender
 */
class Blacklist extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
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
    public function getMail () {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail ($mail) {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getDomain () {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain ($domain) {
        $this->domain = $domain;
    }

    /**
     * @return boolean
     */
    public function isWholeDomain () {
        return $this->wholeDomain;
    }

   /**
     * @return boolean
     */
    public function getWholeDomain () {
        return $this->wholeDomain;
    }

    /**
     * @param boolean $wholeDomain
     */
    public function setWholeDomain ($wholeDomain) {
        $this->wholeDomain = $wholeDomain;
    }


}
