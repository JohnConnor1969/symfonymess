<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Device
 *
 * @ORM\table(name="Device")
 * @ORM\Entity
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
     * @ORM\ManyToMany(targetEntity="GroupOf", inversedBy="members")
     */
    private $includeInGroup;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\ManyToMany(targetEntity="Message", mappedBy="informedDevices")
     */
    private $viewedMessages;



    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->viewedMessages = new ArrayCollection();
        $this->includeInGroup = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->uniqueId;
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
    public function getIncludeInGroup()
    {
        return $this->includeInGroup;
    }

    /**
     * @param GroupOf $group
     */
    public function setIncludeInGroup(GroupOf $group)
    {
        $this->includeInGroup[] = $group;
    }

    /**
     * @param GroupOf $group
    */
    public function removeIcludeInGroup(GroupOf $group)
    {
        $this->includeInGroup->removeElement($group);
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
    public function getViewedMessages()
    {
        return $this->viewedMessages;
    }

    /**
     * @param Message $message
     */
    public function setViewedMessages(Message $message)
    {
        $this->viewedMessages[] = $message;
    }

    /**
     * @param Message $message
     */
    public function removeViewedMessages(Message $message)
    {
        $this->viewedMessages->removeElement($message);
    }
}