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

use TYPO3\CMS\Backend\Controller;

/**
 * Definitions for routes provided by EXT:backend
 * Contains all AJAX-based routes for entry points
 */
return [

    'mailscanner' => [
        'path' => '/mailscanner/list',
        'target' =>  \T3x\Mailscanner\Controller\Backend\MailScannerController::class . '::listAction',
    ],
];
