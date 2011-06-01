<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    Application
 * @subpackage Admin
 * @author     Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      27.05.2011
 */

/** ShortUrl_Controller_Action */
require_once 'ShortUrl/Controller/Action.php';

/**
 * Handle all the default stuff that is not handlede by one of the other
 * controllers in this module but goes into this module.
 *
 * @category   ShortUrl
 * @package    Application
 * @subpackage Admin
 * @author     Andreas Heigl<andreas@heigl.org>
 * @copyright 2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      27.05.2011
 */

class Admin_IndexController extends Heigl_Controller_Action
{

	public function indexAction()
    {
		$this -> view -> assign ( 'title', 'Your LinkShortener' );
		// action body
	}
}

