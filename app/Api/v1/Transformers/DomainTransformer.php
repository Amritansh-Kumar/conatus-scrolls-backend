<?php

namespace App\Api\v1\Transformers;

use App\Api\v1\Transformers\Traits\DomainDetailTrait;
use App\Domain;
use League\Fractal\TransformerAbstract;

class DomainTransformer extends TransformerAbstract {
    use DomainDetailTrait;

    protected $defaultIncludes = [
      'topics'
    ];

    public function transform(Domain $domain) {
        return $this->getAttributes($domain);
    }

    public function includeTopics(Domain $domain){
        $topics = $domain->topics;
        return $this->collection($topics, new TopicTransformer());
    }
}