<?php

namespace TwwSaml;

use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        define("TOOLKIT_PATH", __DIR__ . '/../../../../../vendor/onelogin/php-saml/');
        require_once(TOOLKIT_PATH . '_toolkit_loader.php');
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                    __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'TwwSaml\\Adapter\\Saml'         => 'TwwSaml\\Factory\\SamlAdapterFactory',
                'TwwSaml\\Config\\Saml'          => 'TwwSaml\\Factory\\SamlConfigFactory',
            ),
        );
    }

    public function getConfiguration()
    {
        return $this->getConfig();
    }

    public function getAutoloaderConfiguration()
    {
        return $this->getAutoloaderConfig();
    }

    public function getServiceConfiguration()
    {
        return $this->getServiceConfig();
    }

}
