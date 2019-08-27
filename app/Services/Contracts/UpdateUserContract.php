<?php

namespace App\Services\Contracts;

interface UpdateUserContract {
    public function getHostelAccomodation();

    public function getMobNo();

    public function hasHostelAccomodation();

    public function hasMobNo();
}
