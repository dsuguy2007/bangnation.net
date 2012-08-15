<?php

namespace Bangnation\ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bangnation\ChatBundle\Entity\Chat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bangnation\ChatBundle\Entity\ChatRepository")
 */
class Chat
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
     * @ORM\ManyToOne(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="outgoingChats", cascade={"persist", "remove"})
     */
    private $sourceUser;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bangnation\UserBundle\Entity\User", inversedBy="incomingChats", cascade={"persist", "remove"})
     */
    private $targetUser;

    /**
     * @var string $message
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime $sent
     *
     * @ORM\Column(name="sent", type="datetime")
     */
    private $sent;

    /**
     * @var boolean $received
     *
     * @ORM\Column(name="received", type="boolean")
     */
    private $received;


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
     * Set message
     *
     * @param string $message
     * @return Chat
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set sent
     *
     * @param \DateTime $sent
     * @return Chat
     */
    public function setSent($sent)
    {
        $this->sent = $sent;
    
        return $this;
    }

    /**
     * Get sent
     *
     * @return \DateTime 
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set received
     *
     * @param boolean $received
     * @return Chat
     */
    public function setReceived($received)
    {
        $this->received = $received;
    
        return $this;
    }

    /**
     * Get received
     *
     * @return boolean 
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * Set sourceUser
     *
     * @param Bangnation\UserBundle\Entity\User $sourceUser
     * @return Chat
     */
    public function setSourceUser(\Bangnation\UserBundle\Entity\User $sourceUser = null)
    {
        $this->sourceUser = $sourceUser;
    
        return $this;
    }

    /**
     * Get sourceUser
     *
     * @return Bangnation\UserBundle\Entity\User 
     */
    public function getSourceUser()
    {
        return $this->sourceUser;
    }

    /**
     * Set targetUser
     *
     * @param Bangnation\UserBundle\Entity\User $targetUser
     * @return Chat
     */
    public function setTargetUser(\Bangnation\UserBundle\Entity\User $targetUser = null)
    {
        $this->targetUser = $targetUser;
    
        return $this;
    }

    /**
     * Get targetUser
     *
     * @return Bangnation\UserBundle\Entity\User 
     */
    public function getTargetUser()
    {
        return $this->targetUser;
    }
}