<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function store(StoreUserRequest $request, UserRepositoryInterface $userRepository)
    {
        try {
            $userData = $request->safe()->only([
                'email',
                'password',
                'name',
                'postcode',
            ]);

            $userRepository->storeUser($userData);

            return response()->json(['message' => "User created: " . $userData['email']], 200);
        } catch (\Exception $exception) {
            Log::error(sprintf(
                "API error creating user \n%s\n%s",
                $exception->getMessage(),
                $exception->getTraceAsString()
            ));

            return response()->json(['error' => 'There was a problem while creating the user'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Request $request, UserRepositoryInterface $userRepository)
    {

    }

    public function all(Request $request, UserRepositoryInterface $userRepository)
    {

    }
}
