<?php
return array(
    'ctrl'    => array(
        'title'            => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_imapfolder',
        'label'            => 'name',
        'tstamp'           => 'tstamp',
        'crdate'           => 'crdate',
        'default_sortby'   => 'ORDER BY full_name',
        'cruser_id'        => 'cruser_id',
        'delete'           => 'deleted',
        'enablecolumns'    => array(
            'disabled' => 'hidden',
        ),
        'typeicon_classes' => [
            'default' => 'tx_examples-dummy',
        ],
    ),
    'types'   => array(
        '0' => array('showitem' => 'hidden, full_name, name'),
    ),
    'columns' => array(

        'hidden' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config'  => [
                'type'       => 'check',
                'renderType' => 'checkboxToggle',
                'items'      => [
                    [
                        0                    => '',
                        1                    => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ]
        ],

        'full_name' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_imapfolder.full_name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'name'      => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_imapfolder.name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
    ),
);
