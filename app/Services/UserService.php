<?php

namespace App\Services;

use App\Api\v1\Exceptions\MemberAlreadyExistsException;
use App\Api\v1\Exceptions\UserAlreadyExistsException;
use App\Api\v1\Exceptions\UserNotFoundException;
use App\Helpers;
use App\Jobs\RegistrationMailJob;
use App\Member;
use App\Services\Contracts\CreateLeaderContract;
use App\Services\Contracts\CreateMemberContract;
use App\Services\Contracts\UpdateUserContract;
use App\Team;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {
    use DispatchesJobs;

    private function getTeamId($id) {
        return Helpers::generateTeamId($id);
    }

    public function storeUser(CreateLeaderContract $contract) {

        $user = User::whereEmail($contract->getEmail())
            ->first();

        if ($user) {
            throw new UserAlreadyExistsException();
        }

        $memberEmails = [];
        array_push($memberEmails, $contract->getMember1Email());

        if ($contract->hasMember2Email()) {
            array_push($memberEmails, $contract->getMember2Email());
        }

        $members = Member::query()->whereIn('email', $memberEmails)
            ->get();

        if (count($members) > 0) {
            throw new MemberAlreadyExistsException();
        }

        $domain_id = $contract->getDomainId();

        $team             = new Team();
        $team->team_name  = $contract->getTeamName();
        $team->domain_id  = $domain_id;
        $scrollsId        = $this->getTeamId($domain_id);
        $team->scrolls_id = $scrollsId;
        $team->save();

        $user                      = new User();
        $user->team_id             = $team->id;
        $user->first_name          = $contract->getFirstName();
        $user->last_name           = $contract->getLastName();
        $user->mob_no              = $contract->getMobNo();
        $user->college             = $contract->getCollege();
        $user->hostel_accomodation = $contract->getHostelAccomodation();
        $user->status              = User::LEADER;
        $user->email               = $contract->getEmail();
        $user->scrolls_id          = $scrollsId;
        $user->password            = $contract->getPassword();
        $user->registered          = true;
        $user->save();

        $memberPasswords = [];
        $memberNames     = [];

        $member             = new User();
        $member->team_id    = $team->id;
        $member->scrolls_id = $scrollsId;
        $member->first_name = $contract->getMember1Name();
        $fullName           = $contract->getMember1Name();
        if ($contract->hasMember1LastName()) {
            $member->last_name = $contract->getMember1LastName();
            $fullName          = $fullName . $contract->getMember1LastName();
        }
        $member->email    = $contract->getMember1Email();
        $password         = Helpers::generatePassword();
        $member->password = $password;
        $member->save();

        array_push($memberPasswords, $password);
        array_push($memberNames, $fullName);

        if ($contract->hasMember2Name()) {
            $member             = new User();
            $member->team_id    = $team->id;
            $member->scrolls_id = $scrollsId;
            $member->first_name = $contract->getMember2Name();
            $fullName           = $contract->getMember2Name();
            if ($contract->hasMember2LastName()) {
                $member->last_name = $contract->getMember2LastName();
                $fullName          = $fullName . $contract->getMember2LastName();
            }
            $member->email    = $contract->getMember2Email();
            $password         = Helpers::generatePassword();
            $member->password = $password;
            $member->save();

            array_push($memberPasswords, $password);
            array_push($memberNames, $fullName);
        }

        $job = new RegistrationMailJob($memberEmails, $memberPasswords, $memberNames, $user);
        $this->dispatch($job);

        return $user;
    }

    public function storeMember(CreateMemberContract $contract) {
        $user = Auth::user();

        if (!$user) {
            throw new UserNotFoundException();
        }

        if ($user->registered === 0) {
            $user->last_name           = $contract->getLastName();
            $user->mob_no              = $contract->getMobNo();
            $user->college             = $contract->getCollege();
            $user->hostel_accomodation = $contract->getHostelAccomodation();
            $user->password            = $contract->getPassword();
            $user->registered          = true;
            $user->save();
        }

        return $user;
    }

    public function update(UpdateUserContract $contract) {
        $user = Auth::user();

        if ($contract->hasHostelAccomodation()) {
            $user->hostel_accomodation = $contract->getHostelAccomodation();
        }

        if ($contract->hasMobNo()) {
            $user->mob_no = $contract->getMobNo();
        }

        $user->save();
        return $user;
    }
}
