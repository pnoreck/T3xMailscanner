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
        'path'              => '/module/system/example',
        'labels'            => 'LLL:EXT:examples/Resources/Private/Language/AdminModule/locallang_mod.xlf',
        'extensionName'     => 'Examples',
        'controllerActions' => [
            \T3x\T3xMailscanner\Controller\MailScannerController::class => [
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
