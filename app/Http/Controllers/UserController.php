<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $userData = $request->safe()->only([
                'email',
                'password',
                'name',
                'postcode',
            ]);

            $this->userRepository->storeUser($userData);

            if ($request->wantsJson()) {
                return response()->json(['message' => "User created: " . $userData['email']], Response::HTTP_CREATED);
            } else {
                return redirect('created');
            }
        } catch (\Exception $exception) {
            Log::error(sprintf(
                "API error creating user \n%s\n%s",
                $exception->getMessage(),
                $exception->getTraceAsString()
            ));

            return response()->json(['error' => 'There was a problem while creating the user'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Request $request, string $email)
    {
        $userData = $this->userRepository->getUser($email);

        if ($userData) {
            return response()->json($userData, 200);
        } else {
            return response()->json(['message' => "User with email address $email could not be found"], Response::HTTP_NOT_FOUND);
        }
    }

    public function all(Request $request)
    {
        $userData = $this->userRepository->getAllUsers();

        if (count($userData) > 0 ) {
            return response()->json($userData, 200);
        } else {
            return response()->json(['message' => "No users were found"], Response::HTTP_NOT_FOUND);
        }
    }
}
