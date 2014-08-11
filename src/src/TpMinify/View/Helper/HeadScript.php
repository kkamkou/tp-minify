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

namespace TpMinify\View\Helper;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\HeadScript as HeadScriptOriginal;
use Minify;

/**
 * Class HeadScript
 * @package TpMinify\View\Helper
 * @see ServiceLocatorAwareInterface
 */
class HeadScript extends HeadScriptOriginal implements ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Set serviceManager instance
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Retrieve serviceManager instance
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Create script HTML
     *
     * @param  mixed  $item        Item to convert
     * @param  string $indent      String to add before the item
     * @param  string $escapeStart Starting sequence
     * @param  string $escapeEnd   Ending sequence
     * @return string
     */
    public function itemToString($item, $indent, $escapeStart, $escapeEnd)
    {
        if (!empty($item->source)) {
            $config = $this->getServiceLocator()->getServiceLocator()->get('Config');
            $config = $config['TpMinify']['helpers']['headScript'];
            if ($config['enabled']) {
                $result = Minify::serve(
                    'Files',
                    array_merge(
                        $config,
                        array(
                            'quiet' => true,
                            'encodeOutput' => false,
                            'files' => new \Minify_Source(
                                array(
                                    'contentType' => Minify::TYPE_JS,
                                    'content' => $item->source,
                                    'id' => __CLASS__ . hash('crc32', $item->source)
                                )
                            )
                        )
                    )
                );

                if ($result['success']) {
                    $item->source = $result['content'];
                }
            }
        }

        return parent::itemToString($item, $indent, $escapeStart, $escapeEnd);
    }
}
