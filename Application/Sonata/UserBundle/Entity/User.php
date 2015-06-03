<?php

/**
 * This file is part of the MediaMyth project.
 *
 * (c) Sem semseriou@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 *
 * @author Sem Seriou
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
}