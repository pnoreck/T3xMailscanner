<?php
return array(
    'ctrl'    => array(
        'title'            => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_whitelist',
        'label'            => 'name',
        'tstamp'           => 'tstamp',
        'crdate'           => 'crdate',
        'delete'           => 'deleted',
        'enablecolumns'    => array(
            'disabled' => 'hidden',
        ),
        'searchFields'     => 'name',
        'typeicon_classes' => [
            'default' => 'overlay-approved',
        ],
    ),
    'types'   => array(
        '0' => array('showitem' => 'hidden, name'),
    ),
    'columns' => array(
        'hidden' => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config'  => [
                'type' => 'check',
            ]
        ],
        'name'   => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_whitelist.name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
    ),
);
