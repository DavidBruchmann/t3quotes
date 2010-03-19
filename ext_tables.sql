#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
	tx_t3quotes_selected tinyint(3) unsigned DEFAULT '0' NOT NULL
);



#
# Table structure for table 'tx_t3quotes'
#
CREATE TABLE tx_t3quotes (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	preface text NOT NULL,
	quote text NOT NULL,
	full_context text NOT NULL,
	author_name tinytext NOT NULL,
	author_email tinytext NOT NULL,
	author_title tinytext NOT NULL,
	weight int(11) unsigned DEFAULT '0' NOT NULL,
	date int(11) DEFAULT '0' NOT NULL,
	selected tinyint(3) unsigned DEFAULT '0' NOT NULL,
	rotation_quote tinytext NOT NULL,
	authstate tinyint(3) unsigned DEFAULT '0' NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);