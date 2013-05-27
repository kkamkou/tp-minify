<?php
return array(
    'router' => array(
        'routes' => array(
            'TpMinify' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
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
        'invokables' => array('TpMinifyProxy' => 'TpMinify\Controller')
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
        )
    )
);

