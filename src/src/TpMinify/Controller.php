<?php

namespace TpMinify;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\DispatchableInterface;
use Zend\Stdlib\ResponseInterface;
use Zend\Stdlib\RequestInterface;
use Zend\Http\Headers;
use Minify;

/**
 * Class Controller
 *
 * @see AbstractController
 * @package TpMinify
 */
class Controller implements DispatchableInterface, ServiceLocatorAwareInterface
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
        $config = $this->getServiceLocator()->get('config');
        $config = $config[__NAMESPACE__];

        // some important stuff
        $config['quiet'] = true;

        // the time correction
        Minify::$uploaderHoursBehind = $config['uploaderHoursBehind'];

        // the cache engine
        Minify::setCache($config['cachePath'] ?: '', $config['cacheFileLocking']);

        // check for URI versioning
        if (preg_match('~&\d~', $request->getUriString())) {
            $config['serveOptions']['maxAge'] = 31536000;
        }

        // minify result as array of information
        $result = Minify::serve('MinApp', $config);

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
