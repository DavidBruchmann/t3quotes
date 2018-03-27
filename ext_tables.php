<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'WDB.T3quotes',
            'T3quotes',
            'T3Quotes'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'Quotes database');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3quotes_domain_model_t3quotes', 'EXT:t3quotes/Resources/Private/Language/locallang_csh_tx_t3quotes_domain_model_t3quotes.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3quotes_domain_model_t3quotes');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_t3quotes_domain_model_ttcontent', 'EXT:t3quotes/Resources/Private/Language/locallang_csh_tx_t3quotes_domain_model_ttcontent.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_t3quotes_domain_model_ttcontent');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
            $extKey,
            'tx_t3quotes_domain_model_t3quotes'
        );

    },
    $_EXTKEY
);
