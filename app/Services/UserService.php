<?php

namespace App\Services;

use App\Api\v1\Transformers\UserTransformer;
use App\Domain;
use App\Helpers;
use App\Jobs\email_send_job;
use App\Member;
use App\Services\Contracts\CreateLeaderContract;
use App\Services\Contracts\CreateMemberContract;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Hash;
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
        $team->topic_id = $contract->getTopicId();
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

        return $this->getUserData($user);
    }

    private function getUserData($user) {
        return [
            'token' => JWTAuth::fromUser($user),
            'user' => (new UserTransformer)->transform($user)
        ];
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

        return $this->getUserData($user);
    }
}