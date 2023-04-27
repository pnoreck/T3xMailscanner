<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	't3x_mailscanner',
	'Mailscanner',
	array(
		'MailScanner' => 'list, listByFolder, edit, new, create, update, delete',

	),
	// non-cacheable actions
	array(
		'MailScanner' => 'list, listByFolder, edit, new, create, update, delete',

	)
);
