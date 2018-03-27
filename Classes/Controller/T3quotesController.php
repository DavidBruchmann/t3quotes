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

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $t3quotes = $this->t3quotesRepository->findAll();

\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
	'method' => __METHOD__,
	'$this->view'=>$this->view,
	'debug_backtrace' => debug_backtrace()
));

        $this->view->assign('t3quotes', $t3quotes);
    }

    /**
     * action show
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
     * @return void
     */
    public function showAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quote = NULL)
    {
		if(!$t3quote)
		{
			$arguments = $this->request->getArguments();
			$t3quote = $this->t3quotesRepository->findByUid( intval($arguments['t3quote']) );
		}
		$this->view->assign('t3quote', $t3quote);
\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
	'method' => __METHOD__,
	'$this->view'=>$this->view,
	'debug_backtrace' => debug_backtrace(),
	'$t3quote' => $t3quote,
	'$this->request->getArguments()' => $this->request->getArguments(),
	'$this->arguments' => $this->arguments
));
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
		$this->view->assign('t3quote', $t3quote);
    }
    
    public function initializeCreateAction()
    {
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
			# '$this->arguments' => $this->arguments,
			'$this->arguments[newT3quotes]' => $this->arguments['newT3quotes'],
		));
		
		$this->arguments['newT3quotes']
			->getPropertyMappingConfiguration()
			->forProperty('date')
			->setTypeConverterOption(
				'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
				\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'Y-m-d'
			);
		$this->arguments['newT3quotes']
			->getPropertyMappingConfiguration()
			->forProperty('weight')
			->setTypeConverterOption(
				'TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\IntegerConverter',
				'', ''
				#\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'Y-m-d'
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
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->t3quotesRepository->add($newT3quotes);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quotes
     * @ignorevalidation $t3quotes
     * @return void
     */
    public function editAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quotes)
    {
        $this->view->assign('t3quotes', $t3quotes);
    }

    /**
     * action update
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quotes
     * @return void
     */
    public function updateAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quotes)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->t3quotesRepository->update($t3quotes);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \WDB\T3quotes\Domain\Model\T3quotes $t3quotes
     * @return void
     */
    public function deleteAction(\WDB\T3quotes\Domain\Model\T3quotes $t3quotes)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->t3quotesRepository->remove($t3quotes);
        $this->redirect('list');
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
        
        # $this->settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
        
        $this->typoScript = $this->configurationManager->getConfiguration( $this->configurationManager::CONFIGURATION_TYPE_FRAMEWORK );
        
        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
			'method' => __METHOD__,
			'$this->configurationManager' => $this->configurationManager,
			'$this->settings'=>$this->settings,
			'$this->typoScript' => $this->typoScript,
			'typoScript layoutRootPaths' => $this->typoScript['view']['layoutRootPaths']
		));
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
\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
	'method' => __METHOD__,
	'$this->typoScript' => $this->typoScript,
	'$this->settings' => $this->settings,
	'$this->configurationManager' => $this->configurationManager
));
        $this->view->setLayoutRootPaths( $this->typoScript['view']['layoutRootPaths'] );
        $this->view->setTemplateRootPaths( $this->typoScript['view']['templateRootPaths'] );
        $this->view->setPartialRootPaths( $this->typoScript['view']['partialRootPaths'] );
        
        $actionName = $this->resolveActionMethodName();
        $templateName = substr($actionName, 0, -strlen('Action'));

        // TODO: special templates for new, create, delete, etc.

        $templatePathAndFilename = $this->typoScript['view']['templateRootPaths'][1].'T3quotes/'.ucfirst($templateName).'.html';
        $this->view->setTemplatePathAndFilename($templatePathAndFilename);
        
\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
	'method' => __METHOD__,
	'getFormat' => $this->view->getFormat(),
	'getRequest' => $this->view->getRequest(),
	'$templatePathAndFilename' => $templatePathAndFilename,
	'getTemplatePathAndFilename' => $this->view->getTemplatePathAndFilename(),
	#'getLayoutRootPath'=>$this->view->getLayoutRootPath(),
	'getLayoutRootPaths' => $this->view->getLayoutRootPaths(),
	#'getPartialRootPath'=>$this->view->getPartialRootPath(),
	'getPartialRootPaths' => $this->view->getPartialRootPaths(),
	# 'getTemplateSource' => $this->view->getTemplateSourcePublic(),
	# 'getTemplateRootPaths'=>$this->view->getTemplateRootPaths(),
	'hasTemplate' => $this->view->hasTemplate(),
	'backtrace' => debug_backtrace(),
	# '$this->controllerContext' => $this->controllerContext,
	'$viewObjectName'=> $viewObjectName,
	'$actionName' => $actionName,
	'$templateName' => $templateName,
));
        
        # $view->setTemplateSource( file_get_contents($this->typoScript['view']['layoutRootPaths'][1]) );
        
        
        #if(in_array($actionName,array('list','')))
        
        $this->view->setControllerContext($this->controllerContext);
        $this->view->initializeView();
        // In TYPO3.Flow, solved through Object Lifecycle methods, we need to call it explicitly
        $this->view->assign('settings', $this->settings);
        // same with settings injection.
        return $this->view;
    }

    /**
     * Determines the fully qualified view object name.
     *
     * @return mixed The fully qualified view object name or FALSE if no matching view could be found.
     * @api
     */
    /*
    protected function resolveViewObjectName()
    {
        $vendorName = $this->request->getControllerVendorName();
        if ($vendorName === null) {
            return false;
        }

        $possibleViewName = str_replace(
            [
                '@vendor',
                '@extension',
                '@controller',
                '@action'
            ],
            [
                $vendorName,
                $this->request->getControllerExtensionName(),
                $this->request->getControllerName(),
                ucfirst($this->request->getControllerActionName())
            ],
            $this->namespacesViewObjectNamePattern
        );
        $format = $this->request->getFormat();
        $viewObjectName = str_replace('@format', ucfirst($format), $possibleViewName);
        if (class_exists($viewObjectName) === false) {
            $viewObjectName = str_replace('@format', '', $possibleViewName);
        }
        if (isset($this->viewFormatToObjectNameMap[$format]) && class_exists($viewObjectName) === false) {
            $viewObjectName = $this->viewFormatToObjectNameMap[$format];
        }
        return class_exists($viewObjectName) ? $viewObjectName : false;
    }
    */

}
