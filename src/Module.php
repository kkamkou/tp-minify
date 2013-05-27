<?php

namespace TpMinify;

class Module
{
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }
}
