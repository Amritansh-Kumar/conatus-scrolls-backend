<?php

namespace App\Api\v1\Controllers;

use App\Api\v1\Requests\CreateUserRequest;
use App\Api\v1\Transformers\UserTransformer;
use App\Services\UserService;

class UserController extends BaseController {

    public function store(CreateUserRequest $request, UserService $userService) {
        return $userService->storeUser($request);
    }
}