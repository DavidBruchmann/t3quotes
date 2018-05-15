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

    /**
     * ttContentRepository
     *
     * @var \WDB\T3quotes\Domain\Repository\TtContentRepository
     * @inject
     */
    protected $ttContentRepository = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    protected $storagePageIds = [0];

    protected $languageFile = 'LLL:EXT:t3quotes/Resources/Private/Language/locallang.xlf';

    protected $repositoryNamespace = 'WDB\T3quotes\Domain\Repository';

//    /**
//     * @var string
//     * @api
//     */
//    protected $namespacesViewObjectNamePattern = '@vendor\@extension\View\@controller\@action@format';

    public function initializeAction()
    {
        // $this->configuration consists of interpreted typoscript-setup for this extension
        // $this->configuration['view'] is not yet parsed / interpreted at this point
        $this->configuration = $this->configurationManager->getConfiguration($this->configurationManager::CONFIGURATION_TYPE_FRAMEWORK);

        // TODO: nice error-message if $this->configuration['view'] is not found (means no template included)
        $typoScriptService = $this->objectManager->get(\TYPO3\CMS\Extbase\Service\TypoScriptService::class);
        if (!isset($this->configuration['view'])) {
            // TODO: show hint: configuration not loaded
        }
        $this->configuration['view'] = $typoScriptService->convertPlainArrayToTypoScriptArray($this->configuration['view']);

        // Adding Version Information to use in Templates
        $typo3Version = \TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version();
        $this->settings['typo3Version'] = $typo3Version;
        $this->settings['typo3VersionArray'] = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionStringToArray($typo3Version);

        if (!is_object($this->t3quotesRepository)) {
            $this->t3quotesRepository = $this->objectManager->get($this->repositoryNamespace . '\t3quotesRepository');
        }
        if (!is_object($this->ttContentRepository)) {
            $this->ttContentRepository = $this->objectManager->get($this->repositoryNamespace . '\TtContentRepository');
        }
        if (!is_object($this->persistenceManager)) {
            $this->persistenceManager = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager');
        }

        $this->storagePageIds = \WDB\T3quotes\Utilities\ArrayUtility::getStoragePids($this->getContentObject(), $this->configuration);
        $this->t3quotesRepository->setStoragePageIds($this->storagePageIds);
        $this->t3quotesRepository->initializeObject();

        // @see initTsConstantsCache() to activate
        // $this->initTsConstantsCache();

        $this->view = $this->objectManager->get(\WDB\T3quotes\View\T3quotesView::class);
        if (!isset($this->view)) {
            $this->view = $this->objectManager->get(\TYPO3\CMS\Extbase\Mvc\View\NotFoundView::class);
            $this->view->assign('errorMessage', 'No template was found. View could not be resolved for action "'
                . $this->request->getControllerActionName() . '" in class "' . $this->request->getControllerObjectName() . '"');
        }
        if (method_exists($this->view, 'injectSettings') && $this->settings) {
            $this->view->injectSettings($this->settings);
        }

        $this->configuration['view']['layoutRootPaths'] = \WDB\T3quotes\Utilities\ArrayUtility::parseViewPaths($this->configuration['view']['layoutRootPaths.']);
        $this->configuration['view']['templateRootPaths'] = \WDB\T3quotes\Utilities\ArrayUtility::parseViewPaths($this->configuration['view']['templateRootPaths.']);
        $this->configuration['view']['partialRootPaths'] = \WDB\T3quotes\Utilities\ArrayUtility::parseViewPaths($this->configuration['view']['partialRootPaths.']);

        $this->view->setLayoutRootPaths($this->configuration['view']['layoutRootPaths']);
        $this->view->setTemplateRootPaths($this->configuration['view']['templateRootPaths']);
        $this->view->setPartialRootPaths($this->configuration['view']['partialRootPaths']);
    }

    /**
     * action list
     *
     * @param string shortcode for message to show in some cases
     * @return void
     */
    public function listAction($msg='')
    {
        $t3quotes = $this->t3quotesRepository->findAll();
        $this->callFlashMessage($msg);
        $this->view->assign('t3quotes', $t3quotes);
    }

    /**
     * action show
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @param string shortcode for message to show in some cases
     * @return void
     */
    public function showAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote = null, $msg='')
    {
        if (!$t3quote) {
            $arguments = $this->request->getArguments();
            $t3quote = $this->t3quotesRepository->findByUid(intval($arguments['t3quote']));
        }
        $this->callFlashMessage($msg);
        $this->view->assign('t3quote', $t3quote);
    }

    /**
     * action new
     * @param string shortcode for message to show in some cases
     *
     * @return void
     */
    public function newAction($msg='')
    {
        if ($this->checkNewActionAccess()) {
            $this->callFlashMessage($msg);
            $t3quote = $this->objectManager->get('WDB\T3quotes\Domain\Model\T3quotes');
            $t3quote->setDate(new \DateTime('now'));
            $t3quote->weights = \WDB\T3quotes\Utilities\ArrayUtility::getWeights();
            $this->view->assign('t3quote', $t3quote);
        } else {
            $this->redirect('show', 'T3quotes', 't3quotes', ['t3quote'=>$t3quote, 'msg'=>'error_newAction.noAccess']);
        }
    }

    public function initializeCreateAction()
    {
        $this->arguments['newT3quote']
            ->getPropertyMappingConfiguration()
            ->forProperty('date')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
                \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'Y-m-d'
            );
        $this->arguments['newT3quote']
            ->getPropertyMappingConfiguration()
            ->forProperty('weight')
            ->setTypeConverterOption(
                'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\IntegerConverter',
                '', ''
            );
    }

    /**
     * action create
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $newT3quotes
     * @param string shortcode for message to show in some cases
     * @return void
     */
    public function createAction(\WDB\T3quotes\Domain\Model\T3quotes $newT3quote, $msg='')
    {
        // $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);

        if ($this->checkCreateActionAccess()) {
            $this->callFlashMessage($msg);
            $LANG = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Lang\LanguageService::class);
            $pid = \WDB\T3quotes\Utilities\ArrayUtility::getSingleStoragePid($this->getContentObject(), $this->configuration);
            $newT3quote->setPid($pid);
            $this->t3quotesRepository->add($newT3quote);
            $this->persistenceManager->persistAll();
            // $uid = $newT3quote->getUid();

            // TODO: add choice for action/template [update | show | list]
            $this->redirect('list', 'T3quotes', 't3quotes', ['t3quote'=>$newT3quote, 'msg'=>'ok_createAction.created']);
        } else {
            $this->redirect('list', 'T3quotes', 't3quotes', ['msg'=>'error_createAction.noAccess']);
        }
    }

    public function initializeEditAction()
    {
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
            );
    }

    /**
     * action edit
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @param string shortcode for message to show in some cases
     * @ignorevalidation $t3quotes
     * @return void
     */
    public function editAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote, $msg='')
    {
        if ($this->checkEditActionAccess()) {
            $this->callFlashMessage($msg);
            $t3quote->weights = \WDB\T3quotes\Utilities\ArrayUtility::getWeights();
            $this->view->assign('t3quote', $t3quote);
        } else {
            $this->redirect('show', 'T3quotes', 't3quotes', ['t3quote'=>$t3quote, 'msg'=>'error_editAction.noAccess']);
        }
    }

    public function initializeUpdateAction()
    {
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
            );
    }

    /**
     * action update
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @param string shortcode for message to show in some cases
     * @return void
     */
    public function updateAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote, $msg='')
    {
        // $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        if ($this->checkUpdateActionAccess()) {
            $this->callFlashMessage($msg);
            // $t3quote->setDate(new \DateTime( $t3quotes->getDate() ));
            $this->t3quotesRepository->update($t3quote);
            $LANG = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Lang\LanguageService::class);
            if (!is_object($t3quote)) {
                $t3quote = $this->objectManager->get('WDB\T3quotes\Domain\Model\T3quotes');
                $this->redirect('edit', 'T3quotes', 't3quotes', ['t3quote'=>$t3quote, 'msg'=>'error_updateAction.noObject']);
            } else {
                // TODO: add choice for action/template [update | show | list]
                $this->redirect('show', 'T3quotes', 't3quotes', ['t3quote'=>$t3quote, 'msg'=>'ok_updateAction.updated']);
            }
            // $this->t3quotesRepository->persistenceManager->persistAll(); TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager.
            // $t3quote = is_object($t3quote) ? $t3quote : $this->objectManager->get('WDB\T3quotes\Domain\Model\T3quotes');
            // $this->view->assign('t3quote', $t3quote);
        } else {
            $this->redirect('show', 'T3quotes', 't3quotes', ['t3quote'=>$t3quote, 'msg'=>'error_updateAction.noAccess']);
        }
    }

    /**
     * action delete
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @param string shortcode for message to show in some cases
     * @return void
     */
    public function deleteAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote, $msg='')
    {
        // $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        if ($this->checkDeleteActionAccess()) {
            $this->callFlashMessage($msg);
            $this->t3quotesRepository->remove($t3quote);
            $this->redirect('list', 'T3quotes', 't3quotes', ['t3quote'=>$t3quote, 'msg'=>'ok_deleteAction.deleted']);
        } else {
            $this->redirect('list', 'T3quotes', 't3quotes', ['t3quote'=>$t3quote, 'msg'=>'error_deleteAction.noAccess']);
        }
    }

    protected function checkEditAccess()
    {
        return true;
    }

    protected function checkNewActionAccess()
    {
        return $this->checkEditAccess();
    }

    protected function checkCreateActionAccess()
    {
        return $this->checkEditAccess();
    }

    protected function checkEditActionAccess()
    {
        return $this->checkEditAccess();
    }

    protected function checkUpdateActionAccess()
    {
        return $this->checkEditAccess();
    }

    protected function checkDeleteActionAccess()
    {
        return $this->checkEditAccess();
    }

    /**
     * Getting $cObj with data of the current CE if possible
     *
     * @TODO: is there a way to find that of the current active CE (for create-action)
     *        instead of crawling the records of the current page?
     *
     * @return object \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected function getContentObject()
    {
        $cObj = $this->configurationManager->getContentObject();
        if (isset($cObj->data['uid']) && $cObj->getCurrentTable()=='tt_content') {
            return $cObj;
        } else {
            $currentRecord = explode(':', $GLOBALS['TSFE']->currentRecord);
            $table = $currentRecord[0];
            if ($table==='tt_content') {
                $uid = $currentRecord[1];
                $data = $this->ttContentRepository->findByUid($uid);
                $cObj->start($data->toArray(), $table);
                $cObj->currentRecord = $table . ':' . $uid;
            } else {
                if (in_array($this->resolveActionMethodName(), ['createAction'])) {
                    $records = $this->ttContentRepository->findByPid($GLOBALS['TSFE']->id);
                    if (count($records)) {
                        $pidArray = [];
                        foreach ($records as $count => $record) {
                            $pidArray[] = implode(',', array_map('intval', explode(',', $record->getPages())));
                        }
                        $data = $record->toArray();
                        $data['pages'] = implode(',', $pidArray);
                        $data['pid'] = $GLOBALS['TSFE']->id;
                        $cObj->start($data, 'tt_content');
                        $cObj->currentRecord = 'tt_content:' . $record->getUid();
                    }
                }
            }
        }
        return $cObj;
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

        $this->view->setControllerContext($this->controllerContext);
        $this->view->initializeView();

        // In TYPO3.Flow, solved through Object Lifecycle methods, we need to call it explicitly
        $this->view->assign('settings', $this->settings);
        // same with settings injection.
        return $this->view;
    }

    /**
     * @see // https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/FlashMessages/Index.html?highlight=flashmessage
     *
     * @param string in special format like "ok_deleteAction.deleted" [SERVERITY_ACTION.MESSAGE]
     */
    protected function callFlashMessage($message)
    {
        if ($message) {
            $LANG = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Lang\LanguageService::class);
            $header = '';
            $msg = '';
            $severity = 0;
            $parts = explode('_', $message);
            if (in_array($parts[0], ['notice', 'info', 'ok', 'warning', 'error'])) {
                $header = $LANG->sL($this->languageFile . ':tx_t3quotes_domain_model_t3quotes.flashMessages.headlines.' . $parts[0]);
                $severity = constant('\TYPO3\CMS\Core\Messaging\AbstractMessage::' . strtoupper($parts[0]));
                /*
                switch($parts[0])
                {
                    case 'notice': $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::NOTICE; break; // -2
                    case 'info': $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO; break; // -1
                    case 'ok': $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::OK; break; // 0
                    case 'warning': $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING; break; // 1
                    case 'error': $severity = \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR; break; // 2
                }
                */
            }
            $msgParts = explode('.', $parts[1]);
            if (in_array($msgParts[0], ['createAction', 'deleteAction', 'editAction', 'listAction', 'newAction', 'showAction', 'updateAction'])) {
                $msg = $LANG->sL($this->languageFile . ':tx_t3quotes_domain_model_t3quotes.controllerMessages.' . $msgParts[0] . '.' . $msgParts[1]);
            }
            if ($header || $msg) {
                $this->addFlashMessage(
                    $msg,
                    $header,
                    $severity,
                    $storeInSession = ($severity == 'ERROR' ? true : false)
                );
            }
            /*
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(
                [
                    '__METHOD__' => __METHOD__,
                    '$message' => $message,
                    'header' => $header,
                    '$msg' => $msg,
                    '$severity' => $severity
                ],
                $title = null,
                $maxDepth = 12,
                $plainText = false,
                $ansiColors = true,
                $return = false,
                $blacklistedClassNames = array(),
                $blacklistedPropertyNames = null
            );
            */
        }
        return;
    }

    /**
     * cache, not needed
     * can be used to store $GLOBALS['TSFE']->tmpl->flatSetup, which is not available on chached pages,
     * it consists of the typoscript-config and is used for replacements
     * for usage some part in ext_tables.php has to be activated
     *
     * @return void
     */
    protected function initTsConstantsCache()
    {
        $cacheIdentifier = sha1((string)$GLOBALS['TSFE']->newHash);
        $cache = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Cache\\CacheManager')->getCache('t3quotes_t3quotes');
        $cacheConfigurations[$cacheIdentifier]['frontend'] = [];
        // $cache->setCacheConfigurations( $cacheConfigurations[$cacheIdentifier]['frontend'] );

        // storing flatSetup in cache if existing
        // or retrieving flatSetup from cache if not existing
        $flatSetup = $GLOBALS['TSFE']->tmpl->flatSetup;
        if (is_array($flatSetup) && count($flatSetup)) {
            // saving $flatSetup in cache
            $tsConfigFlat = [];
            foreach ($flatSetup as $key => $value) {
                if (strpos($key, 'plugin.tx_t3quotes_t3quotes') !== false) {
                    $tsConfigFlat[$key] = $value;
                }
            }
            $this->viewSetupRaw = $this->configuration['view'];
            $this->viewSetup = \WDB\T3quotes\Utilities\ArrayUtility::substituteTyposcriptConstants($this->viewSetupRaw, $tsConfigFlat);
            $cache->set($cacheIdentifier, $flatSetup); // , $tags, $lifetime
        } else {
            // restoring $flatSetup from cache
            $this->viewSetup = $cache->get($cacheIdentifier);
        }
    }
}
