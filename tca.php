<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

$TCA["tx_t3quotes"] = Array (
	"ctrl" => $TCA["tx_t3quotes"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,starttime,endtime,preface,quote,full_context,author_name,author_email,author_title,weight,date,selected,rotation_quote,authstate"
	),
	"feInterface" => $TCA["tx_t3quotes"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (		
			"exclude" => 1,	
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"starttime" => Array (		
			"exclude" => 1,	
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.starttime",
			"config" => Array (
				"type" => "input",
				"size" => "8",
				"max" => "20",
				"eval" => "date",
				"default" => "0",
				"checkbox" => "0"
			)
		),
		"endtime" => Array (		
			"exclude" => 1,	
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.endtime",
			"config" => Array (
				"type" => "input",
				"size" => "8",
				"max" => "20",
				"eval" => "date",
				"checkbox" => "0",
				"default" => "0",
				"range" => Array (
					"upper" => mktime(0,0,0,12,31,2020),
					"lower" => mktime(0,0,0,date("m")-1,date("d"),date("Y"))
				)
			)
		),
		"preface" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.preface",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",	
				"rows" => "5",
			)
		),
		"quote" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.quote",		
			"config" => Array (
				"type" => "text",
				"cols" => "48",	
				"rows" => "5",
			)
		),
		"full_context" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.full_context",		
			"config" => Array (
				"type" => "text",
				"cols" => "48",	
				"rows" => "10",
			)
		),
		"author_name" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.author_name",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"eval" => "required",
			)
		),
		"author_email" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.author_email",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"author_title" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.author_title",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"weight" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.weight",		
			"config" => Array (
				"type" => "select",
				"items" => Array (
					Array("LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.weight.I.0", "100"),
					Array("LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.weight.I.1", "0"),
					Array("LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.weight.I.2", "-100"),
				),
			)
		),
		"date" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.date",		
			"config" => Array (
				"type" => "input",
				"size" => "8",
				"max" => "20",
				"eval" => "date",
				"checkbox" => "0",
				"default" => "0"
			)
		),
		"selected" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.selected",		
			"config" => Array (
				"type" => "check",
			)
		),
		"rotation_quote" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.rotation_quote",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"authstate" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:t3quotes/locallang_db.php:tx_t3quotes.authstate",		
			"config" => Array (
				"type" => "check",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, preface, quote, full_context, author_name, author_email, author_title, weight, date, selected, rotation_quote, authstate")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "starttime, endtime")
	)
);
?>