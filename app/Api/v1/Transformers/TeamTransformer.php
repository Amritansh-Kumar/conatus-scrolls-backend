<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 9:35 PM
 */

namespace App\Api\v1\Transformers;


use App\Team;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract {

    public function transform(Team $team) {
        $data = [
            'id'        => $team->id,
            'team_name' => $team->team_name,
            'team_id'   => $team->team_id,
            'domain_id' => $team->domain_id,
            'topic_id'  => $team->topic_id,
            'domain'    => $team->domain->domain,
        ];

        if ($team->topic) {
            $data = array_merge($data, [
                'domain' => $team->domain->domain
            ]);
        }

        if ($team->topic) {
            $data = array_merge($data, [
                'topic' => $team->topic->topic
            ]);
        }

        return $data;
    }
}
