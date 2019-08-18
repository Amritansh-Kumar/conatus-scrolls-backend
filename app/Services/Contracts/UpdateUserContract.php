<?php

namespace App\Services\Contracts;

interface UpdateUserContract {
    public function getHostelAccomodation();
    public function getDomainId();
    public function getTopicId();

    public function hasHostelAccomodation();
    public function hasDomainId();
    public function hasTopicId();
}