<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    Repository
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      12.05.2011
 */

use Doctrine\ORM\EntityRepository;

/**
 * Repository for the more elaborate queries
 *
 * @category   ShortUrl
 * @package    Repository
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      17.05.2011
 */
class ShortUrl_Repository_GroupUserRepository extends EntityRepository
{
    /**
     * Get all the users for a given group
	 *
	 * The group is given as object
	 *
     * @param int $number
     *
     * @return ShortUrl_Model_User []
     */
    public function getUsersForGroup($group)
    {
//        $dql = "SELECT b, e, r FROM Bug b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";
//
//        $query = $this->getEntityManager()->createQuery($dql);
//        $query->setMaxResults($number);
//        return $query->getResult();
    }


}