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
 * Class RuntimeLoader.
 */
class RuntimeLoader implements \Twig_RuntimeLoaderInterface
{
    /**
     * @var HighlighterInterface
     */
    private $highlighter;

    /**
     * RuntimeLoader constructor.
     *
     * @param \Mes\Misc\HighlightBundle\HighlighterInterface $highlighter
     */
    public function __construct(HighlighterInterface $highlighter)
    {
        $this->highlighter = $highlighter;
    }

    /**
     * Creates the runtime implementation of a Twig element (filter/function/test).
     *
     * @param string $class A runtime class
     *
     * @return object|null The runtime instance or null if the loader does not know how to create the runtime for this class
     */
    public function load($class)
    {
        if (Highlight_RuntimeExtension::class === $class) {
            return new $class($this->highlighter);
        }
    }
}
