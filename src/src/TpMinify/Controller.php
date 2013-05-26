<?php

namespace TpMinify;

use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;

class Controller extends AbstractController
{
    /**
     * Execute the request
     *
     * @param  MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {
        $response = $this->getResponse();
        $response->setStatusCode(200);
        $response->setContent("Hello World");
        return $response;
    }
}
