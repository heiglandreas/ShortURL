<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    ShortUrl_Api
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      03.06.2011
 */

/**
 * Handle SOAP-Requests
 *
 * @category   ShortUrl
 * @package    ShortUrl_Api
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      03.06.2011
 */
class ShortUrl_Api_User
{
    /**
     * Get a user by its ID
     *
     * @param int $id The ID of the user
     *
     * @return Object
     */
    public function getUser($id)
    {
        $user = new Object();
        return $user;
    }

    /**
     * Get a user by its username
     *
     * @param string $name The Username of the requested user
     *
     * @return Object
     */
    public function getUserByName($name)
    {
        $user = new Object();
        return $user;
    }
}