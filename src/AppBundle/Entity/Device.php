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
     * @ORM\Column(name="device_id", type="integer")
     */
    private $uniqueId;

    /**
     * @var string
     *
     * @ORM\Column(name="group", type="string", length=255 )
     */
    private $group;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\ManyToMany(targetEntity="Message", mappedBy="informedDevises")
     */
    private $viewedMessages;

    public function __construct()
    {
        $this->createdAt = time();
        $this->viewedMessages = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->id;
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
     * @return ArrayCollection
     */
    public function getViewedMessage()
    {
        return $this->viewedMessages;
    }

    /**
     * @param Message $message
     */
    public function setViewedMessage(Message $message)
    {
        $this->viewedMessages[] = $message;
    }

    /**
     * @param Message $message
     */
    public function removeViewedMessage(Message $message)
    {
        $this->viewedMessages->removeElement($message);
    }
}