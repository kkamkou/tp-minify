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

namespace TpMinify;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

/**
 * Class Module
 *
 * @see ConfigProviderInterface
 * @see ViewHelperProviderInterface
 * @package TpMinify
 */
class Module implements ConfigProviderInterface, ViewHelperProviderInterface
{
    /** @return array */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    /** @return array */
    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'headscript' => 'TpMinify\View\Helper\HeadScript'
                // try to avoid this idea in your project
                // 'headstyle' => 'TpMinify\View\Helper\HeadStyle'
            )
        );
    }
}
