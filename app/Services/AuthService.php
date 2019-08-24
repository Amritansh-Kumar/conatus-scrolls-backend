<?php

namespace App\Services;

use App\Api\V1\Exceptions\InvalidPasswordResetCodeException;
use App\Api\V1\Exceptions\UnauthorizedException;
use App\Api\V1\Exceptions\UserNotFoundException;
use App\Api\V1\Exceptions\VerifyLimitExceededException;
use App\Api\v1\Transformers\UserTransformer;
use App\Helpers;
use App\Jobs\SendPasswordResetEmailJob;
use App\Services\Contracts\PasswordResetByCodeContract;
use App\Services\Contracts\PasswordResetContract;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService {

    const PIN_VERIFY_LIMIT = 3;

    public function forgotPassword(PasswordResetContract $contract) {
        $user = User::whereEmail(
            $contract->getEmail())->first();

        if (!$user) {
            throw new UnauthorizedException;
        }

        $resetQuery = DB::table('password_resets')->where('email', $user->email);
        $row        = $resetQuery->first();

        if ($row) {
            $code = $row->token;
            $resetQuery->update([
                'created_at' => Carbon::now()
            ]);
        } else {
            $code = Helpers::generateUniqueId();
            DB::table('password_resets')->insert([
                'token'      => $code,
                'email'      => $user->email,
                'created_at' => Carbon::now()
            ]);
        }

        dispatch(new SendPasswordResetEmailJob($user, $code));
    }

    public function resetPasswordByCode(PasswordResetByCodeContract $contract) {
        $query = DB::table('password_resets')->where('token', $contract->getCode());

        $token = $query->first();

        if (!$token) {
            throw new InvalidPasswordResetCodeException();
        }

        if ($token->attempts >= self::PIN_VERIFY_LIMIT) {
            throw new VerifyLimitExceededException;
        }

        if ($token->token != $contract->getCode()) {
            $query->increment('attempts', 1, [
                'created_at' => Carbon::now()
            ]);
            throw new InvalidPasswordResetCodeException();
        }

        $query->delete();

        $user = User::whereEmail($token->email)->first();
        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->password = $contract->getPassword();
        $user->save();

        return $this->getUserData($user);
    }

    private function getUserData($user) {
        return [
            'token' => JWTAuth::fromUser($user),
            'user'  => (new UserTransformer)->transform($user)
        ];
    }
}
