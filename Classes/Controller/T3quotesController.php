<?php

namespace WDB\T3quotes\Controller;

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
 * T3quotesController
 *
 */
class T3quotesController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * t3quotesRepository
     *
     * @var \WDB\T3quotes\Domain\Repository\T3quotesRepository
     * @inject
     */
    protected $t3quotesRepository = null;

//    /**
//     * @var string
//     * @api
//     */
//    protected $namespacesViewObjectNamePattern = '@vendor\@extension\View\@controller\@action@format';

    public function initializeAction()
    {
        // cache, not needed
        // can be used to store $GLOBALS['TSFE']->tmpl->flatSetup, which is not available on chached pages,
        // it consists of the typoscript-config and is used for replacements
        //        $cacheIdentifier = sha1((string)$GLOBALS['TSFE']->newHash);
        //        $cache = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Cache\\CacheManager')->getCache('t3quotes_t3quotes');
        //        $cacheConfigurations[$cacheIdentifier]['frontend'] = array();
        //        #$cache->setCacheConfigurations( $cacheConfigurations[$cacheIdentifier]['frontend'] );

        // $this->configuration consists of interpreted typoscript-setup for this extension
        // $this->configuration['view'] is not yet parsed / interpreted at this point
        $this->configuration = $this->configurationManager->getConfiguration($this->configurationManager::CONFIGURATION_TYPE_FRAMEWORK);

        // TODO: nice error-message if $this->configuration['view'] is not found (means no template included)
        $typoScriptService = $this->objectManager->get(\TYPO3\CMS\Extbase\Service\TypoScriptService::class);
        $this->configuration['view'] = $typoScriptService->convertPlainArrayToTypoScriptArray($this->configuration['view']);

        // Adding Version Information to use in Templates
        $typo3Version = \TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version();
        $this->settings['typo3Version'] = $typo3Version;
        $this->settings['typo3VersionArray'] = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionStringToArray($typo3Version);

        /*
        // storing flatSetup in cache if existing
        // or retrieving flatSetup from cache if not existing
        $flatSetup = $GLOBALS['TSFE']->tmpl->flatSetup;
        if(is_array($flatSetup) && count($flatSetup)) {
            // saving $flatSetup in cache
            $tsConfigFlat = array();
            foreach($flatSetup as $key => $value)
            {
                if(strpos($key,'plugin.tx_t3quotes_t3quotes')!==FALSE)
                {
                    $tsConfigFlat[$key] = $value;
                }
            }
            $this->viewSetupRaw = $this->configuration['view'];
            $this->viewSetup = $this->substituteConstants($this->viewSetupRaw, $tsConfigFlat);
            $cache->set($cacheIdentifier, $flatSetup); // , $tags, $lifetime
        }
        else {
            // restoring $flatSetup from cache
            $this->viewSetup = $cache->get($cacheIdentifier);
        }
        */

        $this->view = $this->objectManager->get(\WDB\T3quotes\View\T3quotesView::class);
        if (!isset($this->view)) {
            $this->view = $this->objectManager->get(\TYPO3\CMS\Extbase\Mvc\View\NotFoundView::class);
            $this->view->assign('errorMessage', 'No template was found. View could not be resolved for action "'
                . $this->request->getControllerActionName() . '" in class "' . $this->request->getControllerObjectName() . '"');
        }
        if (method_exists($this->view, 'injectSettings') && $this->settings) {
            $this->view->injectSettings($this->settings);
        }

        $this->configuration['view']['layoutRootPaths'] = $this->parseViewPaths($this->configuration['view']['layoutRootPaths.']);
        $this->configuration['view']['templateRootPaths'] = $this->parseViewPaths($this->configuration['view']['templateRootPaths.']);
        $this->configuration['view']['partialRootPaths'] = $this->parseViewPaths($this->configuration['view']['partialRootPaths.']);

        $this->view->setLayoutRootPaths($this->configuration['view']['layoutRootPaths']);
        $this->view->setTemplateRootPaths($this->configuration['view']['templateRootPaths']);
        $this->view->setPartialRootPaths($this->configuration['view']['partialRootPaths']);

        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__.':'.__LINE__,
            '$this->settings' => $this->settings,
            '$this->configuration' => $this->configuration,
            '$this->view' => $this->view,
            // '$this->viewSetup' => $this->viewSetup,
            // '$templateService ' => $templateService,
            // 'TYPO3\CMS\Core\TypoScript\TemplateService->flatSetup' => $config, //
            'TSFE->tmpl->flatSetup' => $GLOBALS['TSFE']->tmpl->flatSetup,
            'TSFE'=>$GLOBALS['TSFE'],
            'user'=>$GLOBALS['TSFE']->fe_user->user,
            '$cacheIdentifier' => $cacheIdentifier,
            '$flatSetup' => $flatSetup,
            '$this->configuration' => $this->configuration,
            // '$tsConfigFlat' => $tsConfigFlat,
            '$this->request->getArguments()' => $this->request->getArguments(),
            '$_GET' => $_GET,
            '$_POST' => $_POST,
            '_GP' => \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_t3quotes_t3quotes'),
        ));
        */
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $t3quotes = $this->t3quotesRepository->findAll();

        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__,
            '$this->view'=>$this->view,
            'debug_backtrace' => debug_backtrace()
        ));
        */

        $this->view->assign('t3quotes', $t3quotes);
    }

    /**
     * action show
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @return void
     */
    public function showAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote = null)
    {
        if (!$t3quote) {
            $arguments = $this->request->getArguments();
            $t3quote = $this->t3quotesRepository->findByUid(intval($arguments['t3quote']));
        }
        $this->view->assign('t3quote', $t3quote);

        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__,
            '$this->view'=>$this->view,
            'debug_backtrace' => debug_backtrace(),
            '$t3quote' => $t3quote,
            '$this->request->getArguments()' => $this->request->getArguments(),
            '$this->arguments' => $this->arguments
        ));
        */
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $t3quote = $this->objectManager->get('WDB\T3quotes\Domain\Model\T3quotes');
        $t3quote->setDate(new \DateTime('now'));
        $t3quote->weights = $this->getWeights();
        $this->view->assign('t3quote', $t3quote);
    }

    public function getWeights()
    {
        $weights = [];
        $options = ['100', '0', '-100'];
        foreach ($options as $count => $option) {
            $weight = []; // new \stdClass();
            $weight['key'] = $option;
            $weight['value'] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.weight.I.' . $count, 't3quotes');
            $weights[] = $weight;
        }
        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(['method'=>__METHOD__, '$weights'=>$weights]);
        return $weights;
    }

    public function initializeCreateAction()
    {
        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump([
            // '$this->arguments' => $this->arguments,
            '$this->arguments[newT3quotes]' => $this->arguments['newT3quotes'],
        ]);
        */

        $this->arguments['newT3quotes']
            ->getPropertyMappingConfiguration()
            ->forProperty('date')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
                \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d'
            );

        $this->arguments['newT3quotes']
            ->getPropertyMappingConfiguration()
            ->forProperty('weight')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\IntegerConverter',
                '', ''
                // \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d'
            );
    }

    /**
     * action create
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $newT3quotes
     * @return void
     */
    public function createAction(\WDB\T3quotes\Domain\Model\T3quotes $newT3quotes)
    {
        // $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);

        $this->t3quotesRepository->add($newT3quotes);
        $this->redirect('list');
    }

    public function initializeEditAction()
    {
        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__.':'.__LINE__,
            '$this->arguments' => $this->arguments,
            '$this'=>$this,
            '$this->quotes'=>$this->quotes
        ));
        */

        $this->arguments['t3quote']
            ->getPropertyMappingConfiguration()
            ->forProperty('date')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
                \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d'
            );

        $this->arguments['t3quote']
            ->getPropertyMappingConfiguration()
            ->forProperty('weight')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\IntegerConverter',
                '', ''
                // \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d'
            );
    }

    /**
     * action edit
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @ignorevalidation $t3quotes
     * @return void
     */
    public function editAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote)
    {
        $t3quote->weights = $this->getWeights();

        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__.':'.__LINE__,
            '$t3quote' => $t3quote
        ));
        */

        $this->view->assign('t3quote', $t3quote);
    }

    public function initializeUpdateAction()
    {
        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__.':'.__LINE__,
            '$this->arguments' => $this->arguments,
            '$this->quote'=>$this->quote,
            '$this->quotes'=>$this->quotes
        ));
        */

        // for validation of date
        $this->arguments['t3quote']
            ->getPropertyMappingConfiguration()
            ->forProperty('date')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
                \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d'
            );
        // for validation of weight
        $this->arguments['t3quote']
            ->getPropertyMappingConfiguration()
            ->forProperty('weight')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\IntegerConverter',
                '', ''
                // \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d'
            );
    }

    /**
     * action update
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @return void
     */
    public function updateAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote)
    {
        // $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);

        // $t3quote->setDate(new \DateTime( $t3quotes->getDate() ));
        $this->t3quotesRepository->update($t3quote);
        $this->redirect('show', $t3quote);
        // $this->t3quotesRepository->persistenceManager->persistAll(); TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager.

        // $t3quote = is_object($t3quote) ? $t3quote : $this->objectManager->get('WDB\T3quotes\Domain\Model\T3quotes');
        // $this->view->assign('t3quote', $t3quote);
    }

    /**
     * action delete
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @return void
     */
    public function deleteAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote)
    {
        // $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);

        $this->t3quotesRepository->remove($t3quote);
        $this->redirect('list');
    }

    public function parseViewPaths(array $paths)
    {
        foreach ($paths as $key => $pathConfig) {
            if (array_key_exists($key . '.', $paths)) {
                $paths[$key] = $this->resolveSinglePath($paths[$key], $paths[$key . '.']);
                unset($paths[$key . '.']);
            }
        }
        return $paths;
    }

    public function resolveSinglePath($name, array $pathConfig)
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

    public function substituteConstants($typoScript, $flatConstantArray)
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

    /**
     * Prepares a view for the current action.
     * By default, this method tries to locate a view with a name matching the current action.
     *
     * @return ViewInterface
     * @api
     */
    protected function resolveView()
    {
        $viewObjectName = $this->resolveViewObjectName();
        if ($viewObjectName !== false) {
            // @var $view ViewInterface
            $view = $this->objectManager->get($viewObjectName);
            $this->setViewConfiguration($view);
            if ($view->canRender($this->controllerContext) === false) {
                unset($view);
            }
        }

        if (!isset($view) && $this->defaultViewObjectName != '') {
            // @var $view ViewInterface
            $view = $this->objectManager->get($this->defaultViewObjectName);
            $this->setViewConfiguration($view);
            if ($view->canRender($this->controllerContext) === false) {
                unset($view);
            }
        }

        $actionName = $this->resolveActionMethodName();
        $templateName = substr($actionName, 0, -strlen('Action'));

        if (isset($this->configuration['view']['templateRootPaths'][1])
          && !is_array($this->typoScript['view']['templateRootPaths'][1])
          && $this->configuration['view']['templateRootPaths'][1]
        ) {
            // TODO: special templates for new, create, delete, etc. ??
            $templatePathAndFilename = $this->configuration['view']['templateRootPaths'][1] . '/T3quotes/' . ucfirst($templateName) . '.html';
        } else {
            $templatePathAndFilename = $this->configuration['view']['templateRootPaths'][0] . '/T3quotes/' . ucfirst($templateName) . '.html';
        }

        $this->view->setTemplatePathAndFilename($templatePathAndFilename);

        // $view->setTemplateSource( file_get_contents($this->typoScript['view']['layoutRootPaths'][1]) );

        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__,
            'getFormat' => $this->view->getFormat(),
            'getRequest' => $this->view->getRequest(),
            '$templateName' => $templateName,
            '$this->typoScript[\'view\'][\'templateRootPaths\'][1]' => $this->typoScript['view']['templateRootPaths'][1],
            '$templatePathAndFilename' => $templatePathAndFilename,
            'getTemplatePathAndFilename' => $this->view->getTemplatePathAndFilename(),
            // 'getLayoutRootPath'=>$this->view->getLayoutRootPath(),
            'getLayoutRootPaths' => $this->view->getLayoutRootPaths(),
            // 'getPartialRootPath'=>$this->view->getPartialRootPath(),
            'getPartialRootPaths' => $this->view->getPartialRootPaths(),
            // 'getTemplateSource' => $this->view->getTemplateSourcePublic(),
            // 'getTemplateRootPaths'=>$this->view->getTemplateRootPaths(),
            'hasTemplate' => $this->view->hasTemplate(),
            'backtrace' => debug_backtrace(),
            // '$this->controllerContext' => $this->controllerContext,
            '$viewObjectName'=> $viewObjectName,
            '$actionName' => $actionName,
            '$templateName' => $templateName,
        ));
        */

        $this->view->setControllerContext($this->controllerContext);
        $this->view->initializeView();

        // In TYPO3.Flow, solved through Object Lifecycle methods, we need to call it explicitly
        $this->view->assign('settings', $this->settings);
        // same with settings injection.
        return $this->view;
    }
}
