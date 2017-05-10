<?php

/*
 * This file is part of the MesHighlightBundle package.
 *
 * (c) Francesco Cartenì <http://www.multimediaexperiencestudio.it/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mes\Misc\HighlightBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RemoveTwigExtensionCompilerPass.
 */
class AddTwigExtensionCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('twig')) {
            return;
        }

        $container->register('mes_highlight.highlighter.twig_extension', 'Mes\Misc\HighlightBundle\Twig\Extension\HighlightExtension')
                  ->setPublic(false);

        $container->getDefinition('twig')
                  ->addMethodCall('addExtension', array(
                      new Reference('mes_highlight.highlighter.twig_extension'),
                  ));
    }
}
