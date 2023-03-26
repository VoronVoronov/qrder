<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserLoginRequest;
use App\Http\Requests\Users\UserRegisterRequest;
use App\Repository\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ResponsesTrait;

class UsersController extends Controller
{
    use ResponsesTrait;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(UserRegisterRequest $request, UserRepository $userRepository): JsonResponse
    {
        try {
            $token = $userRepository->register($request);
            return $this->success($token, __('main.users.register.success'), Response::HTTP_CREATED);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(UserLoginRequest $request, UserRepository $userRepository): JsonResponse
    {
        try {
            $token = $userRepository->login($request);
            return $this->success($token, __('main.users.login.success'), Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function profile(UserRepository $userRepository): JsonResponse
    {
        try{
            $user = $userRepository->profile();
            return $this->success($user, __('main.users.login.user_info'), Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
