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
    protected $storagePageIds = [0];

    /**
     * @var array
     */
    protected $defaultOrderings = [
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    ];

    /**
     * Initializes the repository.
     */
    public function initializeObject()
    {
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);

        // go for $defaultQuerySettings = $this->createQuery()->getQuerySettings(); if you want to make use of the TS persistence.storagePid with defaultQuerySettings(), see //51529 for details
        // $defaultQuerySettings = $this->createQuery()->getQuerySettings();

        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array('method' => __METHOD__,'$querySettings'=>$querySettings));

        // don't add the pid constraint
        // $querySettings->setRespectStoragePage(TRUE);
        // $querySettings->setRespectStoragePage(false);

        $querySettings->setStoragePageIds($this->storagePageIds);

        //    don't add fields from enablecolumns constraint
        //    this function is deprecated!
        //    not existing in version 8.7.10
        //    setRespectEnableFields(FALSE);

        // define the enablecolumn fields to be ignored
        // if nothing else is given, all enableFields are ignored
        // $querySettings->setIgnoreEnableFields(TRUE);

        // define single fields to be ignored
        // $querySettings->setEnableFieldsToBeIgnored(array('disabled','starttime'));

        // add deleted rows to the result
        // $querySettings->setIncludeDeleted(TRUE);

        // don't add sys_language_uid constraint
        // $querySettings->setRespectSysLanguage(FALSE);

        // perform translation to dedicated language
        // $querySettings->setSysLanguageUid(42);
        // $querySettings->setLanguageUid(42);

        // $querySettings->setLanguageOverlayMode();

        // $querySettings->setLanguageMode();

        // $querySettings->setUsePreparedStatement();

        $t3Version = \TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version(TYPO3_version);
        // // Breaking //80700 - Deprecated functionality removed (9.0)
        // // Breaking //77460 - Extbase query cache removed (8.3)
        if (version_compare($t3Version, '9.0.0', '<')) {
            $querySettings->useQueryCache(false);
        }
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * Returns all objects of this repository.
     *
     * @return QueryResultInterface|array
     * @api
     */
    public function findAll()
    {
        $query = $this->createQuery();
        $query->setOrderings([
            'weight' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
            'date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
        ]);
        return $query->execute();
    }

    /**
     * Replaces an existing object with the same identifier by the given object
     *
     * @param object $modifiedObject The modified object
     * @throws Exception\UnknownObjectException
     * @throws Exception\IllegalObjectTypeException
     * @return void
     * @api
     */
    public function update($modifiedObject)
    {
        if (!$modifiedObject instanceof $this->objectType) {
            throw new \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException('The modified object given to update() was not of the type (' . $this->objectType . ') this repository manages.', 1249479625);
        }
        $this->persistenceManager->update($modifiedObject);
        $this->persistenceManager->persistAll();
    }

    public function setStoragePageIds($storagePageIds)
    {
        $this->storagePageIds = $storagePageIds;
    }

    public function getStoragePageIds()
    {
        return $storagePageIds;
    }
}
