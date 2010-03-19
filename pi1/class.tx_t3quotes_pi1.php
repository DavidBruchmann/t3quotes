<?php
/***************************************************************
*  Copyright notice
*  
*  (c) 2002 Kasper Skårhøj (kasper@typo3.com)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is 
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
* 
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
* 
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/** 
 * Plugin 'Quotes' for the 't3quotes' extension.
 *
 * @author	Kasper Skårhøj <kasper@typo3.com>
 */


require_once(PATH_tslib."class.tslib_pibase.php");

class tx_t3quotes_pi1 extends tslib_pibase {
	var $prefixId = "tx_t3quotes_pi1";		// Same as class name
	var $scriptRelPath = "pi1/class.tx_t3quotes_pi1.php";	// Path to this script relative to the extension dir.
	var $extKey = "t3quotes";	// The extension key.
	
	/**
	 * [Put your description here]
	 */
	function main($content,$conf)	{
		switch((string)$conf["CMD"])	{
			default:
				if (strstr($this->cObj->currentRecord,"tt_content"))	{
					$conf["pidList"] = $this->cObj->data["pages"];
					$conf["recursive"] = $this->cObj->data["recursive"];
					$conf["selectedOnly"] = $this->cObj->data["tx_t3quotes_selected"];
				}
				return $this->pi_wrapInBaseClass($this->listView($content,$conf));
			break;
		}
	}
	
	/**
	 * [Put your description here]
	 */
	function listView($content,$conf)	{
		$this->conf=$conf;		// Setting the TypoScript passed to this function in $this->conf
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();		// Loading the LOCAL_LANG values
		$this->lConf = $this->conf["listView."];	// Local settings for the listView function
		

			// Initializing the query parameters:
		$this->internal["results_at_a_time"]=t3lib_div::intInRange($lConf["results_at_a_time"],0,1000,1000);
		
			// Only selected:
		$addWhere= $this->conf["selectedOnly"]	? ' AND tx_t3quotes.selected' : '';
	
			// Make listing query, pass query to MySQL:
		$query = $this->pi_list_query("tx_t3quotes",0,$addWhere,"","",' ORDER BY weight DESC, date DESC');
		$res = mysql(TYPO3_db,$query);
		if (mysql_error())	debug(array(mysql_error(),$query));
		$this->internal["currentTable"] = "tx_t3quotes";

			// Put the whole list together:
		$fullTable="";	// Clear var;
			
			// Adds the whole list table
		$fullTable.=$this->makelist($res);
		
			// Returns the content from the plugin.
		return $fullTable;
	}
	/**
	 * Making list of quotes
	 */
	function makelist($res)	{
		$items=Array();
			// Make list table rows
		while($this->internal["currentRow"] = mysql_fetch_assoc($res))	{
			$items[]=$this->makeListItem();
		}
	
		$out = '<DIV'.$this->pi_classParam("listrow").'>
			'.implode(chr(10),$items).'
			</DIV>';
		return $out;
	}	
	
	/**
	 * Making a single quote list item
	 */
	function makeListItem()	{
		if ($this->internal["currentRow"]["authstate"] || $this->conf["ignoreAuthState"])	{
			$name = $this->cObj->getTypolink($this->internal["currentRow"]["author_name"],$this->internal["currentRow"]["author_email"]).
				($this->internal["currentRow"]["author_title"] ? ", ".trim($this->internal["currentRow"]["author_title"]) : "");
		} else {
			list($name) = split("[[:space:]]",$this->internal["currentRow"]["author_name"]." Unknown",2);
		}
		
		$preface=trim($this->internal["currentRow"]["preface"]) ? "<strong>".$this->pi_getLL("comment")."</strong> ".trim($this->internal["currentRow"]["preface"]) : "";
		if ($preface)	$preface = '<p'.$this->pi_classParam("listrowField-preface").'>'.$preface.'</p>';
		
		$date = $this->internal["currentRow"]["date"] ? $this->getFieldContent("date") : '';
		if ($this->lConf["dateAndNameInBold"])	{
			$date = $date ? '<b>'.$date.'</b>' : $date;
			$name = $name ? '<b>'.$name.'</b>' : $name;
		}
	
		$out='<P'.$this->pi_classParam("listrowField-author").'><a name="'.$this->prefixId.'-'.$this->internal["currentRow"]["uid"].'"></a>'.$date.($date?' '.$this->pi_getLL("by").' ':'').$name.'</P>
				<P'.$this->pi_classParam("listrowField-quote").'>'.trim(nl2br($this->internal["currentRow"]["quote"])).'</P>
				'.$preface.'
			';
			$out.=$this->pi_getEditPanel("","","",array("onlyCurrentPid"=>0));
		return $out;
	}

	/**
	 * Returning the content for a single field.
	 */
	function getFieldContent($fN)	{
		switch($fN) {
			case "date":
					// For a numbers-only date, use something like: %d-%m-%y
				return strftime($this->conf["dateFormat"],$this->internal["currentRow"]["date"]);
			break;
			default:
				return $this->internal["currentRow"][$fN];
			break;
		}
	}
}



if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/t3quotes/pi1/class.tx_t3quotes_pi1.php"])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/t3quotes/pi1/class.tx_t3quotes_pi1.php"]);
}

?>