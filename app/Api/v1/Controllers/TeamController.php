<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 6:39 PM
 */

namespace App\Api\v1\Controllers;


use App\Api\v1\Exceptions\AccessDeniedException;
use App\Api\v1\Exceptions\TeamNotFoundException;
use App\Api\v1\Exceptions\TopicNotBelongToDomainException;
use App\Api\v1\Requests\BaseRequest;
use App\Api\v1\Transformers\TeamTransformer;
use App\Team;
use App\Topic;
use App\User;
use Illuminate\Support\Facades\Auth;

class TeamController extends BaseController {

    public function show($scrollsId) {

        $user = Auth::user();

        if ($user->scrolls_id != $scrollsId) {
            throw new AccessDeniedException();
        }

        $team = Team::whereScrollsId($scrollsId)
            ->first();

        if (!$team) {
            throw new TeamNotFoundException();
        }

        return $this->response->item($team, new TeamTransformer());
    }

    public function update($scrollsId, BaseRequest $request) {
        $user = Auth::user();

        if ($user->scrolls_id != $scrollsId || $user->status !== User::LEADER) {
            throw new AccessDeniedException();
        }

        $this->validate($request, [
            'topic_id'  => 'exists:topics,id',
            'team_name' => 'string',
        ]);

        $team = Team::whereScrollsId($scrollsId)
            ->first();

        if (!$team) {
            throw new TeamNotFoundException();
        }

        if ($request->has('topic_id')) {
            $topic = Topic::whereId($request->get('topic_id'))->first();
            if ($topic->domain_id !== $team->domain_id) {
                throw new TopicNotBelongToDomainException();
            }
            $team->topic_id = $topic->id;
        }

        if ($request->has('team_name')) {
            $team->team_name = $request->get('team_name');
        }

        $team->save();

        return $this->response->item($team, new TeamTransformer());
    }

}
