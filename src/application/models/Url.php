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

use Doctrine\Common\Collections\ArrayCollection;

require_once __DIR__ . '/../repositories/UrlRepository.php';
/**
 * Object defines an URL
 *
 * This is the main stuff because it maps the short tag to the real URL
 *
 * An URL-Object mainly consists of the short and long URL, creation-time,
 * -user and -group
 *
 * @category   ShortUrl
 * @package    ShortUrl
 * @subpackage Model
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      17.05.2011
 * @Entity(repositoryClass="ShortUrl_Repository_UrlRepository")
 * @Table(name="urls")
 */
class ShortUrl_Model_Url extends ShortUrl_Model_AbstractModel
{
    /**
     * The ID
     *
     * @Id
     * @Column(type="integer",name="id",nullable="FALSE")
     * @GeneratedValue(strategy="AUTO")
     * @var integer $_id
     */
    private $_id = null;

    /**
     * The shorty
     *
     * @Column(type="string",name="shorty",nullable="false")
     * @var string $_shorty
     */
    private $_shorty = null;

    /**
     * The URL to map to the shorty
     *
     * This can be either a regular URL or an internal URL like internal://<id>
     * where <id> is the ID of a shorty to link to. That enables internal
     * linking and renaming a link after it'S initial creation
     *
     * @Column(type="string",name="url")
     * @var string $_url
     */
    private $_url = null;

    /**
     * The Date of creation
     *
     * @Column(type="datetime",name="createdat")
     * @var datetime $_createdAt
     */
    private $_createdAt = null;

    /**
     * The user that created the URL
     *
     * @ManyToOne(targetEntity="ShortUrl_Model_User")
     * @var ShortUrl_Model_User $_createdBy
     */
    private $_createdBy = null;

    /**
     * The group the URL was created for
     *
     * @ManyToOne(targetEntity="ShortUrl_Model_Group")
     * @var ShortUrl_Model_Group $_createdFor
     */
    private $_createdFor = null;

    /**
     * The calls for this shorty
     *
     * @OneToMany(targetEntity="ShortUrl_Model_Url", mappedBy="_url")
     * @var array $_calls
     */
    private $_calls = null;

    /**
     * Instantiate the object
     *
     * @return void
     */
    public function __construct()
    {
        $this->_calls = new ArrayCollection();
    }

    /**
     * Set the shorty for the URL
     *
     * @param string $shorty
     *
     * @return ShortUrl_Model_Url
     */
    public function setShorty($shorty)
    {
        $this->_shorty = (string)$shorty;
        return $this;
    }

    /**
     * Get the shorty for the URL
     *
     * @return string
     */
    public function getShorty()
    {
        return (string)$this->_shorty;
    }

    /**
     * Set the URL for the shorty
     *
     * @param string $url
     *
     * @todo Check whether the URL is a valid one or not.
     * @return ShortUrl_Model_Url
     */
    public function setUrl($url)
    {
        $this->_url = (string)$url;
        return $this;
    }

    /**
     * Get the URL for the Shorty
     *
     * @return string
     */
    public function getUrl()
    {
        return (string) $this->_url;
    }
    /**
     * Get this objects database-id
     *
     * @return int
     */
    public function getId()
    {
        return (int)$this->_id;
    }

    /**
     * Mark a user as deleted
     *
     * @param DateTime $date
     *
     * @return User
     */
    public function setCreatedAt(DateTime $date = null)
    {
        if(null===$date){
            $date = new DateTime();
        }

        $this->_createdAt=$date;

        return $this;
    }

    /**
     * Get the creation Date
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        if(!$this->_createdAt instanceof DateTime){
            $this->_createdAt=new DateTime($this->_createdAt);
        }
        return $this->_createdAt;
    }

    /**
     * Set the creator of the url
     *
     * @param ShortUrl_Model_User $user
     *
     * @return ShortUrl_Model_Url
     */
    public function setCreatedBy(ShortUrl_Model_User $user)
    {
        $this->_createdBy=$user;
        return $this;
    }

    /**
     * Get the creator of the URL
     *
     * @return ShortUrl_Model_User
     */
    public function getCreatedBy()
    {
        return $this->_createdBy;
    }

    /**
     * Set the group of the url
     *
     * @param ShortUrl_Model_Group $group
     *
     * @return ShortUrl_Model_Url
     */
    public function setCreatedFor(ShortUrl_Model_Group $group)
    {
        $this->_createdFor=$group;
        return $this;
    }

    /**
     * Get the group for the URL
     *
     * @return ShortUrl_Model_Group
     */
    public function getCreatedFor()
    {
        return $this->_createdFor;
    }


}