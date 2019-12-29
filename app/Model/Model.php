<?php
namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Model extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const CREATED_AT = 'date_added';
    const UPDATED_AT = 'date_modified';
}
