#
# Table structure for table 'tx_t3quotes_domain_model_t3quotes'
#
CREATE TABLE tx_t3quotes_domain_model_t3quotes (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	preface text NOT NULL,
	quote text NOT NULL,
	full_context text NOT NULL,
	author_name varchar(255) DEFAULT '' NOT NULL,
	author_email varchar(255) DEFAULT '' NOT NULL,
	author_title varchar(255) DEFAULT '' NOT NULL,
	weight int(11) DEFAULT '0' NOT NULL,
	date date DEFAULT '0000-00-00',
	selected tinyint(1) unsigned DEFAULT '0' NOT NULL,
	rotation_quote varchar(255) DEFAULT '' NOT NULL,
	authstate tinyint(1) unsigned DEFAULT '0' NOT NULL,

	categories int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Additional field for table 'tt_content'
#
CREATE TABLE tt_content (
	t3quotes_selected tinyint(1) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'cf_t3quotes_t3quotes'
#
CREATE TABLE `cf_t3quotes_t3quotes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `identifier` varchar(250) NOT NULL DEFAULT '',
  `expires` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `content` mediumblob,

  PRIMARY KEY (`id`),
  KEY `cache_id` (`identifier`,`expires`)
);

