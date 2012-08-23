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
     * @ORM\Column(name="last_activity", type="datetime", nullable=true)
     */
    protected $lastActivity;
        
    /**
     * @ORM\Column(name="timezone", type="string", length=255)
     */
    private $timeZone;

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
     * @ORM\ManyToMany(targetEntity="Bangnation\EventBundle\Entity\Event", mappedBy="attendees")
     */
    protected $eventsAttending;
    
    /**
     * @ORM\ManyToMany(targetEntity="Bangnation\EventBundle\Entity\Event", mappedBy="hosts")
     */
    protected $eventsHosting;
    
    /**
     * The optional profile associated with this user.
     * 
     * @ORM\OneToOne(targetEntity="Profile", inversedBy="user", cascade={"persist", "remove"})
     **/
    private $profile;
    
    /**
     * @ORM\OneToMany(targetEntity="Bangnation\ChatBundle\Entity\Chat", mappedBy="targetUser")
     */
    private $incomingChats;
    
    /**
     * @ORM\OneToMany(targetEntity="Bangnation\ChatBundle\Entity\Chat", mappedBy="sourceUser")
     */
    private $outgoingChats;

    public function __construct()
    {
        parent::__construct();
        
        $this->turnOns = new \Doctrine\Common\Collections\ArrayCollection();
        $this->turnOffs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->incomingChats = new \Doctrine\Common\Collections\ArrayCollection();
        $this->outgoingChats = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add incomingChats
     *
     * @param Bangnation\ChatBundle\Entity\Chat $incomingChats
     * @return User
     */
    public function addIncomingChat(\Bangnation\ChatBundle\Entity\Chat $incomingChats)
    {
        $this->incomingChats[] = $incomingChats;
    
        return $this;
    }

    /**
     * Remove incomingChats
     *
     * @param Bangnation\ChatBundle\Entity\Chat $incomingChats
     */
    public function removeIncomingChat(\Bangnation\ChatBundle\Entity\Chat $incomingChats)
    {
        $this->incomingChats->removeElement($incomingChats);
    }

    /**
     * Get incomingChats
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIncomingChats()
    {
        return $this->incomingChats;
    }

    /**
     * Add outgoingChats
     *
     * @param Bangnation\ChatBundle\Entity\Chat $outgoingChats
     * @return User
     */
    public function addOutgoingChat(\Bangnation\ChatBundle\Entity\Chat $outgoingChats)
    {
        $this->outgoingChats[] = $outgoingChats;
    
        return $this;
    }

    /**
     * Remove outgoingChats
     *
     * @param Bangnation\ChatBundle\Entity\Chat $outgoingChats
     */
    public function removeOutgoingChat(\Bangnation\ChatBundle\Entity\Chat $outgoingChats)
    {
        $this->outgoingChats->removeElement($outgoingChats);
    }

    /**
     * Get outgoingChats
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOutgoingChats()
    {
        return $this->outgoingChats;
    }

    /**
     * Set online
     *
     * @param boolean $online
     * @return User
     */
    public function setOnline($online)
    {
        $this->setLastActivity(new \DateTime("now"));
    
        return $this;
    }

    /**
     * Get online
     *
     * @return boolean 
     */
    public function getOnline()
    {
        $now = new DateTime('now');
        $diff = $this->getLastActivity() - $now->getTimestamp();
        
        return $diff < 10;
    }

    /**
     * Set lastActivity
     *
     * @param \DateTime $lastActivity
     * @return User
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;
    
        return $this;
    }

    /**
     * Get lastActivity
     *
     * @return \DateTime 
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }
    
    /**
     * Set timeZone
     *
     * @param string $timeZone
     * @return User
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string 
     */
    public function getTimeZone()
    {
        if (empty($this->timeZone)) {
            return 'UTC';
        }
        return $this->timeZone;
    }


    /**
     * Add eventsAttending
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsAttending
     * @return User
     */
    public function addEventsAttending(\Bangnation\EventBundle\Entity\Event $eventsAttending)
    {
        $this->eventsAttending[] = $eventsAttending;
    
        return $this;
    }

    /**
     * Remove eventsAttending
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsAttending
     */
    public function removeEventsAttending(\Bangnation\EventBundle\Entity\Event $eventsAttending)
    {
        $this->eventsAttending->removeElement($eventsAttending);
    }

    /**
     * Get eventsAttending
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEventsAttending()
    {
        return $this->eventsAttending;
    }

    /**
     * Add eventsHosting
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsHosting
     * @return User
     */
    public function addEventsHosting(\Bangnation\EventBundle\Entity\Event $eventsHosting)
    {
        $this->eventsHosting[] = $eventsHosting;
    
        return $this;
    }

    /**
     * Remove eventsHosting
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsHosting
     */
    public function removeEventsHosting(\Bangnation\EventBundle\Entity\Event $eventsHosting)
    {
        $this->eventsHosting->removeElement($eventsHosting);
    }

    /**
     * Get eventsHosting
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEventsHosting()
    {
        return $this->eventsHosting;
    }
}