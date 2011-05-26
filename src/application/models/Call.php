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

require_once __DIR__ . '/../repositories/CallRepository.php';
/**
 * Object defines a Call
 *
 * Each call for a shorty is logged
 *
 * @category   ShortUrl
 * @package    ShortUrl
 * @subpackage Model
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      17.05.2011
 * @Entity(repositoryClass="ShortUrl_Repository_CallRepository")
 * @Table(name="calls")
 */
class ShortUrl_Model_Call extends ShortUrl_Model_AbstractModel
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
     * The shorty this call has been for
     *
     * @ManyToOne(targetEntity="ShortUrl_Model_Call", inversedBy="_calls")
     * @var string $_url
     */
    private $_url = null;

    /**
     * The IP from which the call came
     *
     * @Column(type="string",name="ip")
     * @var string $_ip
     */
    private $_ip = null;

    /**
     * The Date of creation
     *
     * @Column(type="datetime",name="createdat")
     * @var datetime $_createdAt
     */
    private $_createdAt = null;

    /**
     * The url the call came from
     *
     * @Column(type="string",name="referer",nullable="true")
     * @var string $_referer
     */
    private $_referer = null;

    /**
     * The User-agent that requested the Shorty
     *
     * @Column(type="string",name="useragent")
     * @var string $_useragent
     */
    private $_useragent = null;

    /**
     * The Language the browser likes to retrieve
     *
     * @Column(type="string",name="locale")
     * @var string $_locale
     */
    private $_locale = null;

    /**
     * Set the shorty
     *
     * @param ShortUrl_Model_Url $url
     *
     * @return ShortUrl_Model_Call
     */
    public function setShorty(ShortUrl_Model_Url $url)
    {
        $this->_url=$url;
        return $this;
    }

    /**
     * Set the values for the call
     *
     * @return ShortUrl_Model_Call
     */
    public function setValues()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $config=Zend_Registry::get('Zend_Config');
        if(isset($config['anonymize'])&&$config['anonymize']){
            $ip=explode('.',$ip);
            $ip[2]=0;
            $ip[3]=0;
            $ip=implode('.',$ip);
        }
        $this->_ip=$ip;
        $this->_createdAt = new DateTime();
        if(isset($_SERVER['HTTP_REFERER'])){
            $this->_referer = $_SERVER['HTTP_REFERER'];
        }
        $this->_useragent = $_SERVER['HTTP_USER_AGENT'];
        $locale = new Zend_Locale();
        $this->_locale = $locale->toString();
        return $this;
    }

    /**
     * Get the id of the call
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }
}