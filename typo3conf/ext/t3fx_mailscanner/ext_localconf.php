<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'T3fx.' . $_EXTKEY,
	'Mailscanner',
	array(
		'MailScanner' => 'list, edit, new, create, update, delete',
		
	),
	// non-cacheable actions
	array(
		'MailScanner' => 'list, edit, new, create, update, delete',
		
	)
);
