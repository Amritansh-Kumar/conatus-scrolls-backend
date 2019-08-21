<?php

namespace App\Api\v1\Controllers;

use App\Api\v1\Transformers\DomainTransformer;
use App\Api\v1\Transformers\TopicTransformer;
use App\Domain;
use App\Topic;

class DomainController extends BaseController {

    public function fetchDomains() {
        return $this->response->collection(Domain::all(), new DomainTransformer());
    }

    public function indexTopics($domainId) {
        $topics = Topic::whereDomainId($domainId)
            ->get();

        return $this->response->collection($topics, new TopicTransformer());
    }
}
