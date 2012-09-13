<?php

namespace Bangnation\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Bangnation\UserBundle\Entity\Friendship
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Friendship
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
     * @var \DateTime $requested
     * 
     * @ORM\Column(name="requested", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $requested;
    
    /**
     * @var \DateTime $accepted
     * 
     * @ORM\Column(name="accepted", type="datetime", nullable=true)
     */
    private $accepted;
    
    /**
     * @var string $friendType
     * 
     * @ORM\Column(name="friend_type", type="string", length=255)
     * @Assert\Choice(choices = {"plays together only", "monogamously coupled", "separate only", "together or separately", "friends only", "fuckbuddies only", "friends/fuckbuddies", null}, message = "Choose a valid privacy.")
     */
    private $friendType;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="friends")
     */
    private $user;
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="friendsWith")
     */
    private $friend;
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="friend_id", type="integer")
     */
    private $friend_id;
   
    public function __construct()
    {

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
     * Set couponCode
     *
     * @param string $couponCode
     * @return Invitation
     */
    public function setCouponCode($couponCode)
    {
        $this->couponCode = $couponCode;
    
        return $this;
    }

    /**
     * Get couponCode
     *
     * @return string 
     */
    public function getCouponCode()
    {
        return $this->couponCode;
    }

    /**
     * Set event
     *
     * @param Bangnation\EventBundle\Entity\Event $event
     * @return Invitation
     */
    public function setEvent(\Bangnation\EventBundle\Entity\Event $event = null)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return Bangnation\EventBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set user
     *
     * @param Bangnation\UserBundle\Entity\User $user
     * @return Invitation
     */
    public function setUser(\Bangnation\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Bangnation\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set requested
     *
     * @param \DateTime $requested
     * @return Friendship
     */
    public function setRequested($requested)
    {
        $this->requested = $requested;
    
        return $this;
    }

    /**
     * Get requested
     *
     * @return \DateTime 
     */
    public function getRequested()
    {
        return $this->requested;
    }

    /**
     * Set accepted
     *
     * @param \DateTime $accepted
     * @return Friendship
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
    
        return $this;
    }

    /**
     * Get accepted
     *
     * @return \DateTime 
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set friendType
     *
     * @param string $friendType
     * @return Friendship
     */
    public function setFriendType($friendType)
    {
        $this->friendType = $friendType;
    
        return $this;
    }

    /**
     * Get friendType
     *
     * @return string 
     */
    public function getFriendType()
    {
        return $this->friendType;
    }

    /**
     * Set friend
     *
     * @param Bangnation\UserBundle\Entity\User $friend
     * @return Friendship
     */
    public function setFriend(\Bangnation\UserBundle\Entity\User $friend = null)
    {
        $this->friend = $friend;
    
        return $this;
    }

    /**
     * Get friend
     *
     * @return Bangnation\UserBundle\Entity\User 
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return Friendship
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
    
        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set friend_id
     *
     * @param integer $friendId
     * @return Friendship
     */
    public function setFriendId($friendId)
    {
        $this->friend_id = $friendId;
    
        return $this;
    }

    /**
     * Get friend_id
     *
     * @return integer 
     */
    public function getFriendId()
    {
        return $this->friend_id;
    }
}