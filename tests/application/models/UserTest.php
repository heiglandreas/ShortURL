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
 * Test the User-Model
 *
 * @category   ShortUrl
 * @package    Tests
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      20.05.2011
 */
class ShortUrl_Model_UserTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testName()
    {
        $user = new ShortUrl_Model_User();
        $user->setName('test');
        $this->assertAttributeEquals('test','_user',$user);
        $this->assertEquals('test',$user->getName());
    }

    public function testLastLogin()
    {
        //$this->skipTest('Checking for Objekts in attributes does not work');
        $user = new ShortUrl_Model_User();
        $datetime = new DateTime();
        $user->setLastLogin();
        $this->assertAttributeEquals($datetime,'_lastlogin',$user);
        $datetime = new DateTime('2011-05-23H14:55:07+02:00');
        $user->setLastLogin($datetime);
        $this->assertAttributeEquals($datetime,'_lastlogin',$user);
        $this->assertSame($datetime,$user->getLastLogin());

    }

    public function testUid()
    {
        $user = new ShortUrl_Model_User();
        $user->setUid('test');
        $this->assertAttributeContains('test','_uid',$user);
        $this->assertEquals('test',$user->getUid());
    }

    public function testGEtId()
    {
        $user = new ShortUrl_Model_User();
        $this->assertAttributeEquals(null,'_id',$user);
        $this->assertEquals(0,$user->getId());
        $this->markTestIncomplete('Tests only for NULL-value');
    }

    public function testAddMember()
    {
        $user = new ShortUrl_Model_User();
        $group = new ShortUrl_Model_Group();
        $group->addMember($user);
        $this->assertTrue($group->hasMember($user));
        $group->removeMember($user);
        $this->assertFalse($group->hasMember($user));
    }

    public function testDelete()
    {
        $user = new ShortUrl_Model_User();
        $this->assertAttributeEquals(null,'_removedAt',$user);
        $datetime= new DateTime();
        $user->delete();
        $this->assertAttributeEquals($datetime,'_removedAt',$user);
        $datetime = new DateTime('2011-05-23H14:55:07+02:00');
        $user->delete($datetime);
        $this->assertAttributeEquals($datetime,'_removedAt',$user);
        $this->markTestIncomplete('No getter for Delete-Date is tested ');
    }

    public function testAddAdmin()
    {
        $user = new ShortUrl_Model_User();
        $group = new ShortUrl_Model_Group();
        $group->addAdmin($user);
        $this->assertTrue($group->hasMember($user));
        $this->assertTrue($group->hasAdmin($user));
        $this->assertTrue($user->isMemberOf($group));
        $this->assertTrue($user->isAdminOf($group));
        $group->removeAdmin($user);
        $this->assertTrue($group->hasMember($user));
        $this->assertFalse($group->hasAdmin($user));
        $this->assertTrue($user->isMemberOf($group));
        $this->assertFalse($user->isAdminOf($group));
        $group->addAdmin($user);
        $this->assertTrue($group->hasMember($user));
        $this->assertTrue($group->hasAdmin($user));
        $this->assertTrue($user->isMemberOf($group));
        $this->assertTrue($user->isAdminOf($group));
        $group->removeMember($user);
        $this->assertFalse($group->hasMember($user));
        $this->assertFalse($group->hasAdmin($user));
        $this->assertFalse($user->isMemberOf($group));
        $this->assertFalse($user->isAdminOf($group));
    }

public function testAddAdminWithSecondUser()
    {
        $user1 = new ShortUrl_Model_User();
        $user2 = new ShortUrl_Model_User();
        $group = new ShortUrl_Model_Group();
        $group->addAdmin($user1);
        $group->addMember($user2);
        $this->assertTrue($group->hasMember($user1));
        $this->assertTrue($group->hasMember($user2));
        $this->assertTrue($group->hasAdmin($user1));
        $this->assertFalse($group->hasAdmin($user2));
        $this->assertTrue($user1->isMemberOf($group));
        $this->assertTrue($user2->isMemberOf($group));
        $this->assertTrue($user1->isAdminOf($group));
        $this->assertFalse($user2->isAdminOf($group));

        $group->removeAdmin($user1);
        $this->assertTrue($group->hasMember($user1));
        $this->assertTrue($group->hasMember($user2));
        $this->assertFalse($group->hasAdmin($user1));
        $this->assertFalse($group->hasAdmin($user2));
        $this->assertTrue($user1->isMemberOf($group));
        $this->assertTrue($user2->isMemberOf($group));
        $this->assertFalse($user1->isAdminOf($group));
        $this->assertFalse($user2->isAdminOf($group));

        $group->addAdmin($user2);
        $this->assertTrue($group->hasMember($user1));
        $this->assertTrue($group->hasMember($user2));
        $this->assertFalse($group->hasAdmin($user1));
        $this->assertTrue($group->hasAdmin($user2));
        $this->assertTrue($user1->isMemberOf($group));
        $this->assertTrue($user2->isMemberOf($group));
        $this->assertFalse($user1->isAdminOf($group));
        $this->assertTrue($user2->isAdminOf($group));

        $group->removeMember($user1);
        $this->assertFalse($group->hasMember($user1));
        $this->assertTrue($group->hasMember($user2));
        $this->assertFalse($group->hasAdmin($user1));
        $this->assertTrue($group->hasAdmin($user2));
        $this->assertFalse($user1->isMemberOf($group));
        $this->assertTrue($user2->isMemberOf($group));
        $this->assertFalse($user1->isAdminOf($group));
        $this->assertTrue($user2->isAdminOf($group));

    }

    public function testRemoveAll()
    {
        $user1 = new ShortUrl_Model_User();
        $user2 = new ShortUrl_Model_User();
        $user3 = new ShortUrl_Model_User();
        $group1 = new ShortUrl_Model_Group();
        $group2= new ShortUrl_Model_Group();

        $group1->addMember($user1);
        $group1->addAdmin($user2);
        $group1->addMember($user3);
        $group2->addAdmin($user2);

        $this->assertTrue($user1->isMemberOf($group1));
        $this->assertFalse($user1->isAdminOf($group1));
        $this->assertFalse($user1->isMemberOf($group2));
        $this->assertFalse($user1->isAdminOf($group2));
        $this->assertTrue($user2->isMemberOf($group1));
        $this->assertTrue($user2->isAdminOf($group1));
        $this->assertTrue($user2->isMemberOf($group2));
        $this->assertTrue($user2->isAdminOf($group2));
        $this->assertTrue($user3->isMemberOf($group1));
        $this->assertFalse($user3->isAdminOf($group1));
        $this->assertFalse($user3->isMemberOf($group2));
        $this->assertFalse($user3->isAdminOf($group2));

        // Everthing Set up properly
        $user1->removeAllAdmin(); // Should affect nothing!
        $this->assertTrue($user1->isMemberOf($group1));
        $this->assertFalse($user1->isAdminOf($group1));
        $this->assertFalse($user1->isMemberOf($group2));
        $this->assertFalse($user1->isAdminOf($group2));
        $this->assertTrue($user2->isMemberOf($group1));
        $this->assertTrue($user2->isAdminOf($group1));
        $this->assertTrue($user2->isMemberOf($group2));
        $this->assertTrue($user2->isAdminOf($group2));
        $this->assertTrue($user3->isMemberOf($group1));
        $this->assertFalse($user3->isAdminOf($group1));
        $this->assertFalse($user3->isMemberOf($group2));
        $this->assertFalse($user3->isAdminOf($group2));

        // Remove user2 as admin
        $user2->removeAllAdmin(); // Should affect nothing!
        $this->assertTrue($user1->isMemberOf($group1));
        $this->assertFalse($user1->isAdminOf($group1));
        $this->assertFalse($user1->isMemberOf($group2));
        $this->assertFalse($user1->isAdminOf($group2));
        $this->assertTrue($user2->isMemberOf($group1));
        $this->assertFalse($user2->isAdminOf($group1));
        $this->assertTrue($user2->isMemberOf($group2));
        $this->assertFalse($user2->isAdminOf($group2));
        $this->assertTrue($user3->isMemberOf($group1));
        $this->assertFalse($user3->isAdminOf($group1));
        $this->assertFalse($user3->isMemberOf($group2));
        $this->assertFalse($user3->isAdminOf($group2));

        // remove user2 completely
        $group1->addAdmin($user2);
        $this->assertTrue($user1->isMemberOf($group1));
        $this->assertFalse($user1->isAdminOf($group1));
        $this->assertFalse($user1->isMemberOf($group2));
        $this->assertFalse($user1->isAdminOf($group2));
        $this->assertTrue($user2->isMemberOf($group1));
        $this->assertTrue($user2->isAdminOf($group1));
        $this->assertTrue($user2->isMemberOf($group2));
        $this->assertFalse($user2->isAdminOf($group2));
        $this->assertTrue($user3->isMemberOf($group1));
        $this->assertFalse($user3->isAdminOf($group1));
        $this->assertFalse($user3->isMemberOf($group2));
        $this->assertFalse($user3->isAdminOf($group2));

        // Remove user 2 completely
        $user2->removeAllMember();
        $this->assertTrue($user1->isMemberOf($group1));
        $this->assertFalse($user1->isAdminOf($group1));
        $this->assertFalse($user1->isMemberOf($group2));
        $this->assertFalse($user1->isAdminOf($group2));
        $this->assertFalse($user2->isMemberOf($group1));
        $this->assertFalse($user2->isAdminOf($group1));
        $this->assertFalse($user2->isMemberOf($group2));
        $this->assertFalse($user2->isAdminOf($group2));
        $this->assertTrue($user3->isMemberOf($group1));
        $this->assertFalse($user3->isAdminOf($group1));
        $this->assertFalse($user3->isMemberOf($group2));
        $this->assertFalse($user3->isAdminOf($group2));

    }
}



