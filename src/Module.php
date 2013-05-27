<?php
/**
 * TpMinify - third-party module for the Zend Framework 2
 *
 * @category Module
 * @package  TpMinify
 * @author   Kanstantsin A Kamkou (2ka.by)
 * @license  http://opensource.org/licenses/bsd-license.php  New BSD License
 * @link     http://github.com/kkamkou/TpMinify/
 */

namespace TpMinify;

class Module
{
    /**
     * Returns set of options as array
     *
     * @return array
     */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }
}
