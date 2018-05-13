<?php

namespace WDB\T3quotes\Utilities;

/***
 *
 * This file is part of the "Quotes database" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 David Bruchmann <david.bruchmann@gmail.com>, Webdevelopment Barlian
 *
 ***/

/**
 * ArrayUtility
 *
 */
class ArrayUtility
{
    /**
     * Getting first storagePid that is found with priority CE and then TypoScript if not set in CE
     *
     * @see:  getStoragePids()
     * @see:  \WDB\T3quotes\Controller\T3quotesController->getContentObject()
     *
     * @return int
     */
    public static function getSingleStoragePid($cObject, $configuration)
    {
        $pids = self::getStoragePids($cObject, $configuration);
        return intval($pids[0]);
    }

    /**
     * Getting storagePids with priority CE and then TypoScript if not set in CE
     *
     * @see:  \WDB\T3quotes\Controller\T3quotesController->getContentObject()
     *
     * @return array
     */
    public static function getStoragePids($cObject, $configuration)
    {
        $pids = [0];
        if (isset($cObject->data['pages'])) {
            $pids = array_map('intval', explode(',',$cObject->data['pages']));
        }
        if (!count($pids) && isset($configuration['persistence']['storagePid'])) {
            $pids = array_map('intval', explode(',',$configuration['persistence']['storagePid']));
        }
        return $pids;
    }

    public static function parseViewPaths(array $paths)
    {
        foreach ($paths as $key => $pathConfig) {
            if (array_key_exists($key . '.', $paths)) {
                $paths[$key] = self::parseSinglePath($paths[$key], $paths[$key . '.']);
                unset($paths[$key . '.']);
            }
        }
        return $paths;
    }

    /**
     * Adds the possibility to write paths in TypoScript dynamically as any COA
     *
     * @param string $name [TEXT, COA, ...]
     * @param array  $pathConfig as TypoScript
     *
     * @return string $path
     */
    public static function parseSinglePath($name, array $pathConfig)
    {
        $path = '';
        $cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer::class);
        $conf = [
            '10'  => $name,
            '10.' => $pathConfig
        ];
        $path = $cObj->cObjGet($conf);
        return $path;
    }

    public static function getWeights()
    {
        $weights = [];
        $options = ['100', '0', '-100'];
        foreach ($options as $count => $option) {
            $weight = [];
            $weight['key'] = $option;
            $weight['value'] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.weight.I.' . $count, 't3quotes');
            $weights[] = $weight;
        }
        return $weights;
    }

    /**
     * Not used currently
     * required if cache with flat setup shall be used in \WDB\T3quotes\Controller\T3quotesController->initializeAction(), ...
     * which would be required to store constants-configuration of TypoScript (contrary to setup-configuration)
     */
    public static function substituteTyposcriptConstants($typoScript, $flatConstantArray)
    {
        if (is_array($typoScript)) {
            foreach ($typoScript as $key => $value) {
                if (is_array($value)) {
                    $this->substituteConstants($value, $flatConstantArray);
                } else {
                    foreach ($flatConstantArray as $flatConstant => $flatValue) {
                        if ($value === '{$' . $flatConstant . '}') {
                            $typoScript[$key] = $flatValue;
                        } else {
                            $typoScript[$key] = preg_replace('/(\{\$' . $flatConstant . '\})/i', $flatValue, $value);
                        }
                    }
                }
            }
        }
        return $typoScript;
    }
}
