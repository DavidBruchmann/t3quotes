<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");
$tempColumns = Array (
	"tx_t3quotes_selected" => Array (		
		"exclude" => 1,		
		"label" => "LLL:EXT:t3quotes/locallang_db.php:tt_content.tx_t3quotes_selected",		
		"config" => Array (
			"type" => "check",
		)
	),
);


t3lib_div::loadTCA("tt_content");
t3lib_extMgm::addTCAcolumns("tt_content",$tempColumns,1);
#t3lib_extMgm::addToAllTCAtypes("tt_content","tx_t3quotes_selected;;;;1-1-1");


t3lib_extMgm::allowTableOnStandardPages("tx_t3quotes");


t3lib_extMgm::addToInsertRecords("tx_t3quotes");

$TCA["tx_t3quotes"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes",		
		"label" => "quote",	
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"default_sortby" => "ORDER BY tstamp",	
		"delete" => "deleted",	
		"enablecolumns" => Array (		
			"disabled" => "hidden",	
			"starttime" => "starttime",	
			"endtime" => "endtime",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_t3quotes.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, starttime, endtime, preface, quote, full_context, author_name, author_email, author_title, weight, date, selected, rotation_quote, authstate",
	)
);


t3lib_div::loadTCA("tt_content");
$TCA["tt_content"]["types"]["list"]["subtypes_excludelist"][$_EXTKEY."_pi1"]="layout,select_key";
$TCA["tt_content"]["types"]["list"]["subtypes_addlist"][$_EXTKEY."_pi1"]="tx_t3quotes_selected;;;;1-1-1";

t3lib_extMgm::addPlugin(Array("LLL:EXT:t3quotes/locallang_db.php:tt_content.list_type", $_EXTKEY."_pi1"),"list_type");
?>