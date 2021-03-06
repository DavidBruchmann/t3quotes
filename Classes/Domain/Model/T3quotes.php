<?php
namespace WDB\T3quotes\Domain\Model;

/***
 *
 * This file is part of the "Quotes database" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Kasper Skårhøj (2002)
 *           David Bruchmann <david.bruchmann@gmail.com>, Webdevelopment Barlian
 *
 ***/

/**
 * T3quotes
 */
class T3quotes extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * preface
     *
     * @var string
     */
    protected $preface = '';

    /**
     * quote
     *
     * @var string
     */
    protected $quote = '';

    /**
     * fullContext
     *
     * @var string
     */
    protected $fullContext = '';

    /**
     * authorName
     *
     * @var string
     */
    protected $authorName = '';

    /**
     * authorEmail
     *
     * @var string
     */
    protected $authorEmail = '';

    /**
     * authorTitle
     *
     * @var string
     */
    protected $authorTitle = '';

    /**
     * weight
     *
     * @var int
     */
    protected $weight = 0;

    /**
     * date
     *
     * @var \DateTime
     */
    protected $date = null;

    /**
     * selected
     *
     * @var bool
     */
    protected $selected = false;

    /**
     * rotationQuote
     *
     * @var string
     */
    protected $rotationQuote = '';

    /**
     * authstate
     *
     * @var bool
     */
    protected $authstate = false;

    /**
     * Returns the preface
     *
     * @return string $preface
     */
    public function getPreface()
    {
        return $this->preface;
    }

    /**
     * Sets the preface
     *
     * @param string $preface
     * @return void
     */
    public function setPreface($preface)
    {
        $this->preface = $preface;
    }

    /**
     * Returns the quote
     *
     * @return string $quote
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * Sets the quote
     *
     * @param string $quote
     * @return void
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;
    }

    /**
     * Returns the fullContext
     *
     * @return string $fullContext
     */
    public function getFullContext()
    {
        return $this->fullContext;
    }

    /**
     * Sets the fullContext
     *
     * @param string $fullContext
     * @return void
     */
    public function setFullContext($fullContext)
    {
        $this->fullContext = $fullContext;
    }

    /**
     * Returns the authorName
     *
     * @return string $authorName
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Sets the authorName
     *
     * @param string $authorName
     * @return void
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * Returns the authorEmail
     *
     * @return string $authorEmail
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Sets the authorEmail
     *
     * @param string $authorEmail
     * @return void
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
    }

    /**
     * Returns the authorTitle
     *
     * @return string $authorTitle
     */
    public function getAuthorTitle()
    {
        return $this->authorTitle;
    }

    /**
     * Sets the authorTitle
     *
     * @param string $authorTitle
     * @return void
     */
    public function setAuthorTitle($authorTitle)
    {
        $this->authorTitle = $authorTitle;
    }

    /**
     * Returns the weight
     *
     * @return int $weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Sets the weight
     *
     * @param int $weight
     * @return void
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * Returns the date
     *
     * @return \DateTime $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date=null)
    {
        $this->date = $date;
    }

    /**
     * Returns the selected
     *
     * @return bool $selected
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * Sets the selected
     *
     * @param bool $selected
     * @return void
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;
    }

    /**
     * Returns the boolean state of selected
     *
     * @return bool
     */
    public function isSelected()
    {
        return $this->selected;
    }

    /**
     * Returns the rotationQuote
     *
     * @return string $rotationQuote
     */
    public function getRotationQuote()
    {
        return $this->rotationQuote;
    }

    /**
     * Sets the rotationQuote
     *
     * @param string $rotationQuote
     * @return void
     */
    public function setRotationQuote($rotationQuote)
    {
        $this->rotationQuote = $rotationQuote;
    }

    /**
     * Returns the authstate
     *
     * @return bool $authstate
     */
    public function getAuthstate()
    {
        return $this->authstate;
    }

    /**
     * Sets the authstate
     *
     * @param bool $authstate
     * @return void
     */
    public function setAuthstate($authstate)
    {
        $this->authstate = $authstate;
    }

    /**
     * Returns the boolean state of authstate
     *
     * @return bool
     */
    public function isAuthstate()
    {
        return $this->authstate;
    }
}
