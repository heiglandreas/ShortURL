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

/**
 * Test the Group-Model
 *
 * @category   ShortUrl
 * @package    Tests
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      20.05.2011
 */
class ShortUrl_Model_GroupTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testGroupName()
    {
        $group = new ShortUrl_Model_Group();
        $this->assertAttributeEquals(null,'_name',$group);
        $group->setName('test');
        $this->assertAttributeEquals('test','_name',$group);
        $this->assertEquals('test',$group->getName());
    }


    public function testId()
    {
        $group = new ShortUrl_Model_Group();
        $this->assertAttributeEquals(null,'_id',$group);
        $this->assertEquals(0,$group->getId());
        $this->markTestIncomplete('Tests only for NULL-value');
    }
}
