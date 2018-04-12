<?php
namespace WDB\T3quotes\Tests\Unit\Controller;

// For testing extbase-based extensions, your testcases need to extend Tx_Extbase_Tests_Unit_BaseTestCase instead of Tx_Phpunit_TestCase.

/**
 * Test case.
 *
 * @author Kasper Skårhøj (2002) <kasper@typo3.com>
 * @author David Bruchmann <david.bruchmann@gmail.com>
 */
class T3quotesControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \WDB\T3quotes\Controller\T3quotesController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\WDB\T3quotes\Controller\T3quotesController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllT3quotessFromRepositoryAndAssignsThemToView()
    {
        $allT3quotess = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $t3quotesRepository = $this->getMockBuilder(\WDB\T3quotes\Domain\Repository\T3quotesRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $t3quotesRepository->expects(self::once())->method('findAll')->will(self::returnValue($allT3quotess));
        $this->inject($this->subject, 't3quotesRepository', $t3quotesRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('t3quotess', $allT3quotess);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenT3quotesToView()
    {
        $t3quotes = new \WDB\T3quotes\Domain\Model\T3quotes();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('t3quotes', $t3quotes);

        $this->subject->showAction($t3quotes);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenT3quotesToT3quotesRepository()
    {
        $t3quotes = new \WDB\T3quotes\Domain\Model\T3quotes();

        $t3quotesRepository = $this->getMockBuilder(\WDB\T3quotes\Domain\Repository\T3quotesRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $t3quotesRepository->expects(self::once())->method('add')->with($t3quotes);
        $this->inject($this->subject, 't3quotesRepository', $t3quotesRepository);

        $this->subject->createAction($t3quotes);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenT3quotesToView()
    {
        $t3quotes = new \WDB\T3quotes\Domain\Model\T3quotes();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('t3quotes', $t3quotes);

        $this->subject->editAction($t3quotes);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenT3quotesInT3quotesRepository()
    {
        $t3quotes = new \WDB\T3quotes\Domain\Model\T3quotes();

        $t3quotesRepository = $this->getMockBuilder(\WDB\T3quotes\Domain\Repository\T3quotesRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $t3quotesRepository->expects(self::once())->method('update')->with($t3quotes);
        $this->inject($this->subject, 't3quotesRepository', $t3quotesRepository);

        $this->subject->updateAction($t3quotes);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenT3quotesFromT3quotesRepository()
    {
        $t3quotes = new \WDB\T3quotes\Domain\Model\T3quotes();

        $t3quotesRepository = $this->getMockBuilder(\WDB\T3quotes\Domain\Repository\T3quotesRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $t3quotesRepository->expects(self::once())->method('remove')->with($t3quotes);
        $this->inject($this->subject, 't3quotesRepository', $t3quotesRepository);

        $this->subject->deleteAction($t3quotes);
    }
}
