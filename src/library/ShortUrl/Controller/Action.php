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

}
