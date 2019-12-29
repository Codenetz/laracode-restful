<?php

namespace App\Modules\User\Entities;

use Doctrine\ORM\Mapping AS ORM;
use App\Model\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="codew_password_reset")
 */
class PasswordResetEntity extends Entity
{
    /**
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(name="token", type="string", length=250, nullable=false)
     */
    protected $token;
}
