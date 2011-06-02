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
    }

    public function indexAction()
    {
        $this -> _redirect ( 'home/index' );

    }


}

