<?php
namespace WDB\T3quotes\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Kasper Skårhøj (2002) <kasper@typo3.com>
 * @author David Bruchmann <david.bruchmann@gmail.com>
 */
class TtContentTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \WDB\T3quotes\Domain\Model\TtContent
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \WDB\T3quotes\Domain\Model\TtContent();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getT3quotesSelectedReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getT3quotesSelected()
        );

    }

    /**
     * @test
     */
    public function setT3quotesSelectedForBoolSetsT3quotesSelected()
    {
        $this->subject->setT3quotesSelected(true);

        self::assertAttributeEquals(
            true,
            't3quotesSelected',
            $this->subject
        );

    }
}
