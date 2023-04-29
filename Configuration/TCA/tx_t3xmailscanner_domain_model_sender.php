<?php
return array(
    'ctrl'      => array(
        'title'         => 'LLL:EXT:t3x_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_sender',
        'label'         => 'name',
        'tstamp'        => 'tstamp',
        'crdate'        => 'crdate',
        'cruser_id'     => 'cruser_id',
        'delete'        => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
        ),
        'searchFields'  => 'name,imap_folder,',
        'iconfile'      => 'EXT:t3x_mailscanner/Resources/Public/Icons/tx_t3xmailscanner_domain_model_sender.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'hidden, name, imap_folder',
    ),
    'types'     => array(
        '1' => array('showitem' => 'hidden;;1, name, imap_folder, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
    ),
    'palettes'  => array(
        '1' => array('showitem' => ''),
    ),
    'columns'   => array(

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

        'name' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:t3x_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_sender.name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),

        'imap_folder' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:t3x_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_sender.imap_folder',
            'config'  => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_t3xmailscanner_domain_model_imapfolder',
                'foreign_table_where' => 'ORDER BY name ASC',
            ),
        ),

    ),
);
