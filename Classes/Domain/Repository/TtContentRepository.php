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
 * The repository for TtContent
 */
class TtContentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    protected $objectType = '\WDB\T3quotes\Domain\Model\Ttcontent';

    public function findByPid($pid)
    {
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $querySettings->setIgnoreEnableFields(true);
        $this->setDefaultQuerySettings($querySettings);
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('CType', 'list'),
                $query->equals('listType', 't3quotes_t3quotes'),
                // @TODO: The \"in\" operator must be given a multivalued operand (array, ArrayAccess, Traversable).
                // $query->in('pid', $pid, true)
                $query->equals('pid', $pid)
            )
        );
        $result = $query->execute();
        return $result;
    }
}
