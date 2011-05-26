<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    ShortUrl_Soap
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      26.05.2011
 */

/**
 * Handle actions for User-Objects
 *
 * @category   ShortUrl
 * @package    ShortUrl_Soap
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      26.05.2011
 */
class ShortUrl_Soap_User
{
    /**
     * This method returns all users for a given group.
     *
     * @param int $groupId The ID of the group to get the users for
     *
     * @return ShortUrl_Stash_User[]
     */
    public function getUsersForGroup($groupId)
    {
        $return = array ();
        return $return;
    }

    /**
     * This method returns the user-object referenced by the given ID
     *
     * @param int $userId The ID of the user to return
     *
     * @return ShortUrl_Stash_User
     */
    public function getUser($userId)
    {
        $user = $this->_em->find('ShortUrl_Model_User', $userId);
        return $user->getStash();
    }
}