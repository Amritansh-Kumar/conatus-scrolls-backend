<?php

namespace App\Api\v1\Controllers;

use App\Api\v1\Requests\CreateLeaderRequest;
use App\Api\v1\Requests\CreateMemberRequest;
use App\Api\v1\Requests\LoginRequest;
use App\Api\v1\Requests\UpdateUserRequest;
use App\Api\v1\Transformers\UserTransformer;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController {

    public function storeLeader(CreateLeaderRequest $request, UserService $userService) {
        $user = $userService->storeUser($request);
        return $this->response->item($user, new UserTransformer());
    }

    public function storeMember(CreateMemberRequest $request, UserService $userService) {
        $user =  $userService->storeMember($request);
        return $this->response->item($user, new UserTransformer());
    }

    public function update(UpdateUserRequest $request, UserService $userService) {
        $user = $userService->update($request);
        return $this->response->item($user, new UserTransformer());
    }

}
