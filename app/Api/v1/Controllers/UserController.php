<?php

namespace App\Api\v1\Controllers;

use App\Api\v1\Requests\CreateLeaderRequest;
use App\Api\v1\Requests\CreateMemberRequest;
use App\Services\UserService;

class UserController extends BaseController {

    public function storeLeader(CreateLeaderRequest $request, UserService $userService) {
        return $userService->storeUser($request);
    }

    public function storeMember(CreateMemberRequest $request, UserService $userService) {
        return $userService->storeMember($request);
    }
}