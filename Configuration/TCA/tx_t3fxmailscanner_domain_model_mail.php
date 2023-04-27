<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_sender',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,imap_folder,',
		'iconfile' => 'EXT:t3fx_mailscanner/Resources/Public/Icons/tx_t3fxmailscanner_domain_model_sender.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden, name, imap_folder',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, name, imap_folder, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(


		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),

		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_sender.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),

		'imap_folder' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:t3fx_mailscanner/Resources/Private/Language/locallang_db.xlf:tx_t3fxmailscanner_domain_model_sender.imap_folder',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_t3fxmailscanner_domain_model_imapfolder',
			),
		),

	),
);
