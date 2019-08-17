<?php

namespace App\Services\Contracts;

interface CreateUserContract {
    public function getName();
    public function getMobNo();
    public function getCollege();
    public function getStatus();
    public function getHostelAccomodation();
    public function getEmail();
    public function getPassword();
    public function getTeamName();
    public function getDomain();
    public function getTopic();
    public function getMember1Name();
    public function getMember2Name();
    public function getMember1Email();
    public function getMember2Email();

    public function hasMember2Email();
    public function hasMember2Name();
}