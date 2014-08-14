<?php
/**
 * TpMinify - third-party module for the Zend Framework 2
 *
 * @category Module
 * @package  TpMinify
 * @author   Kanstantsin A Kamkou (2ka.by)
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     http://github.com/kkamkou/tp-minify/
 */

return array(
    'router' => array(
        'routes' => array(
            'TpMinify' => array(
                'type' => 'Literal',
                'may_terminate' => true,
                'options' => array(
                    'route'    => '/min',
                    'defaults' => array(
                        'controller' => 'TpMinifyProxy',
                        'action'     => 'index'
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array('TpMinifyProxy' => 'TpMinify\Controller\Index')
    ),
    'TpMinify' => array(
        'documentRoot' => false,
        'errorLogger' => false,
        'allowDebugFlag' => false,
        'cacheFileLocking' => true,
        'uploaderHoursBehind' => 0,
        'cachePath' => false,
        'symlinks' => array(),
        'serveOptions' => array(
            'bubbleCssImports' => false,
            'maxAge' => 1800,
            'minApp' => array(
                'groupsOnly' => false,
                'groups' => array(
                    // your groups list
                )
            )
        ),
        'helpers' => array( // $this->headScript()->CaptureStart/CaptureEnd()
            'headScript' => array(
                'enabled' => false,
                'options' => array(
                    'maxAge' => 86400 // and other serveOptions options
                )
            )
        )
    )
);
