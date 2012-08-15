<?php
namespace Bangnation\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="birth_date", type="datetime")
     */
    protected $birthDate;
    
    /**
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\Preference", inversedBy="users")
     * @ORM\JoinTable(name="Users_TurnOns")
     */
    protected $turnOns;

    /**
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\Preference", inversedBy="users")
     * @ORM\JoinTable(name="Users_TurnOffs")
     */
    protected $turnOffs;
    
    /**
     * The optional profile associated with this user.
     * 
     * @ORM\OneToOne(targetEntity="Profile", inversedBy="user", cascade={"persist", "remove"})
     **/
    private $profile;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set birthDate
     *
     * @param datetime $birthDate
     * @return User
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    
        return $this;
    }

    /**
     * Get birthDate
     *
     * @return datetime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Add turnOns
     *
     * @param Bangnation\UserBundle\Entity\Preference $turnOns
     * @return User
     */
    public function addTurnOn(\Bangnation\UserBundle\Entity\Preference $turnOns)
    {
        $this->turnOns[] = $turnOns;
    
        return $this;
    }

    /**
     * Remove turnOns
     *
     * @param Bangnation\UserBundle\Entity\Preference $turnOns
     */
    public function removeTurnOn(\Bangnation\UserBundle\Entity\Preference $turnOns)
    {
        $this->turnOns->removeElement($turnOns);
    }

    /**
     * Get turnOns
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTurnOns()
    {
        return $this->turnOns;
    }

    /**
     * Add turnOffs
     *
     * @param Bangnation\UserBundle\Entity\Preference $turnOffs
     * @return User
     */
    public function addTurnOff(\Bangnation\UserBundle\Entity\Preference $turnOffs)
    {
        $this->turnOffs[] = $turnOffs;
    
        return $this;
    }

    /**
     * Remove turnOffs
     *
     * @param Bangnation\UserBundle\Entity\Preference $turnOffs
     */
    public function removeTurnOff(\Bangnation\UserBundle\Entity\Preference $turnOffs)
    {
        $this->turnOffs->removeElement($turnOffs);
    }

    /**
     * Get turnOffs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTurnOffs()
    {
        return $this->turnOffs;
    }

    /**
     * Set profile
     *
     * @param Bangnation\UserBundle\Entity\Profile $profile
     * @return User
     */
    public function setProfile(\Bangnation\UserBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;
    
        return $this;
    }

    /**
     * Get profile
     *
     * @return Bangnation\UserBundle\Entity\Profile 
     */
    public function getProfile()
    {
        return $this->profile;
    }
}