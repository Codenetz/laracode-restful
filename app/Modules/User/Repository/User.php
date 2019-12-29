<?php

namespace App\Modules\User\Repository;

use App\Model\Repository;
use App\Modules\User\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * @package App\Modules\User\Repository
 */
class User extends Repository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return UserModel::class;
    }

    /**
     * @param string $username
     * @param string $password
     * @return |null
     */
    public function findByCredentials(string $username, string $password)
    {
        $user = $this->queryBuilder()->whereRaw('username = ? OR email = ?', [$username, $username])->first();

        if (!$user) {
            return null;
        }

        if (!Hash::check($password, $user->password)) {
            return null;
        }

        return $this->hydrate([$user])->first();
    }

    /**
     * @return array
     */
    public function fetchUsers()
    {
        return $this->queryBuilder()->get()->all();
    }
}
