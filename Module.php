<?php
/**
 * @Author: Cel Ticó Petit
 * @Company: Cencis s.c.p.
 * @Contact: cel@cenics.net
 */
namespace QuWebDemo;


class Module
{

    /**
     * Provisional model
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'qu_web_demo_model' => function ($sm) {
                    $config = $sm->get('Config');
                    return new \QuAdmin\Options\QuAdminModelOptions($config['qu_web_demo_model']);
                },
                'QuWebDemo' =>  function($sm) {
                    $QuWebDemoMapper =  new \QuAdminDemo\Mapper\QuAdminDemo();
                    $QuWebDemoMapper->setQuAdminModelOptions($sm->get('qu_web_demo_model'));
                    return $QuWebDemoMapper;
                },
                'languages' =>  function($sm) {
                    $QuWebDemoMapper =  new \QuAdminDemo\Mapper\QuAdminDemo();
                    $QuWebDemoMapper->setQuAdminModelOptions($sm->get('qu_languages_model'));
                    return $QuWebDemoMapper;
                },
            )
         );
    }

    /**
     * Provisional Helpers
     * @return array
     */
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                /**
                 * Get content db
                 */
                'cont' => function ($sm) {
                    $select = new View\Helper\Cont($sm->getServiceLocator());
                    return $select;
                },
                /**
                 * Get images
                 * Extract path config QuPhpThumb
                 */
                'img' => function($sm){
                    $select = new View\Helper\Img($sm->getServiceLocator());
                    return $select;
                },
                /**
                 * Get css active class menu
                 */
                'uac' => function ($sm) {
                    $select = new View\Helper\Uac;
                    $select->setSm($sm);
                    return $select;
                },
            ),
        );
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
