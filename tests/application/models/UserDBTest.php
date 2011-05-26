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
class ShortUrl_Model_UserDBTest extends Zend_Test_PHPUnit_ControllerTestCase
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
          $this->_em->getClassMetadata('ShortUrl_Model_GroupUser'),
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

    public function testGettingUser()
    {
        $user1=new ShortUrl_Model_User();
        $user1->setName('foo')
              ->persist();

        $user2=new ShortUrl_Model_User();
        $user2->setName('bar')
              ->persist();

        $user3=new ShortUrl_Model_User();
        $user3->setName('baz')
              ->persist();

        $group1=new ShortUrl_Model_Group();
        $group1->setName('gFoo')
               ->persist();

        $group2=new ShortUrl_Model_Group();
        $group2->setName('gBar')
               ->persist();

        $group1->addMember($user1)
               ->addMember($user2);
        $group2->addMember($user2)
               ->addMember($user3);
        $this->_em->flush();

        $users = $this->_em->getRepository('ShortUrl_Model_User')->getUsersForGRoup($group2);
        $this->assertContains($user2,$users);
        $this->assertContains($user3,$users);
        $this->assertNotContains($user1,$users);
    }

    public function testStorage()
    {

        $user = new ShortUrl_Model_User();
        $this->_em->persist($user);
        $group= new ShortUrl_Model_Group();
        $this->_em->persist($group);
        $user->setName('name')
             ->setLastLogin()
             ->store();
        $url2=$this->_em->find('ShortUrl_Model_User',1);
        $this->assertTrue($url2 === $user);
    }

    public function testGetByUid()
    {
        $user = new ShortUrl_Model_User();
        $this->_em->persist($user);
        $user->setUid('foo')->store();
        $user2=$this->_em->getRepository('ShortUrl_Model_User')->getByUid('foo');
        $this->assertTrue($user === $user2);
    }
}
