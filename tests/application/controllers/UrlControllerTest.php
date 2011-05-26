<?php

class UrlControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexActionRedirectsToError()
    {
        $params = array('action' => 'index', 'controller' => 'Url', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        $urlParams['controller']='error';
        $urlParams['action']='error';
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->markTestIncomplete('Content not testet');
     /*   $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );//*/
    }


}



