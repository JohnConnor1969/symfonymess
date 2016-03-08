<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class GroupOf
 *
 * @ORM\table(name="GroupOf")
 * @ORM\Entity
 */
class GroupOf
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
     * @ORM\ManyToMany(targetEntity="Device", mappedBy="includeInGroup")
     *
     */
    private $members;


    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->members = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param Device $device
     */
    public function setMembers(Device $device)
    {
        $this->members[] = $device;
    }

    /**
     * @param Device $device
     */
    public function removeMembers(Device $device)
    {
        $this->members->removeElement($device);
    }

}