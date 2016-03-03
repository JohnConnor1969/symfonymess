<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 3/3/2016
 * Time: 9:45 AM
 */

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
    private $device_id;

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
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="Message", mappedBy="informeddevises")
     *
     */
    private $viewedmessage;

    public function __construct()
    {
        $this->createdAt = time();
        $this->device = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @return int
     */
    public function getDeviceId()
    {
        return $this->device_id;
    }

    /**
     * @param int $device_id
     */
    public function setDeviceId($device_id)
    {
        $this->device_id = $device_id;
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
    public function getViewedMessage()
    {
        return $this->viewedmessage;
    }

    /**
     * @param string $viewedmessage
     */
    public function setViewedMessage($viewedmessage)
    {
        $this->viewedmessage = $viewedmessage;
    }

    /**
     * @param $viewedmessage
     */
    public function removeViewedMessage($viewedmessage)
    {
//        $this->viewedmessage->removeElement($viewedmessage);
    }


}