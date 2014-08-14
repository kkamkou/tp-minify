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

namespace TpMinify\Controller;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\DispatchableInterface;
use Zend\Stdlib\ResponseInterface;
use Zend\Stdlib\RequestInterface;
use Zend\Http\Headers;

use Minify;

/**
 * Class Index
 * @package TpMinify\Controller
 * @see DispatchableInterface
 * @see ServiceLocatorAwareInterface
 */
class Index implements DispatchableInterface, ServiceLocatorAwareInterface
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
     * Execute the request
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response (Default: null)
     * @return \Zend\Http\PhpEnvironment\Response
     */
    public function dispatch(RequestInterface $request, ResponseInterface $response = null)
    {
        // the config hash
        $config = $this->getServiceLocator()->get('Config');
        $config = $config['TpMinify'];

        // some important stuff
        $config['serveOptions']['quiet'] = true;

        // the time correction
        Minify::$uploaderHoursBehind = $config['uploaderHoursBehind'];

        // the cache engine
        Minify::setCache($config['cachePath'] ?: '', $config['cacheFileLocking']);

        // doc root corrections
        if ($config['documentRoot']) {
            $_SERVER['DOCUMENT_ROOT'] = $config['documentRoot'];
            Minify::$isDocRootSet = true;
        }

        // check for URI versioning
        if (preg_match('~&\d~', $request->getUriString())) {
            $config['serveOptions']['maxAge'] = 31536000;
        }

        // minify result as array of information
        $result = Minify::serve('MinApp', $config['serveOptions']);

        // some corrections
        if (isset($result['headers']['_responseCode'])) {
            unset($result['headers']['_responseCode']);
        }

        // the headers set
        $headers = new Headers();
        $headers->addHeaders($result['headers']);

        // final output
        return $response->setHeaders($headers)
            ->setStatusCode($result['statusCode'])
            ->setContent($result['content']);
    }
}
