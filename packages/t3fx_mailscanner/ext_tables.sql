-- --------------------------------------------------------

--
-- Table structure for table `tx_t3fxmailscanner_domain_model_blacklist`
--

CREATE TABLE `tx_t3fxmailscanner_domain_model_blacklist` (
    `mail`            varchar(255)      NOT NULL DEFAULT '',
    `domain`          varchar(255)      NOT NULL DEFAULT '',
    `complete_domain` smallint UNSIGNED NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3fxmailscanner_domain_model_content_filter`
--

CREATE TABLE `tx_t3fxmailscanner_domain_model_content_filter` (
    `sha1`        varchar(40)                                DEFAULT NULL,
    `regex`       varchar(100)                      NOT NULL,
    `content`     varchar(255)                      NOT NULL DEFAULT '',
    `filter_type` enum ('SUBJECT','BODY','BOTH','') NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3fxmailscanner_domain_model_imapfolder`
--

CREATE TABLE `tx_t3fxmailscanner_domain_model_imapfolder` (
    `full_name`   varchar(255) NOT NULL DEFAULT '',
    `name`        varchar(255) NOT NULL DEFAULT '',
    `mailscanner` int UNSIGNED NOT NULL DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3fxmailscanner_domain_model_mail`
--

CREATE TABLE `tx_t3fxmailscanner_domain_model_mail` (
    `from_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `from_mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `to_name`   varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `to_mail`   varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `subject`   varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
    `header`    text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
    `message`   text CHARACTER SET utf8 COLLATE utf8_unicode_ci
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3fxmailscanner_domain_model_sender`
--

CREATE TABLE `tx_t3fxmailscanner_domain_model_sender` (
    `uid`         int               NOT NULL,
    `pid`         int               NOT NULL DEFAULT '0',
    `name`        varchar(255)      NOT NULL DEFAULT '',
    `imap_folder` int UNSIGNED               DEFAULT '0',
    `tstamp`      int UNSIGNED      NOT NULL DEFAULT '0',
    `crdate`      int UNSIGNED      NOT NULL DEFAULT '0',
    `cruser_id`   int UNSIGNED      NOT NULL DEFAULT '0',
    `deleted`     smallint UNSIGNED NOT NULL DEFAULT '0',
    `hidden`      smallint UNSIGNED NOT NULL DEFAULT '0',
    `starttime`   int UNSIGNED      NOT NULL DEFAULT '0',
    `endtime`     int UNSIGNED      NOT NULL DEFAULT '0',

    KEY `name`(`name`, `deleted`, `hidden`) USING BTREE
);

-- --------------------------------------------------------

--
-- Table structure for table `tx_t3fxmailscanner_domain_model_whitelist`
--

CREATE TABLE `tx_t3fxmailscanner_domain_model_whitelist` (
    `uid`       int              NOT NULL,
    `pid`       int              NOT NULL DEFAULT '0',
    `name`      varchar(255)     NOT NULL DEFAULT '',
    `tstamp`    int UNSIGNED     NOT NULL DEFAULT '0',
    `crdate`    int UNSIGNED     NOT NULL DEFAULT '0',
    `cruser_id` int UNSIGNED     NOT NULL DEFAULT '0',
    `deleted`   tinyint UNSIGNED NOT NULL DEFAULT '0',
    `hidden`    tinyint UNSIGNED NOT NULL DEFAULT '0',
    `starttime` int UNSIGNED     NOT NULL DEFAULT '0',
    `endtime`   int UNSIGNED     NOT NULL DEFAULT '0',

    KEY `name`(`name`, `deleted`, `hidden`) USING BTREE
);

