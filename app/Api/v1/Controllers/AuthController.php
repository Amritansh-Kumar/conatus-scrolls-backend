<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 11:48 AM
 */

namespace App\Api\v1\Controllers;

use App\Api\v1\Exceptions\InvalidCredentialsException;
use App\Api\v1\Exceptions\UserNotFoundException;

;

use App\Api\v1\Requests\LoginRequest;
use App\Api\v1\Transformers\MemberTransformer;
use App\Api\v1\Transformers\UserTransformer;
use App\Member;
use App\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController {

    public function authenticate(LoginRequest $request) {

        $credentials = $request->only('email', 'password');

        $member = Member::whereEmail($request->getEmail())
            ->where('scrolls_id', $request->getScrollsId())
            ->first();

        if ($member) {

            try {
                if (Hash::check($request->getPassword(), $member->password)) {
                    $token = JWTAuth::fromUser($member);
                } else {
                    throw new InvalidCredentialsException();
                }
            } catch (JWTException $e) {
                throw new InvalidCredentialsException();
            }

            $memberTransformer = new MemberTransformer();
            $transformedMember = $memberTransformer->transform($member);

            return [
                'token'      => $token,
                'user'       => $transformedMember,
                'registered' => false
            ];
        } else {
            $user = User::whereEmail($request->getEmail())
                ->where('scrolls_id', $request->getScrollsId())
                ->first();

            if (!$user) {
                throw new UserNotFoundException();
            }

            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    throw new InvalidCredentialsException();
                }
            } catch (JWTException $e) {
                throw new InvalidCredentialsException();
            }

            $userTransformer = new UserTransformer();
            $transformedUser = $userTransformer->transform($user);

            return [
                'token'      => $token,
                'user'       => $transformedUser,
                'registered' => true
            ];
        }
    }

    public function generateToken($userId) {
        $user = User::whereId($userId)->first();
        if (!$user) {
            throw new UserNotFoundException();
        }

        return JWTAuth::fromUser($user);
    }

}
