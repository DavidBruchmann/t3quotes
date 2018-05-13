<?php
namespace WDB\T3quotes\Domain\Model;

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
 * TtContent
 */
class TtContent extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject
{
    /**
     * @var string
     */
    protected $altText;

    /**
     * @var string
     */
    protected $bodytext;

    /**
     * @var int
     */
    protected $colPos;

    /**
     * @var int
     */
    protected $cols;

    /**
     * @var \DateTime
     */
    protected $crdate;

    /**
     * @var string
     */
    protected $CType;

    /**
     * @var string
     */
    protected $header;

    /**
     * @var string
     */
    protected $headerLayout;

    /**
     * @var string
     */
    protected $headerLink;

    /**
     * @var string
     */
    protected $headerPosition;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var int
     */
    protected $imageborder;

    /**
     * @var string
     */
    protected $imagecaption;

    /**
     * @var int
     */
    protected $imagecols;

    /**
     * @var string
     */
    protected $imageLink;

    /**
     * @var int
     */
    protected $imageorient;

    /**
     * @var int
     */
    protected $imagewidth;

    /**
     * @var string
     */
    protected $imageZoom;

    /**
     * @var string
     */
    protected $layout;

    /**
     * @var string
     */
    protected $listType;

    /**
     * @var string
     */
    protected $media;

    /**
     * @var string
     */
    protected $pages;

    /**
     * @var string
     */
    protected $subheader;

    /**
     * @var string
     */
    protected $titleText;

    /**
     * @var \DateTime
     */
    protected $tstamp;

    /**
     * @var bool
     */
    protected $t3quotesSelected = false;

    /**
     * @return string
     */
    public function getAltText()
    {
        return $this->altText;
    }

    /**
     * @param $altText
     */
    public function setAltText($altText)
    {
        $this->altText = $altText;
    }

    /**
     * @return string
     */
    public function getBodytext()
    {
        return $this->bodytext;
    }

    /**
     * @param $bodytext
     */
    public function setBodytext($bodytext)
    {
        $this->bodytext = $bodytext;
    }

    /**
     * Get the colpos
     *
     * @return int
     */
    public function getColPos()
    {
        return (int)$this->colPos;
    }

    /**
     * Set colpos
     *
     * @param int $colPos
     */
    public function setColPos($colPos)
    {
        $this->colPos = $colPos;
    }

    /**
     * @return int
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * @param $cols
     */
    public function setCols($cols)
    {
        $this->cols = $cols;
    }

    /**
     * @return \DateTime
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * @param $crdate
     */
    public function setCrdate($crdate)
    {
        $this->crdate = $crdate;
    }

    /**
     * @return string
     */
    public function getCType()
    {
        return $this->CType;
    }

    /**
     * @param $ctype
     */
    public function setCType($ctype)
    {
        $this->CType = $ctype;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return string
     */
    public function getHeaderLayout()
    {
        return $this->headerLayout;
    }

    /**
     * @param $headerLayout
     */
    public function setHeaderLayout($headerLayout)
    {
        $this->headerLayout = $headerLayout;
    }

    /**
     * @return string
     */
    public function getHeaderLink()
    {
        return $this->headerLink;
    }

    /**
     * @param $headerLink
     */
    public function setHeaderLink($headerLink)
    {
        $this->headerLink = $headerLink;
    }

    /**
     * @return string
     */
    public function getHeaderPosition()
    {
        return $this->headerPosition;
    }

    /**
     * @param $headerPosition
     */
    public function setHeaderPosition($headerPosition)
    {
        $this->headerPosition = $headerPosition;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getImageborder()
    {
        return $this->imageborder;
    }

    /**
     * @param $imageborder
     */
    public function setImageborder($imageborder)
    {
        $this->imageborder = $imageborder;
    }

    /**
     * @return string
     */
    public function getImagecaption()
    {
        return $this->imagecaption;
    }

    /**
     * @param $imagecaption
     */
    public function setImagecaption($imagecaption)
    {
        $this->imagecaption = $imagecaption;
    }

    /**
     * @return int
     */
    public function getImagecols()
    {
        return $this->imagecols;
    }

    /**
     * @param $imagecols
     */
    public function setImagecols($imagecols)
    {
        $this->imagecols = $imagecols;
    }

    /**
     * @return string
     */
    public function getImageLink()
    {
        return $this->imageLink;
    }

    /**
     * @param $imageLink
     */
    public function setImageLink($imageLink)
    {
        $this->imageLink = $imageLink;
    }

    /**
     * @return int
     */
    public function getImageorient()
    {
        return $this->imageorient;
    }

    /**
     * @param $imageorient
     */
    public function setImageorient($imageorient)
    {
        $this->imageorient = $imageorient;
    }

    /**
     * @return int
     */
    public function getImagewidth()
    {
        return $this->imagewidth;
    }

    /**
     * @param $imagewidth
     */
    public function setImagewidth($imagewidth)
    {
        $this->imagewidth = $imagewidth;
    }

    /**
     * @return string
     */
    public function getImageZoom()
    {
        return $this->imageZoom;
    }

    /**
     * @param $imageZoom
     */
    public function setImageZoom($imageZoom)
    {
        $this->imageZoom = $imageZoom;
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @return string
     */
    public function getListType()
    {
        return $this->listType;
    }

    /**
     * @param $listType
     */
    public function setListType($listType)
    {
        $this->listType = $listType;
    }

    /**
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @param pages
     */
    public function setPages($pages)
    {
        $tmpPages = explode(',', $pages);
        foreach ($tmpPages as $count => $tmpPage) {
            $tmpPages[$count] = intval($tmpPage);
        }
        $this->pages = implode(',', $tmpPages);
    }

    /**
     * @return string
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return string
     */
    public function getSubheader()
    {
        return $this->subheader;
    }

    /**
     * @param $subheader
     */
    public function setSubheader($subheader)
    {
        $this->subheader = $subheader;
    }

    /**
     * @return string
     */
    public function getTitleText()
    {
        return $this->titleText;
    }

    /**
     * @param $titleText
     */
    public function setTitleText($titleText)
    {
        $this->titleText = $titleText;
    }

    /**
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * @param $tstamp
     */
    public function setTstamp($tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * Returns the t3quotesSelected
     *
     * @return bool $t3quotesSelected
     */
    public function getT3quotesSelected()
    {
        return $this->t3quotesSelected;
    }

    /**
     * Sets the t3quotesSelected
     *
     * @param bool $t3quotesSelected
     * @return void
     */
    public function setT3quotesSelected($t3quotesSelected)
    {
        $this->t3quotesSelected = $t3quotesSelected;
    }

    /**
     * Returns the boolean state of t3quotesSelected
     *
     * @return bool
     */
    public function isT3quotesSelected()
    {
        return $this->t3quotesSelected ? true : false;
    }

    public function toArray()
    {
        $array = [
            'altText' => $this->getAltText(),
            'bodytext' => $this->getBodytext(),
            'colPos' => $this->getColPos(),
            'cols' => $this->getCols(),
            'crdate' => $this->getCrdate(),
            'CType' => $this->getCType(),
            'header' => $this->getHeader(),
            'headerLayout' => $this->getHeaderLayout(),
            'headerLink' => $this->getHeaderLink(),
            'headerPosition' => $this->getHeaderPosition(),
            'image' => $this->getImage(),
            'imageborder' => $this->getImageborder(),
            'imagecaption' => $this->getImagecaption(),
            'imagecols' => $this->getImagecols(),
            'imageLink' => $this->getImageLink(),
            'imageorient' => $this->getImageorient(),
            'imagewidth' => $this->getImagewidth(),
            'imageZoom' => $this->getImageZoom(),
            'layout' => $this->getLayout(),
            'listType' => $this->getListType(),
            'media' => $this->getMedia(),
            'subheader' => $this->getSubheader(),
            'titleText' => $this->getTitleText(),
            'tstamp' => $this->getTstamp(),
            't3quotesSelected' => $this->getT3quotesSelected(),
            'uid' => $this->getUid,
            '_localizedUid' => $this->_localizedUid,
            '_languageUid' => $this->_languageUid,
            '_versionedUid' => $this->_versionedUid,
            'pid' => $this->getPid(),
            'pages' => $this->getPages()
        ];
        return $array;
    }
}
