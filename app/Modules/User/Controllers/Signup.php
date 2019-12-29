<?php

namespace App\Modules\User\Controllers;

use App\Http\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Modules\User\Repository\User as UserRepository;
use App\Modules\User\Resources\User as UserResource;

/**
 * Class Signup
 * @package App\Modules\User\Controllers
 */
class Signup extends Controller
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
    public function createAccount(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:App\Modules\User\Models\User,email',
            'username' => 'required|min:3|unique:App\Modules\User\Models\User,username',
            'password' => 'required|min:6',
        ]);

        if (count($validatedData->errors()->getMessages()) > 0) {
            return response()->json($validatedData->errors()->getMessages())->setStatusCode(400);
        }

        $user = $this->userRepository->insert([
            'name' => $request->name,
            'username' => $request->username,
            'status' => true,
            'email' => $request->email,
            'role' => Config::get('UserRoles')['ROLES']['ROLE_USER'],
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['user' => new UserResource($user)], 200);
    }
}
