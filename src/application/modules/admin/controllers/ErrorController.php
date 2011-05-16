<?php

class Admin_ErrorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function errorAction()
    {
        $this -> _forward ( 'error', 'error', null );
    }


}

