<?php

class UrlController extends Zend_Controller_Action
{

    protected $_em = null;
    protected $_log = null;

    public function init()
    {
        $this->_em=Zend_Registry::get('entityManager');
        $this->_log=Zend_Registry::get('Zend_Log');

    }

    public function getAction()
    {
		$this->_helper->viewRenderer->setNoRender ();
		$shortId = $this->getRequest()->getParam('shortId');
		$urlObj  = $this->_em->getRepository('ShortUrl_Model_Url')->findOneBy(array('_shorty'=>$shortId));
		if($urlObj){
		    $call = new ShortUrl_Model_Call();
		    $call->setValues()->setShorty($urlObj)->store();
		    $this->_redirect($urlObj->getUrl());
		    return true;
		}
		$this->getResponse()->setRawHeader('HTTP/1.1 404 File not found');
		return false;
    }


}

