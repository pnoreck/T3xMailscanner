<?php
/**
 * Definitions for modules provided by EXT:examples
 */
return [
    'mailscanner' => [
        'parent'            => 'web',
        'access'            => 'user',
        'path'              => '/module/system/mailscanner',
        'labels'            => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf',
        'extensionName'     => 'mailscanner',
        'iconIdentifier'    => 'module-dashboard',
        'controllerActions' => [
            \T3x\T3xMailscanner\Controller\Backend\MailScannerController::class => [
                'list',
                'listByFolder',
                'edit',
                'new',
                'create',
                'update',
                'delete',
            ]
        ],
    ],
];
