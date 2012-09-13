<?php
namespace Bangnation\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 * @ORM\Entity(repositoryClass="Bangnation\UserBundle\Entity\UserRepository")
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
     * @ORM\Column(name="city", type="string", length=255)
     */
    protected $city;
    
    /**
     * @ORM\Column(name="state", type="string", length=255)
     */
    protected $state;
    
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
     * @ORM\ManyToMany(targetEntity="Bangnation\EventBundle\Entity\Event", mappedBy="invitees")
     */
    protected $eventsInvited;
    
    /**
     * @ORM\ManyToMany(targetEntity="Bangnation\EventBundle\Entity\Event", mappedBy="decliners")
     */
    protected $eventsDeclined;
    
    /**
     * @ORM\ManyToMany(targetEntity="Bangnation\EventBundle\Entity\Event", mappedBy="maybes")
     */
    protected $eventsMaybe;
    
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
     * @ORM\OneToMany(targetEntity="Bangnation\ChatBundle\Entity\Chat", mappedBy="targetUser", cascade={"persist", "remove"})
     */
    private $incomingChats;
    
    /**
     * @ORM\OneToMany(targetEntity="Bangnation\ChatBundle\Entity\Chat", mappedBy="targetUser", cascade={"persist", "remove"})
     */
    private $outgoingChats;
    
    /**
     * @ORM\OneToMany(targetEntity="Bangnation\EventBundle\Entity\Invitation", mappedBy="user", cascade={"persist", "remove"})
     */
    private $invitations;
    
    /**
     * The users whos profile you have viewed
     * 
     * @ORM\ManyToMany(targetEntity="Profile", inversedBy="viewers")
     * @ORM\JoinTable(name="Profiles_Viewers")
     **/
    private $viewed;
    
    /**
     * @ORM\OneToMany(targetEntity="Bangnation\UserBundle\Entity\Friendship", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $friends;
    
    /**
     * @ORM\OneToMany(targetEntity="Bangnation\UserBundle\Entity\Friendship", mappedBy="friend", cascade={"persist", "remove"})
     */
    protected $friendsWith;
    
    /**
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\Profile", inversedBy="bookmarkers", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="Profiles_Bookmarks")
     */
    protected $bookmarkedProfiles;

    public function __construct()
    {
        parent::__construct();
        
        $this->timeZone = 'UTC';
        $this->turnOns = new \Doctrine\Common\Collections\ArrayCollection();
        $this->turnOffs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->incomingChats = new \Doctrine\Common\Collections\ArrayCollection();
        $this->outgoingChats = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventsAttending = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventsInvited = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventsMaybe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eventsHosting = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invitations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->viewed = new \Doctrine\Common\Collections\ArrayCollection();
        $this->friends = new \Doctrine\Common\Collections\ArrayCollection();
        $this->friendsWith = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bookmarkedProfiles = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add eventsInvited
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsInvited
     * @return User
     */
    public function addEventsInvited(\Bangnation\EventBundle\Entity\Event $eventsInvited)
    {
        $this->eventsInvited[] = $eventsInvited;
    
        return $this;
    }

    /**
     * Remove eventsInvited
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsInvited
     */
    public function removeEventsInvited(\Bangnation\EventBundle\Entity\Event $eventsInvited)
    {
        $this->eventsInvited->removeElement($eventsInvited);
    }

    /**
     * Get eventsInvited
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEventsInvited()
    {
        return $this->eventsInvited;
    }

    /**
     * Add eventsDeclined
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsDeclined
     * @return User
     */
    public function addEventsDeclined(\Bangnation\EventBundle\Entity\Event $eventsDeclined)
    {
        $this->eventsDeclined[] = $eventsDeclined;
    
        return $this;
    }

    /**
     * Remove eventsDeclined
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsDeclined
     */
    public function removeEventsDeclined(\Bangnation\EventBundle\Entity\Event $eventsDeclined)
    {
        $this->eventsDeclined->removeElement($eventsDeclined);
    }

    /**
     * Get eventsDeclined
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEventsDeclined()
    {
        return $this->eventsDeclined;
    }

    /**
     * Add eventsMaybe
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsMaybe
     * @return User
     */
    public function addEventsMaybe(\Bangnation\EventBundle\Entity\Event $eventsMaybe)
    {
        $this->eventsMaybe[] = $eventsMaybe;
    
        return $this;
    }

    /**
     * Remove eventsMaybe
     *
     * @param Bangnation\EventBundle\Entity\Event $eventsMaybe
     */
    public function removeEventsMaybe(\Bangnation\EventBundle\Entity\Event $eventsMaybe)
    {
        $this->eventsMaybe->removeElement($eventsMaybe);
    }

    /**
     * Get eventsMaybe
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEventsMaybe()
    {
        return $this->eventsMaybe;
    }

    /**
     * Add invitations
     *
     * @param Bangnation\EventBundle\Entity\Invitation $invitations
     * @return User
     */
    public function addInvitation(\Bangnation\EventBundle\Entity\Invitation $invitations)
    {
        $this->invitations[] = $invitations;
    
        return $this;
    }

    /**
     * Remove invitations
     *
     * @param Bangnation\EventBundle\Entity\Invitation $invitations
     */
    public function removeInvitation(\Bangnation\EventBundle\Entity\Invitation $invitations)
    {
        $this->invitations->removeElement($invitations);
    }

    /**
     * Get invitations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getInvitations()
    {
        return $this->invitations;
    }

    /**
     * Add viewed
     *
     * @param Bangnation\UserBundle\Entity\Profile $viewed
     * @return User
     */
    public function addViewed(\Bangnation\UserBundle\Entity\Profile $viewed)
    {
        $this->viewed[] = $viewed;
    
        return $this;
    }

    /**
     * Remove viewed
     *
     * @param Bangnation\UserBundle\Entity\Profile $viewed
     */
    public function removeViewed(\Bangnation\UserBundle\Entity\Profile $viewed)
    {
        $this->viewed->removeElement($viewed);
    }

    /**
     * Get viewed
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getViewed()
    {
        return $this->viewed;
    }

    /**
     * Add friends
     *
     * @param Bangnation\UserBundle\Entity\Friendship $friends
     * @return User
     */
    public function addFriend(\Bangnation\UserBundle\Entity\Friendship $friends)
    {
        $this->friends[] = $friends;
    
        return $this;
    }

    /**
     * Remove friends
     *
     * @param Bangnation\UserBundle\Entity\Friendship $friends
     */
    public function removeFriend(\Bangnation\UserBundle\Entity\Friendship $friends)
    {
        $this->friends->removeElement($friends);
    }

    /**
     * Get friends
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * Add friendsWith
     *
     * @param Bangnation\UserBundle\Entity\Friendship $friendsWith
     * @return User
     */
    public function addFriendsWith(\Bangnation\UserBundle\Entity\Friendship $friendsWith)
    {
        $this->friendsWith[] = $friendsWith;
    
        return $this;
    }

    /**
     * Remove friendsWith
     *
     * @param Bangnation\UserBundle\Entity\Friendship $friendsWith
     */
    public function removeFriendsWith(\Bangnation\UserBundle\Entity\Friendship $friendsWith)
    {
        $this->friendsWith->removeElement($friendsWith);
    }

    /**
     * Get friendsWith
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFriendsWith()
    {
        return $this->friendsWith;
    }

    /**
     * Add bookmarkedProfiles
     *
     * @param Bangnation\UserBundle\Entity\Profile $bookmarkedProfiles
     * @return User
     */
    public function addBookmarkedProfile(\Bangnation\UserBundle\Entity\Profile $bookmarkedProfiles)
    {
        $this->bookmarkedProfiles[] = $bookmarkedProfiles;
    
        return $this;
    }

    /**
     * Remove bookmarkedProfiles
     *
     * @param Bangnation\UserBundle\Entity\Profile $bookmarkedProfiles
     */
    public function removeBookmarkedProfile(\Bangnation\UserBundle\Entity\Profile $bookmarkedProfiles)
    {
        $this->bookmarkedProfiles->removeElement($bookmarkedProfiles);
    }

    /**
     * Get bookmarkedProfiles
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBookmarkedProfiles()
    {
        return $this->bookmarkedProfiles;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return User
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }
}