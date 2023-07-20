<?php
return array(
    'ctrl'    => array(
        'title'            => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_imapfolder',
        'label'            => 'name',
        'tstamp'           => 'tstamp',
        'crdate'           => 'crdate',
        'default_sortby'   => 'ORDER BY full_name',
        'delete'           => 'deleted',
        'enablecolumns'    => array(
            'disabled' => 'hidden',
        ),
        'typeicon_classes' => [
            'default' => 'apps-filetree-folder',
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
                'type' => 'check',
            ]
        ],

        'full_name' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_imapfolder.full_name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'name'      => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_imapfolder.name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
    ),
);
