## TpMinify - third-party module for the Zend Framework 2
This module uses the [Steve (mrclay) Clay's Minify](http://github.com/mrclay/minify) library for styles and scripts obfuscation.

## Installation
### Composer
 * Install the [Composer](http://getcomposer.org/doc/00-intro.md)
 * Add ```"kkamkou/tp-minify": "dev-master"``` to a ```composer.json``` file, to the ```require``` section
 * Execute ```composer update```
 * Add ```'modules' => array('TpMinify', ...)``` to the ```application.config.php``` file of your project. *Important thing is to place the "TpMinify" before any other modules.*
 * Open (just an example) the ```Frontend/config/module.config.php``` and add this config stub:

```php

'TpMinify' => array(
    'serveOptions' => array(
        'minApp' => array(
            'groups' => array(
                'css' => array(
                    '//../module/Frontend/public/css/buttons.css',
                    '//../module/Frontend/public/css/forms.css'
                ),
                'js' => array(
                    '//js/common.js'
                )
            )
        )
    )
)
```
 * Put styles into the Head section:

```php

$this->headLink()->prependStylesheet($this->basePath('/min?g=css'))
$this->headScript()->prependFile($this->basePath('/min?g=js'))
// or
$this->headLink()->prependStylesheet($this->basePath('/min?f=example.css'))
```
## Options
[Source code with the description of variables](https://code.google.com/p/minify/source/browse/min/config.php).
For example:
```php
// $min_cacheFileLocking
'TpMinify' => array('cacheFileLocking' => ...);
// $min_serveOptions['bubbleCssImports']
'TpMinify' => array('serveOptions' => array('bubbleCssImports' => ...));
// etc.
```

### How-To
###### What to do with the ```/module/YourModule/public/images/``` folder?
Create a symlink to this module (```/public/images/modules/YourModule```) and enable the [Manual Rewriting](http://code.google.com/p/minify/wiki/UriRewriting).
```php
'TpMinify' => array(
    'serveOptions' => array(
        'rewriteCssUris' => false,
        'minifierOptions' => array(
            'text/css' => array('prependRelativePath' => '/images/modules/YourModule/')
        )
    )
)
```
###### Is it possible to minify inline scripts?
Enable the HeadScript view helper:
```php
'TpMinify' => array(
    'helpers' => array(
        'headScript' => array(
            'enabled' => true,
            'options' => array(// serveOptions here if needed)
        )
    )
)
// and use it in your templates
<?$this->headScript()->captureStart()?>
$(function() {
    console.log('hello');
});
<?$this->headScript()->captureEnd()?>
```

###### I have two or more modules, how to deal with that?
1. Put a common stuff into the ```global.php```
2. And put a module-dependent stuff into the ```module.config.php``` of each module
3. Use prefixes for groups: ```backend-css``` and ```frontend-css``` etc.

## MIT License
