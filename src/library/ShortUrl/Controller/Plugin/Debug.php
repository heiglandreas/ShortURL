<?php
/**
 * @LICENSE_TEXT@
 *
 * @category   ShortUrl
 * @package    ShortUrl_Controller
 * @subpackage Plugin
 * @copyright  2011 Andreas Heigl<andreas@heigl.org>
 * @license    @LICENSE_URL@ @LICENSE@
 * @version    GIT: $Revision: $
 * @since      10.05.2011
 */

/** Zend_Controller_Plugin_Abstract */
require_once 'Zend/Controller/Plugin/Abstract.php';

/**
 * Log Changes in the Routing
 *
 * @category   ShortUrl
 * @package    ShortUrl_Controller
 * @subpackage Plugin
 * @copyright  2011 Andreas Heigl<andreas@heigl.org>
 * @license    @LICENSE_URL@ @LICENSE@
 * @version    GIT: $Revision: $
 * @since      10.05.2011
 */
class ShortUrl_Controller_Plugin_Debug extends Zend_Controller_Plugin_Abstract
{
    public function routeStartup ( Zend_Controller_Request_Abstract $request )
	{
		$this->_log( $request, 'routeStartup');
	}

    public function routeShutdown ( Zend_Controller_Request_Abstract $request )
	{
		$this->_log( $request, 'routeShutdown');
	}

    public function preDispatch ( Zend_Controller_Request_Abstract $request )
	{
		$this->_log( $request, 'preDispatch');
	}

    public function postDispatch ( Zend_Controller_Request_Abstract $request )
	{
		$this->_log( $request, 'postDispatch');
	}

	private function _log(Zend_Controller_Request_Abstract $request, $where )
	{
	    Zend_Registry::get('Zend_Log')->log(
	        $where .
	        ': ' .
		    $request -> getModuleName () .
		    '/' .
            $request -> getControllerName () .
            '/' .
            $request -> getActionName (), Zend_Log::DEBUG );
	}
}
