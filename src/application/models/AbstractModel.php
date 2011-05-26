<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    ShortUrl
 * @subpackage Model
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */

/**
 * Abstract Object that handles basic storage
 *
 * @category   ShortUrl
 * @package    ShortUrl
 * @subpackage Model
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      17.05.2011
 */
abstract class ShortUrl_Model_AbstractModel
{
    /**
	 * Handle storage by providing AbstractModel::store()
	 *
	 * @return AbstractModel
	 */
    public function store()
    {
        $em = Zend_Registry::get('entityManager');
        if(null==$this->getId()){
            $em->persist($this);
        }
        $em->flush();
        return $this;
    }

    /**
     * Prepare for storage
     *
     * @return ShortUrl_Model_Abstract
     */
    public function persist()
    {
        if(null==$this->getId()){
            $em = Zend_Registry::get('entityManager');
            $em->persist($this);
        }
        return $this;
    }

    /**
     * Find an object with the given primary-key
     *
     * @param mixed $value
     */
    public static function find($value)
    {
        return Zend_Registry::get('entityManager')->find(get_class(self),$value);
    }
}