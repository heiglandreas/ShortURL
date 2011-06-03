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
class ShortUrl_Api_Url
{
    /**
     * Get an URL by its ID
     *
     * @param int $id The ID of the URL in the database
     *
     * @return Object
     */
    public function getUrl($id)
    {
        $user = new Object();
        return $user;
    }

    /**
     * Get an URL by its shorty
     *
     * @param string $shorty The shorty of an URL
     *
     * @return Object
     */
    public function getUrlByShorty($shorty)
    {
        $user = new Object();
        return $user;
    }
}