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
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime $endDate
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;
    
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
     * @ORM\ManyToMany(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="eventsHosting")
     * @ORM\JoinTable(name="Events_Hosts") 
     */
    private $hosts;

    public function __construct()
    {
        $this->profilePicRequired = false;
        $this->attendees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invitees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->decliners = new \Doctrine\Common\Collections\ArrayCollection();
        $this->hosts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add decliners
     *
     * @param Bangnation\UserBundle\Entity\User $decliners
     * @return Event
     */
    public function addDecliner(\Bangnation\UserBundle\Entity\User $decliners)
    {
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
}