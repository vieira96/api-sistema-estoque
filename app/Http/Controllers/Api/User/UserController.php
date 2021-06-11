<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;

class UserController extends Controller
{

    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request) {
        $user = $this->service->register($request);
        return $this->responseSuccess(new UserResource($user));
    }
}
