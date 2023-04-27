<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'T3x.' . 't3x_mailscanner',
	'Mailscanner',
	'Configuration'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('t3x_mailscanner', 'Configuration/TypoScript', 'Mail Scanner');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3xmailscanner_domain_model_imapfolder', 'EXT:t3x_mailscanner/Resources/Private/Language/locallang_csh_tx_t3xmailscanner_domain_model_imapfolder.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3xmailscanner_domain_model_imapfolder');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3xmailscanner_domain_model_sender', 'EXT:t3x_mailscanner/Resources/Private/Language/locallang_csh_tx_t3xmailscanner_domain_model_sender.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3xmailscanner_domain_model_sender');
