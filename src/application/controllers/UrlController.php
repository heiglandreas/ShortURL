<?php

class UrlController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function getAction()
    {
		$this -> _helper -> viewRenderer -> setNoRender ();
		$shortId = $this -> getRequest () -> getParam ( 'shortId' );
		print_r( $shortId );
    }


}

