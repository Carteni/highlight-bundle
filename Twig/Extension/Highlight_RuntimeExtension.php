<?php

/*
 * This file is part of the MesHighlightBundle package.
 *
 * (c) Francesco Cartenì <http://www.multimediaexperiencestudio.it/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mes\Misc\HighlightBundle\Twig\Extension;

use Mes\Misc\HighlightBundle\HighlighterInterface;

/**
 * Class Highlight_RuntimeExtension.
 */
class Highlight_RuntimeExtension extends \Twig_Extension
{
    /**
     * @var HighlighterInterface
     */
    private $highlighter;

    /**
     * Highlight_RuntimeExtension constructor.
     *
     * @param \Mes\Misc\HighlightBundle\HighlighterInterface $h
     */
    public function __construct(HighlighterInterface $h)
    {
        $this->highlighter = $h;
    }

    /**
     * @param $content
     * @param null $language
     * @param null $rootPath
     *
     * @return string
     */
    public function searchPatternAndHighlight($content, $language = null, $rootPath = null)
    {
        if (null !== $rootPath) {
            $this->highlighter->setRootPath($rootPath);
        }

        return $this->highlighter->searchPatternAndHighlight($content, $language);
    }

    /**
     * @param $content
     * @param null $language
     *
     * @return string
     */
    public function highlight($content, $language = null)
    {
        return $this->highlighter->highlight($content, $language);
    }
}
