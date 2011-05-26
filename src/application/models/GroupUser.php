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

require_once  __DIR__ . '/../repositories/GroupUserRepository.php';

/**
 * Object defines a UserGroup Relationship.
 *
 * This Object interacts with Group and User.
 *
 * User-Objects are grouped in Groups in a n:m-relation. So one user can be
 * member of more than one group and one group can hold more than one users.
 *
 * The Relationship also contains an information on whether the user has
 * administrative rights for the given group
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
 * @Entity(repositoryClass="ShortUrl_Repository_GroupUserRepository")
 * @Table(name="groupusers")
 */
class ShortUrl_Model_GroupUser extends ShortUrl_Model_AbstractModel
{
    const ADMIN = 0;

    const MEMBER = 1;

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
     * The user of this connection
     *
     * @ManyToOne(targetEntity="ShortUrl_Model_User", inversedBy="_groups")
     * @joinColumn(name="user_id", referencedColumnName="id")
     * @var ShortUrl_Model_User $_user
     */
    private $_user = null;

    /**
     * The group-side of the connection
     *
     * @ManyToOne(targetEntity="ShortUrl_Model_Group", inversedBy="_members")
     * @joinColumn(name="group_id", referencedColumnName="id")
     * @var ShortUrl_Model_Group $_group
     */
    private $_group = null;

    /**
     * The type of relation.
     *
     * This can be one of ShortUrl_Model_GroupUser::ADMIN or
     * ShortUrl_Model_GroupUser::MEMBER
     *
     * @Column(type="integer",name="type", nullable="false")
     * @var int $_connectionType
     */
    private $_connectionType = self::MEMBER;

    /**
     * Insstantiate the Object
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Set the user for the relation
     *
     * @param ShortUrl_Model_User $user
     *
     * @return ShortUrl_Model_GroupUser
     */
    public function setUser(ShortUrl_Model_User $user)
    {
        $this->_user=$user;
        return $this;
    }

    /**
     * Get the user for this relation
     *
     * @return ShortUrl_Model_User
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * Set the group for the relation
     *
     * @param ShortUrl_Model_Group $group
     *
     * @return Short_Model_GroupUser
     */
    public function setGroup(ShortUrl_Model_Group $group)
    {
        $this->_group=$group;
        return $this;
    }

    /**
     * Get the group for this relation
     *
     * @return ShortUrl_Model_Group
     */
    public function getGroup()
    {
        return $this->_group;
    }

    /**
     * Set the type of the relation
     *
     * @param int $type
     *
     * @return ShortUrl_Model_GroupUser
     */
    public function setType($type)
    {
        $this->_type = (int) $type;
        return $this;
    }

    /**
     * Get the type of the relation
     *
     * @return int
     */
    public function getType()
    {
        return (int) $this->_type;
    }

    /**
     * Check whether the user is an admin-user of the group
     *
     * @return boolean
     */
    public function isAdmin()
    {
        if(self::ADMIN===(int) $this->_type){
            return true;
        }
        return false;
    }

    /**
     * Check whether the user is a normal member of the group
     *
     * @return boolean
     */
    public function isMember()
    {
        if(self::MEMBER===(int) $this->_type){
            return true;
        }
        return false;
    }

    /**
     * Set the user as default-member of the group
     *
     * @return ShortUrl_Member_GroupUser
     */
    public function setAsMember()
    {
        return $this->setType(self::MEMBER);
    }

    /**
     * Set the user as admin of the group
     *
     * @return ShortUrl_Member_GroupUser
     */
    public function setAsAdmin()
    {
        return $this->setType(self::ADMIN);
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


}