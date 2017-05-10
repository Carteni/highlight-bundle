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

/**
 * Class HighlightDemoController.
 */
class demo extends Controller
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

        // Add js language for highlighting.
        $this->get('mes_highlight.highlighter')
             ->addSupportedLanguages(array(
                 'js',
                 'xml',
                 'http',
             ));

        $content = '{{Resources/demo/demo.php}}';

        return $this->render('MesHighlightBundle::demo.html.twig', array(
            'content' => $content,
        ));
    }
}
