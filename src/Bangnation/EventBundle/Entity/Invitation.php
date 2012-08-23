<?php

namespace Bangnation\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bangnation\EventBundle\Entity\Invitation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bangnation\EventBundle\Entity\InvitationRepository")
 */
class Invitation
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
     * @var string $couponCode
     *
     * @ORM\Column(name="couponCode", type="string", length=255)
     */
    private $couponCode;

    /**
     * @ORM\ManyToOne(targetEntity="Bangnation\EventBundle\Entity\Event", inversedBy="invitations", cascade={"persist", "remove"})
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="invitations", cascade={"persist", "remove"})
     */
    private $user;

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
     * @param Bangnation\UserBundle\Entity\Event $event
     * @return Invitation
     */
    public function setEvent(\Bangnation\UserBundle\Entity\Event $event = null)
    {
        $this->event = $event;
    
        return $this;
    }

    /**
     * Get event
     *
     * @return Bangnation\UserBundle\Entity\Event 
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
}