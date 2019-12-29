<?php

namespace App\Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * Class User
 * @package App\Modules\User\Resources
 */
class User extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = Auth::user();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->when($user && $user->isAdmin(), $this->username),
            'email' => $this->when($user && $user->isAdmin(), $this->email),
            'date_added' => $this->date_added,
            'date_modified' => $this->date_modified
        ];
    }
}
