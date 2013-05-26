<?php

namespace TpMinify;

use Minify;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Zend\Http\Headers;

/**
 * Class Controller
 *
 * @see AbstractController
 * @package TpMinify
 */
class Controller extends AbstractController
{
    /**
     * Execute the request
     *
     * @param  MvcEvent $e
     * @return \Zend\Http\PhpEnvironment\Response
     */
    public function onDispatch(MvcEvent $e)
    {
        // the config hash
        $config = $this->getServiceLocator()->get('config');
        $config = $config[__NAMESPACE__];

        Minify::$uploaderHoursBehind = $config['uploaderHoursBehind'];
        Minify::setCache($config['cachePath'] ?: '', $config['cacheFileLocking']);

        // check for URI versioning
        if (preg_match('~&\d~', $this->getRequest()->getUriString())) {
            $config['serveOptions']['maxAge'] = 31536000;
        }

        // minify result as array of information
        $result = Minify::serve('MinApp', $config);

        // some corrections
        if (isset($result['headers']['_responseCode'])) {
            unset($result['headers']['_responseCode']);
        }

        // the response object
        $res = $this->getResponse();

        // the headers set
        $headers = new Headers();
        $headers->addHeaders($result['headers']);

        // final output
        return $res->setHeaders($headers)
            ->setStatusCode($result['statusCode'])
            ->setContent($result['content']);
    }
}
