<?php

namespace App\Services\Contracts;

interface LoginContract {
    public function getTeamId();
    public function getEmail();
    public function getPassword();
}