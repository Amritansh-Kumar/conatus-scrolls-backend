<?php

namespace App\Services\Contracts;

interface CreateMemberContract {
    public function getTeamId();

    public function getFirstName();

    public function getLastName();

    public function getEmail();

    public function getPassword();

    public function getHostelAccomodation();

    public function getMobNo();

    public function getCollege();

    public function getScrollsId();
}
