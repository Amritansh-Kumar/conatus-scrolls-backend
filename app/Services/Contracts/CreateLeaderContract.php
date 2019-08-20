<?php

namespace App\Services\Contracts;

interface CreateLeaderContract {
    public function getFirstName();
    public function getLastName();
    public function getMobNo();
    public function getCollege();
    public function getHostelAccomodation();
    public function getEmail();
    public function getPassword();
    public function getTeamName();
    public function getDomainId();
//    public function getTopicId();
    public function getMember1Name();
    public function getMember2Name();
    public function getMember1Email();
    public function getMember2Email();

    public function hasMember2Email();
    public function hasMember2Name();
}
