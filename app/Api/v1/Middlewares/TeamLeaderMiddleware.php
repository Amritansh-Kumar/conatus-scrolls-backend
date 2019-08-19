<?php

namespace App\Api\v1\Middlewares;

use App\Api\v1\Exceptions\UnsubscribedException;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class TeamLeaderMiddleware {

    public function handle($request, Closure $next) {
        $user = Auth::user();

        if($user->status() === User::MEMBER) {
            return $next($request);
        }
        else {
            throw new UnsubscribedException();
        }
    }
}