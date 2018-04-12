<?php
namespace WDB\T3quotes\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Kasper Skårhøj (2002) <kasper@typo3.com>
 * @author David Bruchmann <david.bruchmann@gmail.com>
 */
class T3quotesTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \WDB\T3quotes\Domain\Model\T3quotes
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \WDB\T3quotes\Domain\Model\T3quotes();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getPrefaceReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPreface()
        );
    }

    /**
     * @test
     */
    public function setPrefaceForStringSetsPreface()
    {
        $this->subject->setPreface('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'preface',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getQuoteReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getQuote()
        );
    }

    /**
     * @test
     */
    public function setQuoteForStringSetsQuote()
    {
        $this->subject->setQuote('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'quote',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFullContextReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFullContext()
        );

    }

    /**
     * @test
     */
    public function setFullContextForStringSetsFullContext()
    {
        $this->subject->setFullContext('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'fullContext',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAuthorNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAuthorName()
        );
    }

    /**
     * @test
     */
    public function setAuthorNameForStringSetsAuthorName()
    {
        $this->subject->setAuthorName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'authorName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAuthorEmailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAuthorEmail()
        );
    }

    /**
     * @test
     */
    public function setAuthorEmailForStringSetsAuthorEmail()
    {
        $this->subject->setAuthorEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'authorEmail',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAuthorTitleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAuthorTitle()
        );
    }

    /**
     * @test
     */
    public function setAuthorTitleForStringSetsAuthorTitle()
    {
        $this->subject->setAuthorTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'authorTitle',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWeightReturnsInitialValueForInt()
    {
    }

    /**
     * @test
     */
    public function setWeightForIntSetsWeight()
    {
    }

    /**
     * @test
     */
    public function getDateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getDate()
        );
    }

    /**
     * @test
     */
    public function setDateForDateTimeSetsDate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'date',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSelectedReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getSelected()
        );
    }

    /**
     * @test
     */
    public function setSelectedForBoolSetsSelected()
    {
        $this->subject->setSelected(true);

        self::assertAttributeEquals(
            true,
            'selected',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRotationQuoteReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getRotationQuote()
        );
    }

    /**
     * @test
     */
    public function setRotationQuoteForStringSetsRotationQuote()
    {
        $this->subject->setRotationQuote('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'rotationQuote',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAuthstateReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getAuthstate()
        );
    }

    /**
     * @test
     */
    public function setAuthstateForBoolSetsAuthstate()
    {
        $this->subject->setAuthstate(true);

        self::assertAttributeEquals(
            true,
            'authstate',
            $this->subject
        );
    }
}
