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

use Mes\Misc\HighlightBundle\DependencyInjection\Compiler\AddTwigExtensionCompilerPass;
use Mes\Misc\HighlightBundle\Twig\Extension\RuntimeLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MesHighlightBundle.
 */
class MesHighlightBundle extends Bundle
{
    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddTwigExtensionCompilerPass());
    }

    public function boot()
    {
        parent::boot();

        if (true === $this->container->has('twig')) {
            $this->container->get('twig')
                            ->addRuntimeLoader(new RuntimeLoader($this->container->get('mes_highlight.highlighter')));
        }
    }
}
