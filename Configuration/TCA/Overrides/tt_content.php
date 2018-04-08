<?php

$temporaryColumns = [
    't3quotes_selected' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_ttcontent.t3quotes_selected',
        'displayCond' => 'FIELD:list_type:=:t3quotes_t3quotes',
        'config' => [
	        'type' => 'check',
	        'items' => [
	            '1' => [
	                '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
	            ]
	        ],
	        'default' => 0
	    ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        $temporaryColumns
);

// types.list.showitem
$tmpShowItem = $GLOBALS['TCA']['tt_content']['types']['list']['showitem'];
$tmpArray = explode(',',$tmpShowItem);
$newTmpArray = [];
foreach($tmpArray as $count => $item){
    // Adding new field above field "pages"
    if(strpos(trim($item),'pages;')===0){
        $newTmpArray[] = 't3quotes_selected;LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_ttcontent.t3quotes_selected';
    }
    $newTmpArray[] = $item;
}
$GLOBALS['TCA']['tt_content']['types']['list']['showitem'] = implode(',',$newTmpArray);

// interface.showRecordFieldList
$GLOBALS['TCA']['tt_content']['interface']['showRecordFieldList'] .= ',t3quotes_selected';

// @TODO: any usage for this:?
# $TCA["tt_content"]["types"]["list"]["subtypes_excludelist"][$_EXTKEY."_pi1"] = "layout,select_key";
# $TCA["tt_content"]["types"]["list"]["subtypes_addlist"]    [$_EXTKEY."_pi1"] = "tx_t3quotes_selected;;;;1-1-1";

$t3Version = TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version( TYPO3_version );

// field select_key exists only in 7.x
// @TODO: removing in version 7 too?
//        ... else see TODO below
if(version_compare($t3Version, '8.0.0', '<'))
{
	$newDisplaycond = 'FIELD:list_type:!=:t3quotes_t3quotes';
	$GLOBALS['TCA']['tt_content']['columns']['select_key']['displayCond'] = $newDisplaycond;

	/*
	// @TODO resolve displaycond if existing from several extensions:
	if(isset($GLOBALS['TCA']['tt_content']['columns']['select_key']['displayCond'])){
		$oldDisplaycond = $GLOBALS['TCA']['tt_content']['columns']['select_key']['displaycond'];
		if($oldDisplaycond){
			$tmpDisplaycond = '[ AND ['.$oldDisplaycond.', '.$newDisplaycond.']';
			$GLOBALS['TCA']['tt_content']['columns']['select_key']['displaycond'] = $tmpDisplaycond;
		}
	}
	else
	{
		$GLOBALS['TCA']['tt_content']['columns']['select_key']['displayCond'] = $newDisplaycond;
	}
	*/
}
