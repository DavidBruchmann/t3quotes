<?php

########################################################################
# Extension Manager/Repository config file for ext "t3quotes".
#
# Auto generated 19-03-2010 16:25
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Quotes database',
	'description' => 'A database with quotes which are displayed on the webpage in various ways.',
	'category' => 'plugin',
	'shy' => 0,
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'tt_content',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author' => 'Kasper Skårhøj',
	'author_email' => 'kasper@typo3.com',
	'author_company' => 'Curby Soft Multimedia',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '0.1.1',
	'constraints' => array(
		'depends' => array(
			'typo3' => '3.5.0-0.0.0',
			'php' => '3.0.0-0.0.0',
			'cms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:13:{s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"cfba";s:14:"ext_tables.php";s:4:"cd37";s:14:"ext_tables.sql";s:4:"b430";s:28:"ext_typoscript_editorcfg.txt";s:4:"d524";s:24:"ext_typoscript_setup.txt";s:4:"8b02";s:20:"icon_tx_t3quotes.gif";s:4:"401f";s:16:"locallang_db.php";s:4:"b3fc";s:7:"tca.php";s:4:"9df3";s:19:"doc/wizard_form.dat";s:4:"6ec2";s:20:"doc/wizard_form.html";s:4:"62e6";s:29:"pi1/class.tx_t3quotes_pi1.php";s:4:"83cf";s:17:"pi1/locallang.php";s:4:"90a3";}',
);

?>