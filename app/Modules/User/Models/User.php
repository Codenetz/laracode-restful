<?php

namespace App\Modules\User\Models;

use App\Model\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Modules\User\Models
 */
class User extends Model
{
    use HasApiTokens, Notifiable;

    /**
     * @var string
     */
    protected $table = 'codew_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'status', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return in_array(Config::get('UserRoles')['ROLES']['ROLE_ADMIN'], Config::get('UserRoles')['LEVELS'][$this->role]);
    }

    /**
     * @return bool
     */
    public function isModerator()
    {
        return in_array(Config::get('UserRoles')['ROLES']['ROLE_MODERATOR'], Config::get('UserRoles')['LEVELS'][$this->role]);
    }
}
