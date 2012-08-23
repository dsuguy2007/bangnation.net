<?php

namespace Bangnation\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bangnation\UserBundle\Entity\Preference
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bangnation\UserBundle\Entity\PreferenceRepository")
 */
class Preference
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /** 
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\User", mappedBy="turnOns") 
     */
    protected $turnOnUsers;
    
    /** 
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\User", mappedBy="turnOffs") 
     */
    protected $turnOffUsers;
    
    public function __construct()
    {
        $this->turnOnUsers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->turnOffUsers = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return TurnOnsOffs
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add turnOnUsers
     *
     * @param Bangnation\UserBundle\Entity\User $turnOnUsers
     * @return Preference
     */
    public function addTurnOnUser(\Bangnation\UserBundle\Entity\User $turnOnUsers)
    {
        $this->turnOnUsers[] = $turnOnUsers;
    
        return $this;
    }

    /**
     * Remove turnOnUsers
     *
     * @param Bangnation\UserBundle\Entity\User $turnOnUsers
     */
    public function removeTurnOnUser(\Bangnation\UserBundle\Entity\User $turnOnUsers)
    {
        $this->turnOnUsers->removeElement($turnOnUsers);
    }

    /**
     * Get turnOnUsers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTurnOnUsers()
    {
        return $this->turnOnUsers;
    }

    /**
     * Add turnOffUsers
     *
     * @param Bangnation\UserBundle\Entity\User $turnOffUsers
     * @return Preference
     */
    public function addTurnOffUser(\Bangnation\UserBundle\Entity\User $turnOffUsers)
    {
        $this->turnOffUsers[] = $turnOffUsers;
    
        return $this;
    }

    /**
     * Remove turnOffUsers
     *
     * @param Bangnation\UserBundle\Entity\User $turnOffUsers
     */
    public function removeTurnOffUser(\Bangnation\UserBundle\Entity\User $turnOffUsers)
    {
        $this->turnOffUsers->removeElement($turnOffUsers);
    }

    /**
     * Get turnOffUsers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTurnOffUsers()
    {
        return $this->turnOffUsers;
    }
}