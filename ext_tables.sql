-- --------------------------------------------------------

--
-- Table structure for table `tx_t3xmailscanner_domain_model_blacklist`
--

CREATE TABLE `tx_t3xmailscanner_domain_model_blacklist` (
    `mail`            varchar(255) NOT NULL DEFAULT '',
    `domain`          varchar(255) NOT NULL DEFAULT '',
    `complete_domain` smallint(5) unsigned NOT NULL DEFAULT 0,
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3xmailscanner_domain_model_content_filter`
--

CREATE TABLE `tx_t3xmailscanner_domain_model_content_filter` (
    `sha1`        varchar(40)  NOT NULL DEFAULT '',
    `regex`       varchar(100) NOT NULL DEFAULT '',
    `content`     varchar(255) NOT NULL DEFAULT '',
    `filter_type` enum ('SUBJECT','BODY','BOTH','') NOT NULL DEFAULT ''
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3xmailscanner_domain_model_imapfolder`
--

CREATE TABLE `tx_t3xmailscanner_domain_model_imapfolder` (
    `full_name`   varchar(255) NOT NULL DEFAULT '',
    `name`        varchar(255) NOT NULL DEFAULT '',
    `mailscanner` int UNSIGNED NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3xmailscanner_domain_model_mail`
--

CREATE TABLE `tx_t3xmailscanner_domain_model_mail` (
    `from_name` varchar(255) NOT NULL DEFAULT '',
    `from_mail` varchar(255) NOT NULL DEFAULT '',
    `to_name`   varchar(255) NOT NULL DEFAULT '',
    `to_mail`   varchar(255) NOT NULL DEFAULT '',
    `subject`   varchar(255) NOT NULL DEFAULT '',
    `header`    text                  DEFAULT NULL,
    `message`   text                  DEFAULT NULL,
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3xmailscanner_domain_model_sender`
--

CREATE TABLE `tx_t3xmailscanner_domain_model_sender` (
    `uid`         int          NOT NULL,
    `pid`         int          NOT NULL DEFAULT '0',
    `name`        varchar(255) NOT NULL DEFAULT '',
    `imap_folder` int UNSIGNED DEFAULT '0',
    `tstamp`      int UNSIGNED NOT NULL DEFAULT '0',
    `crdate`      int UNSIGNED NOT NULL DEFAULT '0',
    `cruser_id`   int UNSIGNED NOT NULL DEFAULT '0',
    `deleted`     smallint UNSIGNED NOT NULL DEFAULT '0',
    `hidden`      smallint UNSIGNED NOT NULL DEFAULT '0',
    `starttime`   int UNSIGNED NOT NULL DEFAULT '0',
    `endtime`     int UNSIGNED NOT NULL DEFAULT '0',

    KEY           `name`(`name`, `deleted`, `hidden`) USING BTREE
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3xmailscanner_domain_model_whitelist`
--

CREATE TABLE `tx_t3xmailscanner_domain_model_whitelist` (
    `uid`       int          NOT NULL,
    `pid`       int          NOT NULL DEFAULT '0',
    `name`      varchar(255) NOT NULL DEFAULT '',
    `tstamp`    int UNSIGNED NOT NULL DEFAULT '0',
    `crdate`    int UNSIGNED NOT NULL DEFAULT '0',
    `cruser_id` int UNSIGNED NOT NULL DEFAULT '0',
    `deleted`   tinyint UNSIGNED NOT NULL DEFAULT '0',
    `hidden`    tinyint UNSIGNED NOT NULL DEFAULT '0',
    `starttime` int UNSIGNED NOT NULL DEFAULT '0',
    `endtime`   int UNSIGNED NOT NULL DEFAULT '0',

    KEY         `name`(`name`, `deleted`, `hidden`) USING BTREE
);


CREATE TABLE `t3fx_weather` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `crdate` int(11) NOT NULL,
  `tstamp` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `json` text NOT NULL,
  PRIMARY KEY (`uid`)
);
