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
class ShortUrl_Repository_UrlRepository extends EntityRepository
{
    public function getUsersGroups($number = 30)
    {
//        $dql = "SELECT b, e, r FROM Bug b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";
//
//        $query = $this->getEntityManager()->createQuery($dql);
//        $query->setMaxResults($number);
//        return $query->getResult();
    }
}