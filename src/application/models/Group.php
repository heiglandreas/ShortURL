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

/**
 * Object defines a Group.
 *
 * This Object interacts with Users.
 *
 * User-Objects are grouped in Groups in a n:m-relation. So one user can be
 * member of more than one group and one group can hold more than one users.
 *
 * One User-Object is associated with the group as group-owner which is normaly
 * the creator of the group.
 *
 * Users are only used for authentication eveerything else is done by a group
 *
 * @category   ShortUrl
 * @package    ShortUrl
 * @author     Andreas Heigl<a.heigl@wdv.de>
 * @copyright  2011-@__YEAR__@ Andreas Heigl
 * @license    @__LICENSEURL__@ @__LICENSENAME__@
 * @version    @__VERSION__@
 * @since      17.05.2011
 * @Entity(repositoryClass="GroupRepository")
 * @Table(name="groups")
 */
class ShortUrl_Model_Group extends ShortUrl_Model_AbstractModel
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
     * The owner of the group
     *
     * @ManyToOne(targetEntity="ShortUrl_Model_User")
     * @var string $_owner
     */
    private $_owner = null;

    /**
     * The name of the group
     *
     * @Column(type="string",name="name",nullable="false")
     * @var string $_name
     */
    private $_name = null;

    /**
     * A list ofmembers for the given group
     *
     * @OneToMany(targetEntity="ShortUrl_Model_GroupUser", mappedBy="_group")
     * @var array $_mebmers
     */
    private $_members = null;

    /**
     * The date this group has been marked as deleted
     *
     * @Column(type="datetime",name="deletedat",nullable="true")
     * @var datetime $_deletedAt
     */
    private $_deletedAt = null;

    /**
     * Instantiate the Object
     *
     * @return void
     */
    public function __construct()
    {
        $this->_members = new ArrayCollection();
    }

    /**
     * Add a connection to the connection-list
     *
     * @param ShortUrl_Model_GroupUser $connection
     *
     * @return ShortUrl_Model_Group
     */
    public function addConnection($connection)
    {
        if(!$this->_members->contains($connection)){
            $this->_members[] = $connection;
        }

        return $this;
    }

    /**
     * Remove a connection to a user
     *
     * @param ShortUrl_Model_GroupUser $connection
     *
     * @return ShortUrl_Model_Group
     */
    public function removeConnection($connection)
    {
        if($this->_members->contains($connection)){
            $this->_members->removeElement($connection);
        }

        return $this;
    }

    /**
     * Add a user to the list of groupMembers
     *
     * @param Application_Model_User $user
     *
     * @return Application_Model_Group
     */
    public function addMember(ShortUrl_Model_User $user)
    {
        $user->setAsMember($this);
        return $this;
    }

    /**
     * Remove a user from the list of group members
     *
     * @param Application_Model_User $user
     *
     * @return Application_Model_Group
     */
    public function removeMember(ShortUrl_Model_User $user){

        $user->removeAsMember($this);
        return $this;
    }

    /**
     * Add a user as group-admin
     *
     * @param Application_Model_User $user
     *
     * @return Application_Model_Group
     */
    public function addAdmin(ShortUrl_Model_User $user)
    {
        $user->setAsAdmin($this);
        return $this;
    }

    /**
     * Remove a user from the list of admins for this group
     *
     * @param Application_Model_User $user
     *
     * @return Application_Model_Group
     */
    public function removeAdmin(ShortUrl_Model_User $user)
    {
        $user->removeAsAdmin($this);
        return $this;
    }

    /**
     * Set the name of the group
     *
     * @param string $name
     *
     * @return Application_Model_Group
     */
    public function setName($name)
    {
        $this->_name=(string) $name;
        return $this;
    }

    /**
     * Get the group name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
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
     * Check whether the given user is a member of the group.
     *
     * That includes admin-members as well as 'normal' members.
     *
     * @param ShortUrl_Model_User
     *
     * @return boolean
     */
    public function hasMember( ShortUrl_Model_User $user )
    {
        foreach ($this->_members as $member){
            if($member->getUser() === $user){
                return true;
            }
        }
        return false;
    }

    /**
     * Check wheter the given user is an admin of the group.
     *
     * @param ShortUrl_Model_User
     *
     * @return boolean
     */
    public function hasAdmin(ShortUrl_Model_User $user)
    {
        foreach($this->_members as $member){
            if($member->getUser()===$user&&$member->isAdmin()){
                return true;
            }
        }
        return false;
    }
}