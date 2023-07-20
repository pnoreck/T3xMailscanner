<?php
return array(
    'ctrl'    => array(
        'title'            => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_blacklist',
        'label'            => 'mail',
        'label_alt'        => 'domain',
        'tstamp'           => 'tstamp',
        'crdate'           => 'crdate',
        'delete'           => 'deleted',
        'enablecolumns'    => array(
            'disabled' => 'hidden',
        ),
        'searchFields'     => 'mail, domain, complete_domain',
        'typeicon_classes' => [
            'default' => 'apps-pagetree-drag-place-denied',
        ],
    ),
    'types'   => array(
        '0' => array('showitem' => 'hidden, mail, domain, complete_domain'),
    ),
    'columns' => array(
        'hidden'          => [
            'exclude' => true,
            'label'   => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
            'config'  => [
                'type' => 'check',
            ]
        ],
        'mail'            => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_blacklist.mail',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'domain'          => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_blacklist.domain',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'complete_domain' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3xmailscanner_domain_model_blacklist.complete_domain',
            'config'  => array(
                'type' => 'check',
            ),
        ),
    ),
);
