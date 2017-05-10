<?php

/*
 * This file is part of the MesHighlightBundle package.
 *
 * (c) Francesco Cartenì <http://www.multimediaexperiencestudio.it/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mes\Misc\HighlightBundle\Tests\DependencyInjection;

use Mes\Misc\HighlightBundle\DependencyInjection\Compiler\AddTwigExtensionCompilerPass;
use Mes\Misc\HighlightBundle\DependencyInjection\MesHighlightExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * Class MesHighlightExtensionTest.
 */
class MesHighlightExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerBuilder */
    private $configuration;

    protected function setup()
    {
        $this->configuration = new ContainerBuilder();
        $this->configuration->setParameter('kernel.root_dir', dirname(dirname(__DIR__)));
    }

    protected function tearDown()
    {
        unset($this->configuration);
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testConfigWithLanguagesWithNullValue()
    {
        $loader = new MesHighlightExtension();
        $config = $this->getIncompleteConfig();
        $loader->load(array($config), $this->configuration);
    }

    public function testContainerWithDefaultValues()
    {
        $loader = new MesHighlightExtension();
        $config = $this->getEmptyConfig();
        $loader->load(array($config), $this->configuration);

        $this->assertParameter(dirname(dirname(__DIR__)).'/Resources/', 'mes_highlight.root_path');
        $this->assertParameter(array(
            'php',
            'xml',
            'twig',
            'javascript',
            'sql',
            'json',
        ), 'mes_highlight.supported_languages');
    }

    public function testContainerWithFullConfiguration()
    {
        $loader = new MesHighlightExtension();
        $config = $this->getFullConfig();
        $loader->load(array($config), $this->configuration);

        $this->assertParameter('/var/www/carteni/highlight-bundle/Resources/', 'mes_highlight.root_path');
        $this->assertParameter(array(
            'php',
            'twig',
        ), 'mes_highlight.supported_languages');
    }

    public function testContainerHasHighlighterDefinition()
    {
        $loader = new MesHighlightExtension();
        $config = $this->getFullConfig();
        $loader->load(array($config), $this->configuration);

        $this->assertHasDefinition('mes_highlight.highlighter');
    }

    public function testIfTwigExtensionAdded()
    {
        $compilerPass = new AddTwigExtensionCompilerPass();
        $this->configuration->register('twig', '\Twig_Environment');
        $compilerPass->process($this->configuration);
        $this->assertHasDefinition('mes_highlight.highlighter.twig_extension');
    }

    public function testIfTwigExtensionNotAdded()
    {
        $compilerPass = new AddTwigExtensionCompilerPass();
        $compilerPass->process($this->configuration);
        $this->assertNotHasDefinition('mes_highlight.highlighter.twig_extension');
    }

    /**
     * @return array
     */
    private function getEmptyConfig()
    {
        return array();
    }

    /**
     * @return array
     */
    private function getIncompleteConfig()
    {
        $yaml = <<<'EOF'
supported_languages: ~
EOF;

        $parser = new Parser();

        return $parser->parse($yaml);
    }

    /**
     * @return mixed
     */
    private function getFullConfig()
    {
        $yaml = <<<'EOF'
supported_languages:
  - "php"
  - "twig"
root_path: /var/www/carteni/highlight-bundle/Resources/
EOF;

        $parser = new Parser();

        return $parser->parse($yaml);
    }

    /**
     * @param mixed  $value
     * @param string $key
     */
    private function assertParameter($value, $key)
    {
        $this->assertSame($value, $this->configuration->getParameter($key), sprintf('%s parameter is correct', $key));
    }

    /**
     * @param string $id
     */
    private function assertHasDefinition($id)
    {
        $this->assertTrue(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    /**
     * @param string $id
     */
    private function assertNotHasDefinition($id)
    {
        $this->assertFalse(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }
}
