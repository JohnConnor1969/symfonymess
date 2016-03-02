<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/2/2016
 * Time: 6:55 PM
 */
namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="message")
 * @ORM\Entity
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
     * @ORM\Column(name="message", type="string", length=255 )
     */
    private $message;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", length=255 )
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="expiration", type="integer", length=255 )
     */
    private $expiration;

    public function __construct()
    {
        $this->createdAt = time();
        $this->message = new ArrayCollection();
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

}