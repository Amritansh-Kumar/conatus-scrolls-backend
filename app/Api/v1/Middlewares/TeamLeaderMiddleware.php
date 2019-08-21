<?php

namespace App\Api\v1\Middlewares;

use App\Api\v1\Exceptions\AccessDeniedException;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class TeamLeaderMiddleware {

    public function handle($request, Closure $next) {
        $user = Auth::user();

        if($user->status && $user->status === User::LEADER) {
            return $next($request);
        }
        else {
            throw new AccessDeniedException();
        }
    }
}
