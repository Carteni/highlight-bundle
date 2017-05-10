<p align="center"><a href="http://www.multimediaexperiencestudio.it" target="_blank">
<img src="http://www.multimediaexperiencestudio.it/_cdn/public/assets/nlogo.svg" />
</a></p>

**MesHighlightBundle** is based on [scrivo/highlight.php][1] library, a port of [highlight.js][2] by Ivan Sagalaev to PHP.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f5ce9d83-a2f4-4441-a028-2fa7b8f59ba4/mini.png)](https://insight.sensiolabs.com/projects/f5ce9d83-a2f4-4441-a028-2fa7b8f59ba4)
[![Build Status](https://travis-ci.org/Carteni/highlight-bundle.svg?branch=master)](https://travis-ci.org/Carteni/highlight-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Carteni/highlight-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Carteni/highlight-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Carteni/highlight-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Carteni/highlight-bundle/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Carteni/highlight-bundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Carteni/highlight-bundle/build-status/master)
[![License](https://poser.pugx.org/carteni/crypto-bundle/license)][1]

Step 1: Download the Bundle
---------------------------

```console
$ composer require carteni/mes-highlight
```

Step 2: Enable the Bundle
-------------------------

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new \Mes\Misc\HighlightBundle\MesHighlightBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Install styles
----------------------

```console
$ bin/console assets:install --symlink
```

Step 4: Configure the Bundle (optional)
---------------------------------------

```yaml
mes_highlight:
    supported_languages: ["php", "xml", "twig", "javascript", "sql", "json"]
    root_path: "%kernel.root_dir%/Resources/"
```

Examples
--------

[See the Documentation][3]

License
-------

This bundle is under the MIT license. See the complete license [in the bundle](LICENSE)

Reporting an issue
------------------

Issues are tracked in the [Github issue tracker][4].

### Enjoy!

###### ♥ ☕ m|e|s

[1]: https://github.com/scrivo/highlight.php
[2]: http://www.highlightjs.org/
[3]: ./Resources/doc/index.md
[4]: https://github.com/Carteni/highlight-bundle/issues
