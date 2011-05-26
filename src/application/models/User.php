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

require_once  __DIR__ . '/../repositories/UserRepository.php';

/**
 * Object defines a User.
 *
 * This Object interacts with Group.
 *
 * User-Objects are grouped in Groups in a n:m-relation. So one user can be
 * member of more than one group and one group can hold more than one users.
 *
 * One User-Object is associated with the group as group-owner which is normaly
 * the creator of the group.
 *
 * Users are only used for authentication.
 *
 * @category   ShortUrl
 * @package    ShortUrl
 * @subpackage Model
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      17.05.2011
 * @Entity(repositoryClass="ShortUrl_Repository_UserRepository")
 * @Table(name="users")
 */
class ShortUrl_Model_User extends ShortUrl_Model_AbstractModel
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
     * The name of the given user
     *
     * @Column(type="string",name="user",nullable="TRUE")
     * @var string $_user
     */
    private $_user = null;

    /**
     * The user-id whith which the user registered
     *
     * @Column(type="string",name="uid",nullable="false")
     * @var string $_uid
     */
    private $_uid = null;

    /**
     * The Date of the last login
     *
     * @Column(type="datetime",name="lastlogin", nullable="false")
     * @var datetime $_lastlogin
     */
    private $_lastlogin = null;

    /**
     * The date of removing the account
     *
     * @Column(type="datetime", name="removedat",nullable="true")
     * @var datetime $_removedAt
     */
    private $_removedAt = null;

    /**
     * The mail-address of the user
     *
     * @Column(type="string", name="mail",nullable="true")
     * @var string $_mail
     */
    private $_mail = null;

    /**
     * What groups is this user the admin of
     *
     * @OneToMany(targetEntity="ShortUrl_Model_GroupUser",mappedBy="_user")
     * @var ArrayCollection $_groups
     */
    private $_groups = null;

    /**
     * Instantiate the Object
     *
     * @return void
     */
    public function __construct()
    {
        $this->_groups = new ArrayCollection();
    }

    /**
     * Add a user to the list of administrators
     *
     * Adding a user to the admin-members add her automaticaly to the
     * group-member list
     *
     * @param ShortUrl_Model_Group $group
     *
     * @return ShortUrl_Model_User
     */
    public function setAsAdmin(ShortUrl_Model_Group $group)
    {
        foreach($this->_groups as $grp){
            if($grp->getGroup()===$group){
                $grp->setAsAdmin();
                return $this;
            }
        }
        $con = new ShortUrl_Model_GroupUser();
        $con->setUser($this)
            ->setGroup($group)
            ->setAsAdmin()
            ->persist();
        $group->addConnection($con);
        $this->_groups[]=$con;
        return $this;
    }

    /**
     * Set a user as member to the given group
     *
     * @param ShortUrl_Model_Group $group
     *
     * @return ShortUrl_Model_User
     */
    public function setAsMember(ShortUrl_Model_Group $group)
    {
        foreach($this->_groups as $grp){
            if($grp->getGroup()===$group){
                $grp->setAsMember();
                return $this;
            }
        }
        $con = new ShortUrl_Model_GroupUser();
        $con->setUser($this)
            ->setGroup($group)
            ->setAsMember()
            ->persist();
        $group->addConnection($con);
        $this->_groups[]=$con;
        return $this;
    }

    /**
     * Remove the user as groupAdmin
     *
     * @param ShortUrl_Model_Group $group
     *
     * @return ShortUrl_Model_User
     */
    public function removeAsAdmin(ShortUrl_Model_Group $group)
    {
        foreach($this->_groups as $grp){
            if($grp->getGroup()===$group){
                $grp->setAsMember();
                return $this;
            }
        }
        return $this;
    }

    /**
     * Remove a user from the member-list of a group
     *
     * @param Application_Model_Group $group
     *
     * @return Application_Model_User
     */
    public function removeAsMember(ShortUrl_Model_Group $group)
    {
        foreach($this->_groups as $grp){
            if($grp->getGroup()===$group){
                $this->_groups->removeElement($grp);
                $group->removeConnection($grp);
                return $this;
            }
        }
        return $this;
    }

    /**
     * Remove a user from a group
     *
     * @param Application_Model_Group $group
     *
     * @return Application_Model_User
     */
    public function removeFromGroup(ShortUrl_Model_Group $group)
    {
        return $this->removeAsMember($group);
    }

    /**
     * Remove the user from all groups as admin
     *
     * @return Application_Model_User
     */
    public function removeAllAdmin()
    {
        foreach($this->_groups as $grp){
            if($grp->isAdmin()){
                $grp->setAsMember();
            }
        }
        return $this;
    }

    /**
     * Remove the user from all groups as member
     *
     * @return Application_Model_User
     */
    public function removeAllMember()
    {
        $this->_groups = new ArrayCollection();
        return $this;
    }

    /**
     * Add a user to the list of group-members
     */
    /**
     * Set the last login time
     *
     * @param DateTime $date
     *
     * @return Application_Model_User
     */
    public function setLastLogin( DateTime $date = null )
    {
        if(null==$date){
            $date=new DateTime();
        }
        $this->_lastlogin=$date;
        return $this;
    }

    /**
     * Get the last login time
     *
     * @return DateTime
     */
    public function getLastLogin()
    {
        return $this->_lastlogin;
    }

    /**
     * Set the name of the user
     *
     * @param string $name
     *
     * @return Application_Model_User
     */
    public function setName($name)
    {
        $this->_user=(string) $name;
        return $this;
    }

    /**
     * Get the user name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_user;
    }

    /**
     * Set the users ID
     *
     * @param string $uid
     *
     * @return Application_Model_User
     */
    public function setUid($uid)
    {
        $this->_uid=(string) $uid;
        return $this;
    }

    /**
     * Get the users ID
     *
     * @return string
     */
    public function getUid()
    {
        return (string)$this->_uid;
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
     * @return Application_Model_User
     */
    public function delete(DateTime $date = null)
    {
        if(null===$date){
            $date = new DateTime();
        }

        $this->_removedAt=$date;

        return $this;
    }

    /**
     * Check whether the user is an admin of the given group
     *
     * @param ShortUrl_Model_Group $group
     *
     * @return boolean
     */
    public function isAdminOf(ShortUrl_Model_Group $group)
    {
        foreach($this->_groups as $con){
            if($con->getGroup()===$group&&$con->isAdmin()){
                return true;
            }
        }
        return false;

    }

    /**
     * Check whether the user is member of the given group
     *
     * @param ShortUrl_Model_Group $group
     *
     * @return boolean
     */
    public function isMemberOf(ShortUrl_Model_Group $group)
    {
        foreach($this->_groups as $con){
            if($con->getGroup()===$group){
                return true;
            }
        }
        return false;

    }
}