<?php

namespace App\Api\v1\Transformers\Traits;

use App\Domain;
use App\Topic;

trait DomainDetailTrait {
    public function getAttributes(Domain $domain) {
        return [
          'id' => $domain->id,
          'domain' => $domain->domain,
          'topics' => $domain->topics
        ];
    }

}