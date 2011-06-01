<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   Application
 * @package    Controller
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */

/** ShortUrl_Controller_Action */
require_once 'ShortUrl/Controller/Action.php';

/**
 * Handle the default calls
 *
 * @category   Application
 * @package    Controller
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */
class IndexController extends ShortUrl_Controller_Action
{

    public function init()
    {
        $pages = array(
            array(
                'label'      => 'Home',
                'title'      => 'Go to home',
                'module'     => 'default',
                'controller' => 'index',
                'action'     => 'index',
                'order'      => -100 // Sicherstellen das Home die erste Seite ist
            ),
            array(
                'label'      => 'Contribute',
                'module'     => 'default',
                'controller' => 'index',
                'action'     => 'contribute',
            ),
            array(
                'label'      => 'Demo',
                'module'     => 'default',
                'controller' => 'index',
                'action'     => 'demo',
            ),
            array(
                'label'      => 'Download',
                'module'     => 'default',
                'controller' => 'index',
                'action'     => 'download',
            ),
            array(
                'label'      => 'Documentation',
                'module'     => 'default',
                'controller' => 'index',
                'action'     => 'documentation',
            ),
        );

        Zend_Registry::set('Zend_Navigation',new Zend_Navigation($pages));

    }

    public function indexAction()
    {
        $this -> _redirect ( 'home' );

    }


}

