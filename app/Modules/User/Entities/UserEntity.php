<?php

namespace App\Modules\User\Entities;

use Doctrine\ORM\Mapping AS ORM;
use App\Model\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="codew_user")
 */
class UserEntity extends Entity
{
    /**
     * @ORM\Column(name="name", type="string", length=250, nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(name="username", type="string", length=250, nullable=false, unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(name="email", type="string", length=250, nullable=false, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="password", type="string", length=250, nullable=false)
     */
    protected $password;

    /**
     * @ORM\Column(name="role", type="string", length=250, nullable=false)
     */
    protected $role;
}
