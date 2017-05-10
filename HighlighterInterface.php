<?php

/*
 * This file is part of the MesHighlightBundle package.
 *
 * (c) Francesco Cartenì <http://www.multimediaexperiencestudio.it/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mes\Misc\HighlightBundle;

/**
 * Class HighlighterInterface.
 */
interface HighlighterInterface
{
    /**
     * Search and replace code into delimeters {{ <code> or file path }}.
     *
     * @param $content
     * @param null $language
     *
     * @return string
     */
    public function searchPatternAndHighlight($content, $language = null);

    /**
     * Highlight code.
     *
     * @param $content
     * @param null $language
     *
     * @return string
     */
    public function highlight($content, $language = null);

    /**
     * Set root location for "code files".
     *
     * @param $rootPath
     */
    public function setRootPath($rootPath);

    /**
     * Add supported languages for highlighting.
     *
     * @param array $supportedLanguages
     */
    public function addSupportedLanguages(array $supportedLanguages);
}
