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

/**
 * Class HighlightExtension.
 */
class HighlightExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('highlighter_searchPatternAndHighlight', array(
                Highlight_RuntimeExtension::class,
                'searchPatternAndHighlight',
            )),
            new \Twig_SimpleFilter('highlighter_highlight', array(
                Highlight_RuntimeExtension::class,
                'highlight',
            )),
        );
    }
}
