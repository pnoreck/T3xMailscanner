<?php
return array(
    'ctrl'      => array(
        'title'         => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_imapfolder',
        'label'         => 'name',
        'tstamp'        => 'tstamp',
        'crdate'        => 'crdate',
        'cruser_id'     => 'cruser_id',
        'dividers2tabs' => true,
        'delete'        => 'deleted',
        'enablecolumns' => array(
            'disabled'  => 'hidden',
            'starttime' => 'starttime',
            'endtime'   => 'endtime',
        ),
        'searchFields'  => 'full_name,name',
        'iconfile'      => 'EXT:t3fx_mailscanner/Resources/Public/Icons/tx_t3fxmailscanner_domain_model_blacklist.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'hidden, full_name, name',
    ),
    'types'     => array(
        '1' => array('showitem' => 'hidden;;1, full_name, name, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
    ),
    'palettes'  => array(
        '1' => array('showitem' => ''),
    ),
    'columns'   => array(

        'hidden'    => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude'   => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label'     => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config'    => array(
                'type'     => 'input',
                'size'     => 13,
                'max'      => 20,
                'eval'     => 'datetime',
                'checkbox' => 0,
                'default'  => 0,
                'range'    => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime'   => array(
            'exclude'   => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label'     => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config'    => array(
                'type'     => 'input',
                'size'     => 13,
                'max'      => 20,
                'eval'     => 'datetime',
                'checkbox' => 0,
                'default'  => 0,
                'range'    => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),

        'mail'            => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_blacklist.full_name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'domain'          => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_blacklist.name',
            'config'  => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'complete_domain' => array(
            'exclude' => 1,
            'label'   => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_sender.whole_domain',
            'config'  => array(
                'type' => 'check',
            ),
        ),

    ),
);
