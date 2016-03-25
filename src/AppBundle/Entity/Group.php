<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Group
 *
 * @ORM\table(name="`group`")
 * @ORM\Entity
 */
class Group
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255 )
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Device", mappedBy="groups")
     *
     */
    private $devices;


    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->devices = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdat
     */
    public function setCreatedAt($createdat)
    {
        $this->createdAt = $createdat;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getDevices()
    {
        return $this->devices;
    }

    /**
     * @param Device $device
     */
    public function setDevices(Device $device)
    {
        $this->devices[] = $device;
    }

    /**
     * @param Device $device
     */
    public function removeDevices(Device $device)
    {
        $this->devices->removeElement($device);
    }

}