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
    )
);
