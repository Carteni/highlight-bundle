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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $rootPath;

    /**
     * Configuration constructor.
     *
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mes_highlight');

        $rootNode->fixXmlConfig('supported_language')
                 ->addDefaultsIfNotSet()
                 ->children()
                    ->arrayNode('supported_languages')
                        ->info('Supported languages')
                        ->example('supported_languages: ["php", "xml", "twig", "javascript", "sql", "json"]')
                        ->defaultValue(array('php', 'xml', 'twig', 'javascript', 'sql', 'json'))
                        ->validate()
                        ->always()
                            ->then(function ($languages) {
                                if (empty($languages)) {
                                    throw new \InvalidArgumentException(sprintf('Option "%s" cannot be empty.', 'supported_languages'));
                                }

                                return $languages;
                            })
                        ->end()
                        ->prototype('scalar')->end()
                    ->end()
                    ->scalarNode('root_path')
                        ->info('Root path to code-files location')
                        ->example('root_path: "%kernel.root_dir%"')
                        ->defaultValue($this->rootPath)
                    ->end()
                    ->scalarNode('left_delimiter')
                        ->info('Left delimiter for code to highlight')
                        ->defaultValue('{{')
                    ->end()
                    ->scalarNode('right_delimiter')
                        ->info('Right delimiter for code to highlight')
                        ->defaultValue('}}')
                    ->end()
                 ->end();

        return $treeBuilder;
    }
}
