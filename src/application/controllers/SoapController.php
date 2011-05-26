<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    Controller
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
 * @package    Controller
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      26.05.2011
 */
class SoapController extends ShortUrl_Controller_Action
{
    /**
     * This is the default action
     *
     * @return void
     */
    public function __call()
    {
        $wsdl    = new Zend_Soap_AutoDiscover();
        $options = array();
        $server  = new Zend_Soap_Server ($wsdl, $options);
        $server->setClass();
    }
}