<?php

namespace App\Services\Contracts;

interface PasswordResetByCodeContract {
    public function getCode();
    public function getPassword();
}