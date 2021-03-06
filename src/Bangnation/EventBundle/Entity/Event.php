<?php

namespace Bangnation\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Sluggable\Sluggable;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Bangnation\EventBundle\Entity\Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bangnation\EventBundle\Entity\EventRepository")
 */
class Event implements Sluggable
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
     * @Gedmo\Slug(separator="-", updatable=true, fields={"name"})
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     */
    private $slug;
    
    /**
     * @var string $privacy
     *
     * @ORM\Column(name="privacy", type="string", length=255, nullable=true)
     * @Assert\Choice(choices = {"require approval to attend", "anyone can attend", "private, needs to be invited", null}, message = "Choose a valid privacy.")
     */
    private $privacy;
    
    /**
     * @var string $profilePicRequired
     *
     * @ORM\Column(name="profile_pic_required", type="boolean")
     */
    private $profilePicRequired;
    
    /**
     * @var boolean $inviteListPublic
     * 
     * @ORM\Column(name="invite_list_public", type="boolean")
     */
    private $inviteListPublic;
    
    /**
     * @var boolean $attendingListPublic
     * 
     * @ORM\Column(name="attending_list_public", type="boolean")
     */
    private $attendingListPublic;
    
    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string $image
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var \DateTime $duration
     *
     * @ORM\Column(name="duration", type="time", nullable=true)
     */
    private $duration;

    /**
     * @var \DateTime $startDate
     *
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @var \DateTime $endDate
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $endDate;
    
    /**
     * @var \DateTime $startTime
     *
     * @ORM\Column(name="start_time", type="time")
     */
    private $startTime;

    /**
     * @var \DateTime $endTime
     *
     * @ORM\Column(name="end_time", type="time", nullable=true)
     */
    private $endTme;
    
    /**
     * @var string $frequency
     *
     * @ORM\Column(name="frequency", type="string", nullable=true)
     * @Assert\Choice(choices = {"daily", "weekly", "biweekly", "monthly", "yearly", null}, message = "Choose a valid frequency.")
     */
    private $frequency;
    
    /**
     * @var string $day
     * 
     * @ORM\Column(name="day", type="string", nullable=true)
     * @Assert\Choice(choices = {"sun", "mon", "tue", "wed", "thu", "fri", "sat", null}, message = "Choose a valid day.")
     */
    private $day;
    
    /** 
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="eventsAttending")
     * @ORM\JoinTable(name="Events_Attendees") 
     */
    private $attendees;
    
    /** 
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="eventsInvited")
     * @ORM\JoinTable(name="Events_Invitees") 
     */
    private $invitees;

    /** 
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="eventsDeclined")
     * @ORM\JoinTable(name="Events_Decliners") 
     */
    private $decliners;

    /** 
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="eventsMaybe")
     * @ORM\JoinTable(name="Events_Maybes") 
     */
    private $maybes;

    /** 
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="eventsHosting")
     * @ORM\JoinTable(name="Events_Hosts") 
     */
    private $hosts;
    
    /**
     * @ORM\OneToMany(targetEntity="Bangnation\EventBundle\Entity\Invitation", mappedBy="event")
     */
    private $invitations;

    public function __construct()
    {
        $this->profilePicRequired = false;
        $this->inviteListPublic = true;
        $this->attendingListPublic = true;
        $this->attendees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invitees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->decliners = new \Doctrine\Common\Collections\ArrayCollection();
        $this->maybes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hosts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invitations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Event
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Event
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
     * Set url
     *
     * @param string $url
     * @return Event
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set duration
     *
     * @param \DateTime $duration
     * @return Event
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return \DateTime 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Event
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set privacy
     *
     * @param string $privacy
     * @return Event
     */
    public function setPrivacy($privacy)
    {
        $this->privacy = $privacy;
    
        return $this;
    }

    /**
     * Get privacy
     *
     * @return string 
     */
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /**
     * Set profilePicRequired
     *
     * @param boolean $profilePicRequired
     * @return Event
     */
    public function setProfilePicRequired($profilePicRequired)
    {
        $this->profilePicRequired = $profilePicRequired;
    
        return $this;
    }

    /**
     * Get profilePicRequired
     *
     * @return boolean 
     */
    public function getProfilePicRequired()
    {
        return $this->profilePicRequired;
    }

    /**
     * Add attendees
     *
     * @param Bangnation\UserBundle\Entity\User $attendees
     * @return Event
     */
    public function addAttendee(\Bangnation\UserBundle\Entity\User $attendees)
    {
        $this->removeFromLists($attendees);
        
        $this->attendees[] = $attendees;
    
        return $this;
    }

    /**
     * Remove attendees
     *
     * @param Bangnation\UserBundle\Entity\User $attendees
     */
    public function removeAttendee(\Bangnation\UserBundle\Entity\User $attendees)
    {
        $this->attendees->removeElement($attendees);
    }

    /**
     * Get attendees
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * Is this user an attendee
     * 
     * @param \Bangnation\UserBundle\Entity\User $user
     * @return boolean
     */
    public function hasAttendee(\Bangnation\UserBundle\Entity\User $user)
    {
        return $this->attendees->contains($user);
    }
    
    /**
     * Add hosts
     *
     * @param Bangnation\UserBundle\Entity\User $hosts
     * @return Event
     */
    public function addHost(\Bangnation\UserBundle\Entity\User $hosts)
    {
        $this->hosts[] = $hosts;
    
        return $this;
    }

    /**
     * Remove hosts
     *
     * @param Bangnation\UserBundle\Entity\User $hosts
     */
    public function removeHost(\Bangnation\UserBundle\Entity\User $hosts)
    {
        $this->hosts->removeElement($hosts);
    }

    /**
     * Get hosts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getHosts()
    {
        return $this->hosts;
    }
    
    /**
     * Is this user a host
     * 
     * @param \Bangnation\UserBundle\Entity\User $user
     * @return boolean
     */
    public function hasHost(\Bangnation\UserBundle\Entity\User $user)
    {
        return $this->hosts->contains($user);
    }

    /**
     * Add invitees
     *
     * @param Bangnation\UserBundle\Entity\User $invitees
     * @return Event
     */
    public function addInvitee(\Bangnation\UserBundle\Entity\User $invitees)
    {
        $this->invitees[] = $invitees;
    
        return $this;
    }

    /**
     * Remove invitees
     *
     * @param Bangnation\UserBundle\Entity\User $invitees
     */
    public function removeInvitee(\Bangnation\UserBundle\Entity\User $invitees)
    {
        $this->invitees->removeElement($invitees);
    }

    /**
     * Get invitees
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getInvitees()
    {
        return $this->invitees;
    }

    /**
     * Is this user an invitee
     * 
     * @param \Bangnation\UserBundle\Entity\User $user
     * @return boolean
     */
    public function hasInvitee(\Bangnation\UserBundle\Entity\User $user)
    {
        return $this->invitees->contains($user);
    }

    /**
     * Add decliners
     *
     * @param Bangnation\UserBundle\Entity\User $decliners
     * @return Event
     */
    public function addDecliner(\Bangnation\UserBundle\Entity\User $decliners)
    {
        $this->removeFromLists($decliners);
        
        $this->decliners[] = $decliners;
    
        return $this;
    }

    /**
     * Remove decliners
     *
     * @param Bangnation\UserBundle\Entity\User $decliners
     */
    public function removeDecliner(\Bangnation\UserBundle\Entity\User $decliners)
    {
        $this->decliners->removeElement($decliners);
    }

    /**
     * Get decliners
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDecliners()
    {
        return $this->decliners;
    }
    
    /**
     * Is this user a decliner
     * 
     * @param \Bangnation\UserBundle\Entity\User $user
     * @return boolean
     */
    public function hasDecliner(\Bangnation\UserBundle\Entity\User $user)
    {
        return $this->decliners->contains($user);
    }

    /**
     * Add maybes
     *
     * @param Bangnation\UserBundle\Entity\User $maybes
     * @return Event
     */
    public function addMaybe(\Bangnation\UserBundle\Entity\User $maybes)
    {
        $this->removeFromLists($maybes);
       
        $this->maybes[] = $maybes;
    
        return $this;
    }

    /**
     * Remove maybes
     *
     * @param Bangnation\UserBundle\Entity\User $maybes
     */
    public function removeMaybe(\Bangnation\UserBundle\Entity\User $maybes)
    {
        $this->maybes->removeElement($maybes);
    }

    /**
     * Get maybes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMaybes()
    {
        return $this->maybes;
    }
    
    /**
     * Is this user a maybe
     * 
     * @param \Bangnation\UserBundle\Entity\User $user
     * @return boolean
     */
    public function hasMaybe(\Bangnation\UserBundle\Entity\User $user)
    {
        return $this->maybes->contains($user);
    }
    
    /**
     * Removes a user from all lists except invitees
     * 
     * @param \Bangnation\UserBundle\Entity\User $user
     */
    private function removeFromLists(\Bangnation\UserBundle\Entity\User $user)
    {
        if ($this->hasAttendee($user)) {
            $this->removeAttendee($user);
        }
        
        if ($this->hasDecliner($user)) {
            $this->removeDecliner($user);
        }
        
        if ($this->hasMaybe($user)) {
            $this->removeMaybe($user);
        }
    }

    /**
     * Set inviteListPublic
     *
     * @param boolean $inviteListPublic
     * @return Event
     */
    public function setInviteListPublic($inviteListPublic)
    {
        $this->inviteListPublic = $inviteListPublic;
    
        return $this;
    }

    /**
     * Get inviteListPublic
     *
     * @return boolean 
     */
    public function getInviteListPublic()
    {
        return $this->inviteListPublic;
    }

    /**
     * Set attendingListPublic
     *
     * @param boolean $attendingListPublic
     * @return Event
     */
    public function setAttendingListPublic($attendingListPublic)
    {
        $this->attendingListPublic = $attendingListPublic;
    
        return $this;
    }

    /**
     * Get attendingListPublic
     *
     * @return boolean 
     */
    public function getAttendingListPublic()
    {
        return $this->attendingListPublic;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Event
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    
        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTme
     *
     * @param \DateTime $endTme
     * @return Event
     */
    public function setEndTme($endTme)
    {
        $this->endTme = $endTme;
    
        return $this;
    }

    /**
     * Get endTme
     *
     * @return \DateTime 
     */
    public function getEndTme()
    {
        return $this->endTme;
    }

    /**
     * Set frequency
     *
     * @param string $frequency
     * @return Event
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    
        return $this;
    }

    /**
     * Get frequency
     *
     * @return string 
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set day
     *
     * @param string $day
     * @return Event
     */
    public function setDay($day)
    {
        $this->day = $day;
    
        return $this;
    }

    /**
     * Get day
     *
     * @return string 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Add invitations
     *
     * @param Bangnation\EventBundle\Entity\Invitation $invitations
     * @return Event
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
}