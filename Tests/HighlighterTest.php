<?php

/*
 * This file is part of the MesHighlightBundle package.
 *
 * (c) Francesco Cartenì <http://www.multimediaexperiencestudio.it/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mes\Misc\HighlightBundle\Tests;

use Mes\Misc\HighlightBundle\Highlighter;

/**
 * Class HighlighterTest.
 */
class HighlighterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Highlighter
     */
    private $h;

    protected function setUp()
    {
        $this->h = new Highlighter(array('php'), __DIR__);

        $this->h->addSupportedLanguages(array('js'));
    }

    protected function tearDown()
    {
        $this->h = null;
    }

    /**
     * @dataProvider contentProvider
     *
     * @param $content
     */
    public function testSearchPatternAndHighlight($content)
    {
        $this->h->setRootPath(dirname(__DIR__));

        $codeHighlighted = $this->h->searchPatternAndHighlight($content);

        $this->assertContains('<pre class="hljs php">', $codeHighlighted);

        $this->assertContains(<<<'CODE'
<span class="hljs-meta">&lt;?php</span> $foo = <span class="hljs-string">"bar"</span>
CODE
, $codeHighlighted);
    }

    public function contentProvider()
    {
        return array(
            array(
                <<<'CODE'
{{ <?php $foo = "bar" }}
{{ Controller/HighlightDemoController.php }}
CODE
            ),
        );
    }
}
