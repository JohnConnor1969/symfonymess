<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MessageRepository")
 */
class Message {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255 )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="stipulation", type="string", length=255, nullable=true)
     */
    private $stipulation;

    /**
     * @var string
     *
     * @ORM\Column(name="targetGroup", type="string", length=255, nullable=true)
     */
    private $targetGroup;

    /**
     * @var string
     *
     * @ORM\Column(name="targetDevice", type="string", length=255, nullable=true)
     */
    private $targetDevice;

    /**
     * @ORM\ManyToMany(targetEntity="Device", inversedBy="viewedMessages")
     */
    private $informedDevices;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="targetDate", type="date")
     */
    private $targetDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="expiration", type="integer")
     */
    private $expiration;



    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->informedDevices = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->id;
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
     * @return Message
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getTargetGroup()
    {
        return $this->targetGroup;
    }

    /**
     * @param string $group
     */
    public function setTargetGroup($group)
    {
        $this->targetGroup = $group;
    }

    /**
     * @return string
     */
    public function getTargetDevice()
    {
        return $this->targetDevice;
    }

    /**
     * @param string $device
     */
    public function setTargetDevice($device)
    {
        $this->targetDevice = $device;
    }

    /**
     * @return \DateTime
     */
    public function getTargetDate()
    {
        return $this->targetDate;
    }

    /**
     * @param \DateTime $date
     */
    public function setTargetDate($date)
    {
        $this->targetDate= $date;
    }

    /**
     * @return int
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @param int $expiration
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getStipulation()
    {
        return $this->stipulation;
    }

    /**
     * @param string $stipulation
     */
    public function setStipulation($stipulation)
    {
        $this->stipulation = $stipulation;
    }

    /**
     * @return ArrayCollection
     */
    public function getInformedDevices()
    {
        return $this->informedDevices;
    }

    /**
     * @param Device $device
     */
    public function setInformedDevices(Device $device)
    {
        $this->informedDevices[] = $device;
    }

    /**
     * @param Device $device
     */
    public function removeInformedDevices(Device $device)
    {
        $this->informedDevices->removeElement($device);
    }
}