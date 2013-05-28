## TpMinify - third-party module for the Zend Framework 2
This module uses the [Steve (mrclay) Clay's Minify](http://github.com/mrclay/minify) library for styles and scripts obfuscation.

## Installation
### Composer
 * Install the [Composer](http://getcomposer.org/doc/00-intro.md)
 * Add string to the ```composer.json``` file, to the ```require``` section: ```"kkamkou/tp-minify": "dev-master"```
 * Execute ```composer update```
 * Open (just an example) the ```Frontend/config/module.config.php``` and add this config stub:

```php

'TpMinify' => array(
    'serveOptions' => array(
        'minApp' => array(
            'groups' => array(
                'css' => array(
                    '//../module/Frontend/public/css/buttons.css',
                    '//../module/Frontend/public/css/forms.css'
                )
            )
        )
    )
)
```
 * Put styles into the Head section:

```php

$this->headLink()->prependStylesheet($this->basePath('/min?g=css'))
// or
$this->headLink()->prependStylesheet($this->basePath('/min?f=example.css'))
```

### Problems
If you got something like this:

```
Your requirements could not be resolved to an installable set of packages.

  Problem 1
    - Installation request for kkamkou/tp-minify dev-master -> satisfiable by kkamkou/tp-minify[dev-master].
    - kkamkou/tp-minify dev-master requires mrclay/minify dev-master -> no matching package found.
```
Just add the ```"mrclay/minify": "dev-master"``` to the ```composer.json``` of your project. [Check this issue](https://github.com/mrclay/minify/issues/56).

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


## New BSD License
Copyright (c) 2013, Kanstantsin Kamkou
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

 * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
