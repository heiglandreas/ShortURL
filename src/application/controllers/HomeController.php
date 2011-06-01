<?php

/** ShortUrl_Controller_Action */
require_once 'ShortUrl/Controller/Action.php';

class HomeController extends ShortUrl_Controller_Action
{

    public function init()
    {
   $pages = array(
            array(
                'label'      => 'Home',
                'title'      => 'Go to home',
                'module'     => 'default',
                'controller' => 'home',
                'action'     => 'index',
                'order'      => -100 // Sicherstellen das Home die erste Seite ist
            ),
            array(
                'label'      => 'Contribute',
                'module'     => 'default',
                'controller' => 'home',
                'action'     => 'contribute',
            ),
            array(
                'label'      => 'Demo',
                'module'     => 'default',
                'controller' => 'home',
                'action'     => 'demo',
            ),
            array(
                'label'      => 'Download',
                'module'     => 'default',
                'controller' => 'home',
                'action'     => 'download',
            ),
            array(
                'label'      => 'Documentation',
                'module'     => 'default',
                'controller' => 'home',
                'action'     => 'documentation',
            ),
        );

        Zend_Registry::set('Zend_Navigation',new Zend_Navigation($pages));
    }

    public function __call($function, $parameters)
    {
    }


}

