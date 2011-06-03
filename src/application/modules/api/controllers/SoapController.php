<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    Application
 * @subpackage Api
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      03.06.2011
 */

/**
 * Handle SOAP-Requests
 *
 * @category   ShortUrl
 * @package    Application
 * @subpackage Api
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      03.06.2011
 */
class Api_SoapController extends Zend_Controller_Action
{

    /**
     * Initialitzethe Controller by setting the WSDL-Path and completely
     * disabling output
	 *
	 * @return void
     */
    public function init()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout->disableLayout();
    }

    /**
     * Main Action that handles Requests
     *
     *
     * Enter description here ...
     */
    public function indexAction()
    {
        $this->_helper->viewRenderer->setNoRender(false);
        $this->_helper->layout->enableLayout();
        $this->view->assign('apis',array('user','url','group','session'));
    }

    /**
     * Handle requests regarding users
     *
     * @return void
     */
    public function __call($function, $params)
    {
        $action = strtolower(str_replace('Action','',$function));
        $class = 'ShortUrl_Api_' . ucfirst($action);
        if(!@include_once str_replace('_','/',$class) . '.php'){
            throw new ShortUrl_Api_ClassNotFoundException($class);
        }
        if(isset($_GET['wsdl'])) {
            $autodiscover = new Zend_Soap_AutoDiscover();
            $autodiscover->setClass($class)
                         ->handle();
        } else {
            $soap = new Zend_Soap_Server($this->_getWsdl($action));
            $soap->setClass($class)
                 ->handle();
        }
    }

    private function _getWsdl($for)
    {
        return Zend_Controller_Front::getBaseUrl() . '/soap/' . $for . '?wsdl';
    }

}

