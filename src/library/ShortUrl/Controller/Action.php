<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   Framework
 * @package    Heigl_Controller
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */

/** Zend_Controler_Action */
require_once 'Zend/Controller/Action.php';

/**
 * Override some defaults
 *
 * @category   Framework
 * @package    Heigl_Controller
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */
class ShortUrl_Controller_Action extends Zend_Controller_Action
{
    /**
     * Get the entityManager.
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->getBootstrap()->bootstrap('doctrine');
    }

    public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
    {
    {
        parent::__construct($request, $response, $invokeArgs);
        $view = $this->view;
        $view->doctype('XHTML1_STRICT');
        $view->headMeta()
             ->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
        $view->headTitle()
             ->setSeparator(' - ');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers/');
        $view->headLink(array('rel'=>'icon','href'=>'img/favicon.ico','type'=>'image/x-icon'))
             ->headLink(array('rel'=>'apple-touch-icon','href'=>'img/apple-touch-icon.png','sizes'=>'72x72'))
             ->appendStylesheet('css/screen.css', 'screen');
    }
        $titles = Zend_Registry::get('Zend_Config')->title;
        if($titles){
            foreach($titles as $title){
                $view->headTitle($title);
            }
        }
    }
}
