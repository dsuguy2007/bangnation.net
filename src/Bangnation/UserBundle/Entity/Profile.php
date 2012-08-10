<?php

namespace Bangnation\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Bangnation\UserBundle\Entity\Profile
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bangnation\UserBundle\Entity\ProfileRepository")
 */
class Profile
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
     * @var string $bodyHair
     *
     * @ORM\Column(name="bodyHair", type="string", length=255)
     */
    private $bodyHair;

    /**
     * @var string $position
     *
     * @ORM\Column(name="position", type="string", length=255)
     * @Assert\Choice(choices = {"top", "bottom", "versatile", "versatile/top", "versatile/bottom", null}, message = "Choose a valid position.")
     */
    private $position;

    /**
     * @var string $race
     *
     * @ORM\Column(name="race", type="string", length=255)
     */
    private $race;

    /**
     * @var string $hivStatus
     *
     * @ORM\Column(name="hivStatus", type="string", length=255)
     * @Assert\Choice(choices = {"pos", "neg", "don't care", "unknown", null}, message = "Choose a valid HIV status.")
     */
    private $hivStatus;

    /**
     * @var string $smokingStatus
     *
     * @ORM\Column(name="smokingStatus", type="string", length=255)
     */
    private $smokingStatus;

    /**
     * @var string $whereMeet
     *
     * @ORM\Column(name="whereMeet", type="string", length=255)
     * @Assert\Choice(choices = {"my place", "public", "your place", "hotel", null}, message = "Choose a valid meeting place.")
     */
    private $whereMeet;

    /**
     * @var string $whenMeet
     *
     * @ORM\Column(name="whenMeet", type="string", length=255)
     * @Assert\Choice(choices = {"right now", "weekend, let's plan it.", "after work", null}, message = "Choose a valid meeting time.")
     */
    private $whenMeet;

    /**
     * @var string $lookingFor
     *
     * @ORM\Column(name="lookingFor", type="string", length=255)
     * @Assert\Choice(choices = {"friendship", "relationship", "1-on-1 sex", "3some/group sex", null})
     */
    private $lookingFor;

    /**
     * @var boolean $drink
     *
     * @ORM\Column(name="drink", type="boolean")
     */
    private $drink;

    /**
     * @var boolean $smoke
     *
     * @ORM\Column(name="smoke", type="boolean")
     */
    private $smoke;

    /**
     * @var string $practice
     *
     * @ORM\Column(name="practice", type="string", length=255)
     * @Assert\Choice(choices = {"safe only", "bareback only", "sometimes safe", "anything goes", null})
     */
    private $practice;

    /**
     * @var boolean $tattoos
     *
     * @ORM\Column(name="tattoos", type="boolean")
     */
    private $tattoos;

    /**
     * @var boolean $piercings
     *
     * @ORM\Column(name="piercings", type="boolean")
     */
    private $piercings;

    /**
     * @var float $cockSize
     *
     * @ORM\Column(name="cockSize", type="float")
     */
    private $cockSize;

    /**
     * @var boolean $circumcised
     *
     * @ORM\Column(name="circumcised", type="boolean")
     */
    private $circumcised;


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
     * Set bodyHair
     *
     * @param string $bodyHair
     * @return Profile
     */
    public function setBodyHair($bodyHair)
    {
        $this->bodyHair = $bodyHair;
    
        return $this;
    }

    /**
     * Get bodyHair
     *
     * @return string 
     */
    public function getBodyHair()
    {
        return $this->bodyHair;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Profile
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set race
     *
     * @param string $race
     * @return Profile
     */
    public function setRace($race)
    {
        $this->race = $race;
    
        return $this;
    }

    /**
     * Get race
     *
     * @return string 
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set hivStatus
     *
     * @param string $hivStatus
     * @return Profile
     */
    public function setHivStatus($hivStatus)
    {
        $this->hivStatus = $hivStatus;
    
        return $this;
    }

    /**
     * Get hivStatus
     *
     * @return string 
     */
    public function getHivStatus()
    {
        return $this->hivStatus;
    }

    /**
     * Set smokingStatus
     *
     * @param string $smokingStatus
     * @return Profile
     */
    public function setSmokingStatus($smokingStatus)
    {
        $this->smokingStatus = $smokingStatus;
    
        return $this;
    }

    /**
     * Get smokingStatus
     *
     * @return string 
     */
    public function getSmokingStatus()
    {
        return $this->smokingStatus;
    }

    /**
     * Set whereMeet
     *
     * @param string $whereMeet
     * @return Profile
     */
    public function setWhereMeet($whereMeet)
    {
        $this->whereMeet = $whereMeet;
    
        return $this;
    }

    /**
     * Get whereMeet
     *
     * @return string 
     */
    public function getWhereMeet()
    {
        return $this->whereMeet;
    }

    /**
     * Set whenMeet
     *
     * @param string $whenMeet
     * @return Profile
     */
    public function setWhenMeet($whenMeet)
    {
        $this->whenMeet = $whenMeet;
    
        return $this;
    }

    /**
     * Get whenMeet
     *
     * @return string 
     */
    public function getWhenMeet()
    {
        return $this->whenMeet;
    }

    /**
     * Set lookingFor
     *
     * @param string $lookingFor
     * @return Profile
     */
    public function setLookingFor($lookingFor)
    {
        $this->lookingFor = $lookingFor;
    
        return $this;
    }

    /**
     * Get lookingFor
     *
     * @return string 
     */
    public function getLookingFor()
    {
        return $this->lookingFor;
    }

    /**
     * Set drink
     *
     * @param boolean $drink
     * @return Profile
     */
    public function setDrink($drink)
    {
        $this->drink = $drink;
    
        return $this;
    }

    /**
     * Get drink
     *
     * @return boolean 
     */
    public function getDrink()
    {
        return $this->drink;
    }

    /**
     * Set smoke
     *
     * @param boolean $smoke
     * @return Profile
     */
    public function setSmoke($smoke)
    {
        $this->smoke = $smoke;
    
        return $this;
    }

    /**
     * Get smoke
     *
     * @return boolean 
     */
    public function getSmoke()
    {
        return $this->smoke;
    }

    /**
     * Set practice
     *
     * @param string $practice
     * @return Profile
     */
    public function setPractice($practice)
    {
        $this->practice = $practice;
    
        return $this;
    }

    /**
     * Get practice
     *
     * @return string 
     */
    public function getPractice()
    {
        return $this->practice;
    }

    /**
     * Set tattoos
     *
     * @param boolean $tattoos
     * @return Profile
     */
    public function setTattoos($tattoos)
    {
        $this->tattoos = $tattoos;
    
        return $this;
    }

    /**
     * Get tattoos
     *
     * @return boolean 
     */
    public function getTattoos()
    {
        return $this->tattoos;
    }

    /**
     * Set piercings
     *
     * @param boolean $piercings
     * @return Profile
     */
    public function setPiercings($piercings)
    {
        $this->piercings = $piercings;
    
        return $this;
    }

    /**
     * Get piercings
     *
     * @return boolean 
     */
    public function getPiercings()
    {
        return $this->piercings;
    }

    /**
     * Set cockSize
     *
     * @param float $cockSize
     * @return Profile
     */
    public function setCockSize($cockSize)
    {
        $this->cockSize = $cockSize;
    
        return $this;
    }

    /**
     * Get cockSize
     *
     * @return float 
     */
    public function getCockSize()
    {
        return $this->cockSize;
    }

    /**
     * Set circumcised
     *
     * @param boolean $circumcised
     * @return Profile
     */
    public function setCircumcised($circumcised)
    {
        $this->circumcised = $circumcised;
    
        return $this;
    }

    /**
     * Get circumcised
     *
     * @return boolean 
     */
    public function getCircumcised()
    {
        return $this->circumcised;
    }
}
