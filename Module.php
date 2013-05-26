<?php
/**
 * Divit-Tour
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are PROHIBITED without prior written permission from
 * the author. If you received this code occasionally and without
 * intent to use it, please report this incident to the author.
 *
 * @category Modules
 * @package  Frontend
 * @author   Kanstantsin A Kamkou (2ka.by)
 * @license  http://divit.by
 */

namespace Frontend;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($e->getApplication()->getEventManager());
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
