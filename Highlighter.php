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

/**
 * Class Highlighter.
 */
class Highlighter implements HighlighterInterface
{
    /**
     * @var \Highlight\Highlighter
     */
    private $h;

    /**
     * @var string
     */
    private $root;

    /**
     * @var string
     */
    private $leftDelimiter;

    /**
     * @var string
     */
    private $rightDelimiter;

    /**
     * @var array
     */
    private $supportedLanguages = array();

    /**
     * @var bool
     */
    private $showLines = true;

    /**
     * Highlighter constructor.
     *
     * @param array $languages
     * @param $root
     * @param $leftDelimiter
     * @param $rightDelimiter
     */
    public function __construct(array $languages, $root, $leftDelimiter, $rightDelimiter)
    {
        $this->leftDelimiter = $leftDelimiter;
        $this->rightDelimiter = $rightDelimiter;
        $this->root = $root;

        $this->h = new \Highlight\Highlighter();

        // Set the languages you want to detect automatically.
        $this->addSupportedLanguages($languages);
    }

    /**
     * @param $content
     * @param null $language
     *
     * @return string
     */
    public function searchPatternAndHighlight($content, $language = null)
    {
        $pattern = '#(?:'.$this->leftDelimiter.')([\S|\s]+)(?:'.$this->rightDelimiter.')#iU';

        return preg_replace_callback($pattern, function ($matches) use ($language) {
            return $this->highlight($this->resolveResource(trim($matches[1])), $language);
        }, $content);
    }

    /**
     * @param $content
     * @param null $language
     *
     * @return string|void
     */
    public function highlight($content, $language = null)
    {
        // Highlight some code.
        $r = null === $language ? $this->h->highlightAuto($content) : $this->h->highlight($language, $content);

        if (!($value = $r->value)) {
            return;
        }

        if ($this->showLines) {
            $lines = preg_split("/\r\n|\r|\n/", $value);

            array_walk($lines, function (&$line, $index) {
                $line = <<<HTML
<div class="line"><span class="linenum">$index</span>$line</div>
HTML;
            });

            $value = implode('', $lines);
        }

        return <<<HTML
<pre class="hljs $r->language">$value</pre>
HTML;
    }

    /**
     * Set root location for "code files".
     *
     * @param $rootPath
     */
    public function setRootPath($rootPath)
    {
        if ('/' !== substr($rootPath, -1)) {
            $rootPath .= '/';
        }

        $this->root = $rootPath;
    }

    /**
     * Add supported languages for highlighting.
     *
     * @param array $supportedLanguages
     */
    public function addSupportedLanguages(array $supportedLanguages)
    {
        $this->supportedLanguages = array_merge($this->supportedLanguages, $supportedLanguages);

        $this->h->setAutodetectLanguages($this->supportedLanguages);
    }

    /**
     * @param $resource
     *
     * @return string
     */
    protected function resolveResource($resource)
    {
        if (is_file($this->root.$resource)) {
            $resource = file_get_contents($this->root.$resource);
        }

        return trim($resource);
    }
}
