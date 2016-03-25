<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Device
 *
 * @ORM\table(name="Device")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DeviceRepository")
 */
class Device
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="uniqueId", type="integer", nullable=true)
     */
    private $uniqueId;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="devices")
     */
    private $groups;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\ManyToMany(targetEntity="Message", inversedBy="devices")
     */
    private $messages;



    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->messages = new ArrayCollection();
        $this->groups = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * @param $uniqueid
     */
    public function setUniqueId($uniqueid)
    {
        $this->uniqueId = $uniqueid;
    }

    /**
     * @return ArrayCollection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param Group $group
     */
    public function setGroups(Group $group)
    {
        $this->groups[] = $group;
    }

    /**
     * @param Group $group
    */
    public function removeGroups(Group $group)
    {
        $this->groups->removeElement($group);
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
     * @return ArrayCollection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param Message $message
     */
    public function setMessages(Message $message)
    {
        $this->messages[] = $message;
    }

    /**
     * @param Message $message
     */
    public function removeMessages(Message $message)
    {
        $this->messages->removeElement($message);
    }

}