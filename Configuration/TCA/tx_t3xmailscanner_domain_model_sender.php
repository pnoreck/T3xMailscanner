<?php
return array(
    'ctrl'     => array(
        'title'            => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_sender',
        'label'            => 'name',
        'tstamp'           => 'tstamp',
        'crdate'           => 'crdate',
        'delete'           => 'deleted',
        'enablecolumns'    => array(
            'disabled' => 'hidden',
        ),
        'searchFields'     => 'name,imap_folder,',
        'typeicon_classes' => [
            'default' => 'form-email',
        ],
    ),
    'types'    => array(
        '1' => array('showitem' => 'hidden;;1, name, imap_folder, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns'  => array(

        'hidden' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config'  => [
                'type' => 'check',
            ]
        ],

        'name' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_sender.name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),

        'imap_folder' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_sender.imap_folder',
            'config'  => array(
                'type'                => 'select',
                'renderType'          => 'selectSingle',
                'foreign_table'       => 'tx_t3xmailscanner_domain_model_imapfolder',
                'foreign_table_where' => ' ORDER BY name ASC',
            ),
        ),

    ),
);
