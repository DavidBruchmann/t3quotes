<?php

defined('TYPO3_MODE') || die('Access denied.');

function configureT3quotesPlugin()
{
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'WDB.T3quotes',
		'T3quotes',
		['T3quotes' => 'list, show, new, create, edit, update, delete'],
		// non-cacheable actions
		['T3quotes' => 'create, update, delete']
	);
}

function configureT3quotesWizards($v='')
{
	if($v === 'v7'){
		$icon = 'icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3quotes') . 'Resources/Public/Icons/user_plugin_t3quotes.svg';
	}
	elseif($v === 'v8+'){
		$icon = 'iconIdentifier = t3quotes-plugin-t3quotes';
	}
	
	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
	'mod {
		wizards.newContentElement.wizardItems.plugins {
			elements {
				t3quotes {
					'.$icon.'
					title = LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.ce-wizard.name
					description = LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.ce-wizard.description
					tt_content_defValues {
						CType = list
						list_type = t3quotes_t3quotes
					}
				}
			}
			show = *
		}
	}'
	);
}

function addT3quotesIconToRegistry()
{
	$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
	$iconRegistry->registerIcon(
		't3quotes-plugin-t3quotes',
		\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
		['source' => 'EXT:t3quotes/Resources/Public/Icons/user_plugin_t3quotes.svg']
	);
}

$t3Version = TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version( TYPO3_version );
if(version_compare($t3Version, '8.0.0', '<'))
{
	call_user_func(function()
	{
		configureT3quotesPlugin();
		configureT3quotesWizards('v7');
		// addT3quotesIconToRegistry();
	},$_EXTKEY);
}
else
{
	call_user_func(function()
	{
		configureT3quotesPlugin();
		configureT3quotesWizards('v8+');
		addT3quotesIconToRegistry();
	});
}


// cache for storing typoscript-constants
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['t3quotes_t3quotes'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['t3quotes_t3quotes'] = array();
}
