<?php
/**
 * Definitions for modules provided by EXT:examples
 */
return [
    'admin_examples' => [
        'parent'            => 'system',
        'position'          => ['top'],
        'access'            => 'user',
        'workspaces'        => 'live',
        'path'              => '/module/system/mailscanner',
        'labels'            => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf',
        'extensionName'     => 'mailscanner',
        'controllerActions' => [
            \T3x\Mailscanner\Controller\Backend\MailScannerController::class => [
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
