<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    Soap
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      26.05.2011
 */

/** ShortUrl_Controller_Action */
require_once 'ShortUrl/Controller/Action.php';


/**
 * Handle calls to the soap-server
 *
 * @category   ShortUrl
 * @package    Soap
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      26.05.2011
 */
class Soap_IndexController extends ShortUrl_Controller_Action
{

    public function init()
    {
		$this->_helper->viewRenderer->setNoRender ();
    }

    public function indexAction()
    {
        if($this->getRequest()->getParam('wsdl') == 'show'){
        	$autodiscover = new Zend_Soap_AutoDiscover();
        	$autodiscover->setClass('Soap_Model_User');
        	$autodiscover->handle();
        }else{
        	$server = new Zend_Soap_Server($url);
        	$server->setClass('Soap_Model_User');
        	$server->handle();
        }
    }


}

