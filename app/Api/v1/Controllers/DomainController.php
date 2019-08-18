<?php

namespace App\Api\v1\Controllers;

use App\Api\v1\Transformers\DomainTransformer;
use App\Domain;

class DomainController extends BaseController {

    public function fetchDomains() {
        return $this->response->collection(Domain::all(), new DomainTransformer());
    }
}