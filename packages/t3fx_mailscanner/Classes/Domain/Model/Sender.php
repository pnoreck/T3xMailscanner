<?php
namespace T3fx\T3fxMailscanner\Domain\Model;


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
class Sender extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected $name = '';
    
    /**
     * imapFolder
     *
     * @var \T3fx\T3fxMailscanner\Domain\Model\ImapFolder
     */
    protected $imapFolder = null;
    
    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Returns the imapFolder
     *
     * @return \T3fx\T3fxMailscanner\Domain\Model\ImapFolder $imapFolder
     */
    public function getImapFolder()
    {
        return $this->imapFolder;
    }
    
    /**
     * Sets the imapFolder
     *
     * @param \T3fx\T3fxMailscanner\Domain\Model\ImapFolder $imapFolder
     * @return void
     */
    public function setImapFolder(\T3fx\T3fxMailscanner\Domain\Model\ImapFolder $imapFolder)
    {
        $this->imapFolder = $imapFolder;
    }

}