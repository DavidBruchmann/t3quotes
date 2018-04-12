<?php

namespace WDB\T3quotes\View;

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

class T3quotesView extends \TYPO3\CMS\Fluid\View\StandaloneView
{

    /**
     * Constructor
     *
     * @param ContentObjectRenderer $contentObject The current cObject. If NULL a new instance will be created
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     */
    public function __construct(\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObject = null)
    {
        parent::__construct($contentObject);
    }

    //    public function setLayoutRootPaths() {}
    //    public function setTemplateRootPaths() {}
    //    public function setPartialRootPaths() {}

    /**
     * Returns a unique identifier for the resolved template file
     * This identifier is based on the template path and last modification date
     *
     * @param string $actionName Name of the action. This argument is not used in this view!
     * @return string template identifier
     * @throws InvalidTemplateResourceException
     */
    protected function getTemplateIdentifier($actionName = null)
    {
        if ($this->templateSource === null) {
            $templatePathAndFilename = $this->getTemplatePathAndFilename();

            /*
            \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
                'method' => __METHOD__,
                'getTemplatePathAndFilename()' => $this->getTemplatePathAndFilename(),
                '$this->getTemplatePathAndFilename()' => $this->getTemplatePathAndFilename()
            ));
            */

            $templatePathAndFilenameInfo = pathinfo($templatePathAndFilename);
            $templateFilenameWithoutExtension = basename($templatePathAndFilename, '.' . $templatePathAndFilenameInfo['extension']);
            $prefix = sprintf('template_file_%s', $templateFilenameWithoutExtension);
            return $this->createIdentifierForFile($templatePathAndFilename, $prefix);
        } else {
            $templateSource = $this->getTemplateSource();
            $prefix = 'template_source';
            $templateIdentifier = sprintf('Standalone_%s_%s', $prefix, sha1($templateSource));
            return $templateIdentifier;
        }
    }

    /**
     * Returns the Fluid template source code
     *
     * @param string $actionName Name of the action. This argument is not used in this view!
     * @return string Fluid template source
     * @throws InvalidTemplateResourceException
     */
    protected function getTemplateSource($actionName = null)
    {
        if ($this->templateSource === null && $this->templatePathAndFilename === null) {
            throw new \TYPO3\CMS\Fluid\View\Exception\InvalidTemplateResourceException('No template has been specified. Use either setTemplateSource() or setTemplatePathAndFilename().', 1288085266);
        }
        $resolvedFileNamePath = $this->resolveFileNamePath($this->templatePathAndFilename);
        if ($this->templateSource === null) {
            if (!$this->testFileExistence( $resolvedFileNamePath )) {
                throw new \TYPO3\CMS\Fluid\View\Exception\InvalidTemplateResourceException('Template could not be found at "' . $this->templatePathAndFilename . '".', 1288087061);
            }
            $this->templateSource = file_get_contents( $resolvedFileNamePath );
        }
        return $this->templateSource;
    }

    public function getTemplateSourcePublic($actionName = null){
        return $this->getTemplateSource($actionName);
    }

    /**
     * Checks whether a template can be resolved for the current request
     * includes tests like getTemplateSource() but never throws exceptions
     *
     * @return bool
     * @api
     */
    public function hasTemplate()
    {
        if ($this->templateSource === null)
        {
            if($this->templatePathAndFilename === null)
            {
                return FALSE;
            }
            $resolvedFileNamePath = $this->resolveFileNamePath($this->templatePathAndFilename);
            if ($this->testFileExistence($resolvedFileNamePath) && file_get_contents($resolvedFileNamePath))
            {
                return TRUE;
            }
        }
        // TEST for string-length of templateSource?
        return $this->templateSource !== FALSE && $this->templateSource !== NULL ? TRUE : FALSE;
    }

    /**
     * Resolve the path and file name of the layout file, based on
     * $this->getLayoutRootPaths() and request format
     *
     * In case a layout has already been set with setLayoutPathAndFilename(),
     * this method returns that path, otherwise a path and filename will be
     * resolved using the layoutPathAndFilenamePattern.
     *
     * @param string $layoutName Name of the layout to use. If none given, use "Default"
     * @return string Path and filename of layout files
     * @throws InvalidTemplateResourceException
     */
    protected function getLayoutPathAndFilename($layoutName = 'Default')
    {
        $possibleLayoutPaths = $this->buildListOfTemplateCandidates($layoutName, $this->getLayoutRootPaths(), $this->getRequest()->getFormat());

        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__,
            '$layoutName'=>$layoutName,
            '$this->getLayoutRootPaths()'=>$this->getLayoutRootPaths(),
            '$this->getRequest()->getFormat()' => $this->getRequest()->getFormat(),
            '$possibleLayoutPaths'=>$possibleLayoutPaths,
            'debug_backtrace()'=>debug_backtrace()
        ));
        */

        foreach ($possibleLayoutPaths as $layoutPathAndFilename) {
            if ($this->testFileExistence($layoutPathAndFilename)) {
                return $layoutPathAndFilename;
            }
        }

        throw new \TYPO3\CMS\Fluid\View\Exception\InvalidTemplateResourceException('Could not load layout file. Tried following paths: "' . implode('", "', $possibleLayoutPaths) . '".', 1288092555);
    }

    /**
     * Returns a unique identifier for the given file in the format
     * Standalone_<prefix>_<SHA1>
     * The SH1 hash is a checksum that is based on the file path and last modification date
     *
     * @param string $pathAndFilename
     * @param string $prefix
     * @return string
     */
    protected function createIdentifierForFile($pathAndFilename, $prefix)
    {
        /*
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(array(
            'method' => __METHOD__,
            '$pathAndFilename' => $pathAndFilename,
            '$this->templatePathAndFilename' => $this->templatePathAndFilename,
            '$this->settings' => $this->settings
            # TYPO3\CMS\Core\TypoScript\Parser\TypoScriptParser
        ));
        */

        $resolvedFileNamePath = $this->resolveFileNamePath($this->templatePathAndFilename);
        $templateModifiedTimestamp = filemtime($resolvedFileNamePath);
        $templateIdentifier = sprintf('Standalone_%s_%s', $prefix, sha1($resolvedFileNamePath . '|' . $templateModifiedTimestamp));
        $templateIdentifier = str_replace('/', '_', str_replace('.', '_', $templateIdentifier));
        return $templateIdentifier;
    }
}
