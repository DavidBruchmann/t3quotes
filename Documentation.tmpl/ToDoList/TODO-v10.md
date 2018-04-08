FOR TYPO3 v10:
==============
WDB\T3quotes\Controller\T3quotesController:
-------------------------------------------
@TODO Feature:  #82869 - Replace @inject with @TYPO3\CMS\Extbase\Annotation\Inject (deprecated: 9.0, removed: 10.0)
                @var \WDB\T3quotes\Domain\Repository\T3quotesRepository
                @inject
                protected $t3quotesRepository = null;
@TODO: Feature: #83094 - Replace @ignorevalidation with @TYPO3\CMS\Extbase\Annotation\IgnoreValidation (deprecated: 9.0, removed: 10)
                action edit
                @param \WDB\T3quotes\Domain\Model\T3quotes $t3quote
                @ignorevalidation $t3quotes