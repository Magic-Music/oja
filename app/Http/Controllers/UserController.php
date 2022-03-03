<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(StoreUserRequest $request, UserRepositoryInterface $userRepository)
    {
        $userData = $request->safe()->only([
            'email',
            'password',
            'name',
            'postcode',
        ]);

        $userRepository->storeUser($userData);
    }

    public function show(Request $request, UserRepositoryInterface $userRepository)
    {

    }

    public function all(Request $request, UserRepositoryInterface $userRepository)
    {

    }
}
