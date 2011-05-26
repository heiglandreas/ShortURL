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
class ShortUrl_Model_UrlTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testShorty()
    {
        $url = new ShortUrl_Model_Url();
        $this->assertAttributeEquals(null,'_shorty',$url);
        $url->setShorty('test');
        $this->assertAttributeEquals('test','_shorty',$url);
        $this->assertEquals('test',$url->getShorty());
    }

    public function testUrl()
    {
        $url = new ShortUrl_Model_Url();
        $this->assertAttributeEquals(null,'_url',$url);
        $url->setUrl('test');
        $this->assertAttributeEquals('test','_url',$url);
        $this->assertEquals('test',$url->getUrl());
    }

    public function testCreatedAt()
    {
        $url = new ShortUrl_Model_Url();
        $this->assertAttributeEquals(null,'_createdAt',$url);
        $url->setCreatedAt();
        $dateTime = new DateTime();
        $this->assertAttributeEquals($dateTime,'_createdAt',$url);
        $this->assertEquals($dateTime,$url->getCreatedAt());
        $dateTime=new DateTime('2010-05-05H12:34:45+02:30');
        $url->setCreatedAt($dateTime);
        $this->assertAttributeEquals($dateTime,'_createdAt',$url);
        $this->assertEquals($dateTime,$url->getCreatedAt());
    }

    public function testCreatedBy()
    {
        $url = new ShortUrl_Model_Url();
        $user= new ShortUrl_Model_User();
        $this->assertAttributeEquals(null,'_createdBy',$url);
        $url->setCreatedBy($user);
        $this->assertAttributeEquals($user,'_createdBy',$url);
        $this->assertEquals($user,$url->getCreatedBy());

    }

    public function testCreatedFor()
    {
        $url  = new ShortUrl_Model_Url();
        $group= new ShortUrl_Model_Group();
        $this->assertAttributeEquals(null,'_createdFor',$url);
        $url->setCreatedFor($group);
        $this->assertAttributeEquals($group,'_createdFor',$url);
        $this->assertEquals($group,$url->getCreatedFor());

    }

    public function testId()
    {
        $url = new ShortUrl_Model_Url();
        $this->assertAttributeEquals(null,'_id',$url);
        $this->assertEquals(0,$url->getId());
    }

}
