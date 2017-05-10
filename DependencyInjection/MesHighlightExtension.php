<?php

/*
 * This file is part of the MesHighlightBundle package.
 *
 * (c) Francesco Cartenì <http://www.multimediaexperiencestudio.it/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mes\Misc\HighlightBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class MesHighlightExtension.
 */
class MesHighlightExtension extends ConfigurableExtension
{
    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return \Mes\Misc\HighlightBundle\DependencyInjection\Configuration
     */
    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration($container->getParameter('kernel.root_dir').'/Resources/');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getNamespace()
    {
        return 'http://multimediaexperiencestudio.it/schema/dic/highlight';
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string|bool
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * Configures the passed container according to the merged configuration.
     *
     * @param array            $mergedConfig
     * @param ContainerBuilder $container
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new XMLFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('highlighter.xml');

        $container->setParameter('mes_highlight.supported_languages', $mergedConfig['supported_languages']);
        $container->setParameter('mes_highlight.root_path', $mergedConfig['root_path']);
    }
}
