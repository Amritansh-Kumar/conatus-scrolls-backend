<?php

namespace App\Api\v1\Controllers;

use App\Api\v1\Requests\CreateUserRequest;
use App\Services\UserService;

class UserController extends BaseController {
    protected $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function store(CreateUserRequest $request) {
        return $this->userService->storeUser($request);
    }
}