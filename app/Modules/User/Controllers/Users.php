<?php

namespace App\Modules\User\Controllers;

use App\Http\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Modules\User\Repository\User as UserRepository;
use App\Modules\User\Resources\User as UserResource;

/**
 * Class Users
 * @package App\Modules\User\Controllers
 */
class Users extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function fetch(Request $request)
    {
        $users = $this->userRepository->fetchUsers();
        return response()->json(['user' => UserResource::collection($users)], 200);
    }
}
