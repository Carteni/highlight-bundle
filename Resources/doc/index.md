Examples
========

The Bundle provides an **Highlighter** service ```mes_highlight.highlighter``` with the
following APIs:

```php
/**
* Search and highlight code into delimeters {{ <code> or file path }}.
*/
function searchPatternAndHighlight($content, $language = null);

/**
* Highlight code.
*/
function highlight($content, $language = null);

/**
* Set root location for "code files".
*/
public function setRootPath($rootPath);

/**
* Add supported languages for highlighting.
*/
public function addSupportedLanguages(array $supportedLanguages);
```

The Bundle adds two Twig filters: ```highlighter_searchPatternAndHighlight```
and ```highlighter_highlight```.

```twig
{% autoescape false %}
    {{ contentToHighlight|highlighter_searchPatternAndHighlight(language, rootPath) }}

    {{ "<?php $foo = \"bar\""|highlighter_highlight(language) }}
{% endautoescape %}
```

"Demo" route
------------

```yaml
# Add demo route in your app/config/routing_dev.yml
_highlight:
    resource: "@MesHighlightBundle/Resources/config/routing/highlight.xml"
    prefix: /_highlight
```

and go to http://[YOUR HOST]/_highlight/highlight-demo to see some highlighting examples.
