<?php

namespace App\Api\v1\Transformers;

use App\Api\v1\Transformers\Traits\TopicDetailTrait;
use App\Topic;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract {
    use TopicDetailTrait;

    public function transform(Topic $topic) {
        return $this->getAttributes($topic);
    }
}