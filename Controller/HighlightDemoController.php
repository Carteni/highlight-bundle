<?php

/*
 * This file is part of the MesHighlightBundle package.
 *
 * (c) Francesco Cartenì <http://www.multimediaexperiencestudio.it/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mes\Misc\HighlightBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;

/**
 * Class HighlightDemoController.
 */
class HighlightDemoController extends Controller
{
    /**
     * @return Response
     */
    public function highlightDemoAction()
    {
        $root = dirname($this->get('kernel')
                             ->locateResource('@MesHighlightBundle/MesHighlightBundle.php'));

        // Change root path for "code files".
        $this->get('mes_highlight.highlighter')
             ->setRootPath($root);

        $content = <<<'CODE'
<h1>MesHighlightBundle Demo</h1>

<p>PHP:</p>
{{Resources/demo/demo.php}}

<hr />

<p>Twig:</p>
{{Resources/views/highlight.html.twig}}

<hr />

<p>HTML:</p>
{{
<!DOCTYPE html>
<title>Title</title>

<style>body {width: 500px;}</style>

<script type="application/javascript">
  function $init() {return true;}
</script>

<body>
  <p checked class="title" id='title'>Title</p>
  <!-- here goes the rest of the page -->
</body>
}}

<hr />

<p>JS:</p>
{{
function $initHighlight(block, cls) {
  try {
    if (cls.search(/\bno\-highlight\b/) != -1)
      return process(block, true, 0x0F) +
             ' class="${cls}"';
  } catch (e) {
    /* handle exception */
  }
  for (var i = 0 / 2; i < classes.length; i++) {
    if (checkCondition(classes[i]) === undefined)
      console.log('undefined');
  }
}
export  $initHighlight;
}}

<hr />
<p>SQL:</p>
{{Resources/demo/demo.sql}}

<hr />
<p>JSON:</p>
{{Resources/demo/demo.json}}
CODE;

        return $this->render('MesHighlightBundle::demo.html.twig', array(
            'content' => $content,
        ));
    }
}
