<?php
namespace WDB\T3quotes\Domain\Repository;

/***
 *
 * This file is part of the "Quotes database" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Kasper Skårhøj (2002) <kasper@typo3.com>, Curby Soft Multimedia
 *           David Bruchmann <david.bruchmann@gmail.com>, Webdevelopment Barlian
 *
 ***/

/**
 * The repository for T3quotes
 */
class T3quotesRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    /**
     * Initializes the repository.
     */
    public function initializeObject()
    {
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        # $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        
        // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see #51529 for details
        # $defaultQuerySettings = $this->createQuery()->getQuerySettings();
        
        # \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array('method' => __METHOD__,'$querySettings'=>$querySettings));
        
        // don't add the pid constraint
        # $querySettings->setRespectStoragePage(TRUE);
        # $querySettings->setRespectStoragePage(false);
        
        // set the storagePids to respect
        // TODO:
        $querySettings->setStoragePageIds(array(2));
        
			// don't add fields from enablecolumns constraint
			// this function is deprecated!
			// not existing in version 8.7.10
			# setRespectEnableFields(FALSE);
        
        // define the enablecolumn fields to be ignored
        // if nothing else is given, all enableFields are ignored
        # $querySettings->setIgnoreEnableFields(TRUE);
        
        // define single fields to be ignored
        # $querySettings->setEnableFieldsToBeIgnored(array('disabled','starttime'));
        
        // add deleted rows to the result
        # $querySettings->setIncludeDeleted(TRUE);
        
        // don't add sys_language_uid constraint
        # $querySettings->setRespectSysLanguage(FALSE);
        
        // perform translation to dedicated language
        # $querySettings->setSysLanguageUid(42);
        # $querySettings->setLanguageUid(42);
        
        # $querySettings->setLanguageOverlayMode();
        
        # $querySettings->setLanguageMode();
        
        # $querySettings->setUsePreparedStatement();
        
        
        $t3Version = \TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version( TYPO3_version );
		if(version_compare($t3Version, '9.0.0', '<'))
		{
			$querySettings->useQueryCache(FALSE);
		}
        
        
/*
\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
	'method' => __METHOD__,
	'$querySettings'=>$querySettings,
	'debug_backtrace()'=>debug_backtrace()
));
*/
        $this->setDefaultQuerySettings($querySettings);
    }

    public function findAll()
    {
        $query = $this->createQuery();
        $result = $query->execute();
        # \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(''method' => __METHOD__,$query'=>$query,'$result'=>$result)); //->persistenceManager
        return $result;
    }
}
