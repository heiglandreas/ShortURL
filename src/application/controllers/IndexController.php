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

/** Heigl_Controller_Action */
require_once 'Heigl/Controller/Action.php';

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
class IndexController extends Heigl_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this -> _redirect ( 'admin/index/' );
    }


}

