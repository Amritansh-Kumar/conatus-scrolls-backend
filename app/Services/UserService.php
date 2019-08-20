<?php

namespace App\Services;

use App\Api\v1\Exceptions\InvalidCredentialsException;
use App\Api\v1\Transformers\MemberTransformer;
use App\Api\v1\Transformers\UserTransformer;
use App\Domain;
use App\Helpers;
use App\Jobs\email_send_job;
use App\Member;
use App\Services\Contracts\CreateLeaderContract;
use App\Services\Contracts\CreateMemberContract;
use App\Services\Contracts\LoginContract;
use App\Services\Contracts\UpdateUserContract;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService {

    private function getPassword() {
        $password = array();
        $password_member1 = Helpers::generatePassword();
        array_push($password, $password_member1);
        $password_member2 = Helpers::generatePassword();
        array_push($password, $password_member2);

        return $password;
    }

    private function getTeamId($id) {
        return Helpers::generateTeamId($id);
    }

    public function storeUser(CreateLeaderContract $contract) {

        $domain_id = $contract->getDomainId();

        $team = new Team();
        $team->team_name = $contract->getTeamName();
        $team->domain_id = $domain_id;
//        $team->topic_id = $contract->getTopicId();
        $team->team_id = $this->getTeamId($domain_id);
        $team->save();

        $user = new User();
        $user->team_id = $team->id;
        $user->first_name = $contract->getFirstName();
        $user->last_name = $contract->getLastName();
        $user->mob_no = $contract->getMobNo();
        $user->college = $contract->getCollege();
        $user->hostel_accomodation = $contract->getHostelAccomodation();
        $user->status = User::LEADER;
        $user->email = $contract->getEmail();
        $user->password = $contract->getPassword();
        $user->save();

        $member = new Member();
        $member->team_id = $team->id;
        $member->name = $contract->getMember1Name();
        $member->email = $contract->getMember1Email();
        $member->password = Hash::make($this->getPassword()[0]);
        $member->save();

        if($contract->hasMember2Name()) {
            $another_member = new Member();
            $another_member->team_id = $team->id;
            $another_member->name = $contract->getMember2Name();
            $another_member->email = $contract->getMember2Email();
            $another_member->password = Hash::make($this->getPassword()[1]);
            $another_member->save();
        }

        //$this->dispatch(new email_send_job($this->getPassword(),$this->getTeamId($domain_id)));

        return $user;
    }

    public function storeMember(CreateMemberContract $contract) {
        $user = new User();
        $user->team_id = $contract->getTeamId();
        $user->first_name = $contract->getFirstName();
        $user->last_name = $contract->getLastName();
        $user->mob_no = $contract->getMobNo();
        $user->college = $contract->getCollege();
        $user->hostel_accomodation = $contract->getHostelAccomodation();
        $user->status = User::MEMBER;
        $user->email = $contract->getEmail();
        $user->password = $contract->getPassword();
        $user->save();

        return $user;
    }

    public function update(UpdateUserContract $contract) {
        $user = Auth::user();

        if($contract->hasHostelAccomodation()) {
            $user->hostel_accomodation = $contract->getHostelAccomodation();
        }

        if($contract->hasDomainId()) {
            $user->domain_id = $contract->getDomainId();
        }

        if($contract->hasTopicId()) {
            $user->topic_id = $contract->getTopicId();
        }

        $user->save();
        return $user;
    }

    public function login(loginContract $contract) {

        $credentials = $contract->only('email', 'password', 'team_id');

        $member = Member::where('email', $contract->getEmail())->first()->where('team_id', $contract->getTeamId());

        if($member) {

            if (Hash::check($member->password, $contract->getPassword())) {
                $token = JWTAuth::fromUser($member);
            } else {
                try {
                    if (!$token = JWTAuth::attempt($credentials)) {
                        throw new InvalidCredentialsException();
                    }
                } catch (JWTException $e) {
                    throw new InvalidCredentialsException();
                }
            }

            return [
                'token'          => $token,
                'user'           => (new MemberTransformer())->transform($member)
            ];
        }

        else {
            $user = User::where('email', $contract->getEmail())->first()->where('team_id', $contract->getTeamId());

            if (!$user) {
                throw new InvalidCredentialsException();
            }

            if (Hash::check($user->password, $contract->getPassword())) {
                $token = JWTAuth::fromUser($user);
            } else {
                try {
                    if (!$token = JWTAuth::attempt($credentials)) {
                        throw new InvalidCredentialsException();
                    }
                } catch (JWTException $e) {
                    throw new InvalidCredentialsException();
                }
            }

            return [
                'token'          => $token,
                'user'           => (new UserTransformer())->transform($user)
            ];
        }
    }
}
