ALTER TABLE tx_t3fxmailscanner_domain_model_blacklist RENAME tx_t3xmailscanner_domain_model_blacklist;
ALTER TABLE tx_t3fxmailscanner_domain_model_content_filter RENAME tx_t3xmailscanner_domain_model_content_filter;
ALTER TABLE tx_t3fxmailscanner_domain_model_imapfolder RENAME tx_t3xmailscanner_domain_model_imapfolder;
ALTER TABLE tx_t3fxmailscanner_domain_model_mail RENAME tx_t3xmailscanner_domain_model_mail;
ALTER TABLE tx_t3fxmailscanner_domain_model_sender RENAME tx_t3xmailscanner_domain_model_sender;
ALTER TABLE tx_t3fxmailscanner_domain_model_whitelist RENAME tx_t3xmailscanner_domain_model_whitelist;

UPDATE tx_t3xmailscanner_domain_model_blacklist SET pid = 2;
UPDATE tx_t3xmailscanner_domain_model_imapfolder SET pid = 2;
UPDATE tx_t3xmailscanner_domain_model_sender SET pid = 2;
UPDATE tx_t3xmailscanner_domain_model_whitelist SET pid = 2;
