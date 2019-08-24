<?php

namespace App\Services\Contracts;

interface LoginContract {
    public function getScrollsId();
    public function getEmail();
    public function getPassword();
}
