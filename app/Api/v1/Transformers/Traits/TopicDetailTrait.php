<?php

namespace App\Api\v1\Transformers\Traits;

use App\Topic;

trait TopicDetailTrait {
    public function getAttributes(Topic $topic) {
        return [
            'id'    => $topic->id,
            'topic' => $topic->topic
        ];
    }
}