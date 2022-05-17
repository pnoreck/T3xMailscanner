#
# Table structure for table 'tx_t3fxmailscanner_domain_model_imapfolder'
#
CREATE TABLE tx_t3fxmailscanner_domain_model_imapfolder (
    mailscanner int(11) unsigned DEFAULT '0' NOT NULL,
    full_name   varchar(255)     DEFAULT ''  NOT NULL,
    name        varchar(255)     DEFAULT ''  NOT NULL
);

#
# Table structure for table 'tx_t3fxmailscanner_domain_model_sender'
#
CREATE TABLE tx_t3fxmailscanner_domain_model_sender (
    name        varchar(255)     DEFAULT '' NOT NULL,
    imap_folder int(11) unsigned DEFAULT '0'
);


#
# Table structure for table 'tx_t3fxmailscanner_domain_model_blacklist'
#
CREATE TABLE tx_t3fxmailscanner_domain_model_blacklist (
    mail            varchar(255)        DEFAULT ''  NOT NULL,
    domain          varchar(255)        DEFAULT ''  NOT NULL,
    complete_domain tinyint(4) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_t3fxmailscanner_domain_model_blacklist'
#
CREATE TABLE tx_t3fxmailscanner_domain_model_mail (
    from_name varchar(255)        DEFAULT ''  NOT NULL,
    from_mail varchar(255)        DEFAULT ''  NOT NULL,
    to_name   varchar(255)        DEFAULT ''  NOT NULL,
    to_mail   varchar(255)        DEFAULT ''  NOT NULL,
    subject   varchar(255)        DEFAULT ''  NOT NULL,
    header    TEXT,
    message   TEXT
);

