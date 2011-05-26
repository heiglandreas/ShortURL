<?php
/**
 * @LICENSE_TEXT@
 *
 * @category   Authentication
 * @package    Heigl_Controller
 * @subpackage Plugin
 * @copyright  2011 Andreas Heigl<andreas@heigl.org>
 * @license    @LICENSE_URL@ @LICENSE@
 * @version    GIT: $Revision: $
 * @since      10.05.2011
 */

/** Zend_Controller_Plugin_Abstract */
require_once 'Zend/Controller/Plugin/Abstract.php';

/**
 * Provide a transparent way of securing the admin-module
 *
 * @category   Authentication
 * @package    Heigl_Controller
 * @subpackage Plugin
 * @copyright  2011 Andreas Heigl<andreas@heigl.org>
 * @license    @LICENSE_URL@ @LICENSE@
 * @version    GIT: $Revision: $
 * @since      10.05.2011
 */
class ShortUrl_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
	/**
	 *
	 */
    public function preDispatch ( Zend_Controller_Request_Abstract $request )
	{
		if ( ! Zend_Auth::getInstance () -> hasIdentity ()
			&& ( $request -> getModuleName () == 'admin' ) ) {
			// Begin IF.
		 	$response = $this -> getResponse ();
			$request -> setControllerName ( 'auth' );
            $request -> setActionName ( 'login' );
            $request -> setModuleName ( '' );
		}
	}
}
