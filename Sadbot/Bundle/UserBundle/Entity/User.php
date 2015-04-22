<?php
namespace Sadbot\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="vk_id", type="string", nullable=true)
     */
    private $vkID;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Set vkID
     *
     * @param string $vkID
     * @return User
     */
    public function setVkID($vkID)
    {
        $this->vkID = $vkID;

        return $this;
    }

    /**
     * Get vkID
     *
     * @return string 
     */
    public function getVkID()
    {
        return $this->vkID;
    }
}
