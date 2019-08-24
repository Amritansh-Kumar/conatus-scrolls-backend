<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 24/8/19
 * Time: 3:53 PM
 */

namespace App\Api\v1\Transformers;


use App\Services\S3Service;
use App\Synopsis;
use App\Team;
use League\Fractal\TransformerAbstract;

class SynopsisTransformer extends TransformerAbstract {

    public function transform(Synopsis $synopsis) {
        return [
            'id'             => $synopsis->id,
            'team_id'        => $synopsis->team_id,
            'scrolls_id'     => $synopsis->scrolls_id,
            'namespace'      => $synopsis->namespace,
            'pre_signed_url' => $synopsis->pre_signed_url,
            'is_completed'   => $synopsis->is_completed,
            'full_url'       => S3Service::getFullURL($synopsis->namespace),
        ];

    }
}
