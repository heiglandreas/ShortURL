<?php
/**
 * @__LICENSE_TEXT__@
 *
 * @category   ShortUrl
 * @package    Tests
 * @subpackage Model
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      20.05.2011
 */

use \Doctrine\ORM\Tools\SchemaTool;

/**
 * Test the URL-Model
 *
 * @category   ShortUrl
 * @package    Tests
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      20.05.2011
 */
class ShortUrl_Model_UrlDBTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    protected $_em = null;
    protected $_classes = null;
    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
        $this->_em = Zend_Registry::get('entityManager');
        $tool = new SchemaTool($this->_em);
        $this->_classes = array(
          $this->_em->getClassMetadata('ShortUrl_Model_User'),
          $this->_em->getClassMetadata('ShortUrl_Model_Group'),
          $this->_em->getClassMetadata('ShortUrl_Model_Url'),
        );
        $tool->createSchema($this->_classes);

    }

    public function tearDown()
    {
//        $tool = new SchemaTool($this->_em);
//        $tool->dropSchema($this->_classes);
    }


    public function testStorage()
    {

        $user = new ShortUrl_Model_User();
        $this->_em->persist($user);
        $group= new ShortUrl_Model_Group();
        $this->_em->persist($group);
        $url  = new ShortUrl_Model_Url();
        $url->setShorty('shorty')
            ->setUrl('url')
            ->setCreatedAt()
            ->setCreatedBy($user)
            ->setCreatedFor($group)
            ->store();
        $url2=$this->_em->find('ShortUrl_Model_Url',1);
        $this->assertTrue($url===$url2);
    }
}
