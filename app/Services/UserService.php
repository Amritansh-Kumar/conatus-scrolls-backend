<?php

namespace App\Services;

use App\Domain;
use App\Helpers;
use App\Jobs\email_send_job;
use App\Member;
use App\Services\Contracts\CreateUserContract;
use App\User;

class UserService {

    private function getDomainId($domain) {
        return Domain::where('domain', $domain)->get('domain_id');
    }

    private function getPassword() {
        $password = array();
        $password_member1 = Helpers::generatePassword();
        array_push($password, $password_member1);
        $password_member2 = Helpers::generatePassword();
        array_push($password, $password_member2);

        return $password;
    }

    private function getTeamId($domain) {
        return Helpers::generateTeamId($this->getDomainId($domain));
    }

    public function storeUser(CreateUserContract $contract) {
        $user = new User();
        $user->team_id = $this->getTeamId($contract->getDomain());
        $user->name = $contract->getName();
        $user->mob_no = $contract->getMobNo();
        $user->college = $contract->getCollege();
        $user->hostel_accomodation = $contract->getHostelAccomodation();
        $user->status = $contract->getStatus();
        $user->email = $contract->getEmail();
        $user->password = $contract->getPassword();
        $user->team_name = $contract->getTeamName();
        $user->domain = $contract->getDomain();
        $user->topic = $contract->getTopic();
        $user->member1_name = $contract->getMember1Name();
        $user->member1_email = $contract->getMember1Email();
        $user->member2_name = $contract->getMember2Name();
        $user->member2_email = $contract->getMember2Email();
        $user->save();

        $member = new Member();
        $member->name = $contract->getMember1Name();
        $member->email = $contract->getMember1Email();
        $member->password = $this->getPassword()[0];

        $member->save();

        if($contract->hasMember2Name()) {
            $another_member = new Member();
            $another_member->name = $contract->getMember2Name();
            $another_member->email = $contract->getMember2Email();
            $another_member->password = $this->getPassword()[1];
            $another_member->save();
        }

        $this->dispatch(new email_send_job($this->getPassword(), $this->getTeamId($contract->getDomain())));
    }
}