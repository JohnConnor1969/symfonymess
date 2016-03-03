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
    * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="condition", type="string", length=255)
     */
    private $condition;

    /**
     * @var string
     *
     * @ORM\Column(name="group", type="string", length=255 )
     */
    private $group;

    /**
     * @var string
     *
     * @ORM\Column(name="device", type="string", length=255 )
     */
    private $device;

    /**
     * @ORM\ManyToMany(targetEntity="Device", inversedBy="viewedMessages")
     * @ORM\JoinTable(name="device_message")
     */
    private $informedDevices;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="expiration", type="integer")
     */
    private $expiration;



    public function __construct()
    {
        $this->createdAt = time();
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
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param string $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param string $condition
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
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