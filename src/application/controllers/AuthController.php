<?php
/**
 * @LICENSE_TEXT@
 *
 */
class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this -> _forward ( 'login' );
    }

	public function loginAction()
	{
		$this->view->status = "";
		if (($this->_request->isPost() &&
			 $this->_request->getPost('openid_action') == 'login' &&
		 	 $this->_request->getPost('openid_identifier', '') !== '') ||
		 	($this->_request->isPost() &&
		  	 $this->_request->getPost('openid_mode') !== null) ||
		 	(!$this->_request->isPost() &&
		 	 $this->_request->getQuery('openid_mode') != null)) 
		{
			// Begin If.
			Zend_Loader::loadClass('Zend_Auth_Adapter_OpenId');
		 	$auth = Zend_Auth::getInstance();
		 	$result = $auth->authenticate(
		 		new Zend_Auth_Adapter_OpenId($this->_request->getPost('openid_identifier')));
			if ($result->isValid()) {
		   		$this->_redirect('admin/index');
		 	} else {
		  		$auth->clearIdentity();
		 		foreach ($result->getMessages() as $message) {
		  			$this->view->status .= "$message<br>\n";
		 		}
		 	}
		}
        $this->render();
	}

	public function logoutAction()
	{
		Zend_Auth::getInstance () -> clearIdentity ();
		$this -> _redirect ('admin/index');
	}
}

