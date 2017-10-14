<?php

namespace AppBundle\Entity;

#use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
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
     * @ORM\ManyToMany(targetEntity="Task", inversedBy="users")
     * @ORM\JoinTable(name="users_tasks")
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        parent::__construct();
    }
}