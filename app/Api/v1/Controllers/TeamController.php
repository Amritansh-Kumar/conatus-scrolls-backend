<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 6:39 PM
 */

namespace App\Api\v1\Controllers;


use App\Api\v1\Exceptions\AccessDeniedException;
use App\Api\v1\Exceptions\SynopsisAlreadyExistsExceptiion;
use App\Api\v1\Exceptions\SynopsisNotFoundException;
use App\Api\v1\Exceptions\TeamNotFoundException;
use App\Api\v1\Exceptions\TopicNotBelongToDomainException;
use App\Api\v1\Requests\BaseRequest;
use App\Api\v1\Requests\UploadSynopsisRequest;
use App\Api\v1\Transformers\SynopsisTransformer;
use App\Api\v1\Transformers\TeamTransformer;
use App\Services\S3Service;
use App\Synopsis;
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

        $this->leaderAuth($user, $scrollsId);

        $this->validate($request, [
            'topic_id'  => 'exists:topics,id',
            'team_name' => 'string',
        ]);

        $synopsis = Synopsis::whereScrollsId($scrollsId)->first();

        if ($synopsis) {
            throw new SynopsisAlreadyExistsExceptiion();
        }

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

    public function uploadSynopsis($scrollsId, UploadSynopsisRequest $synopsisRequest) {
        $user = Auth::user();

        $this->leaderAuth($user, $scrollsId);

        $synopsis = Synopsis::whereScrollsId($scrollsId)->first();

        if ($synopsis) {
            throw new SynopsisAlreadyExistsExceptiion();
        }

        $s3Service = new S3Service();
        $nameSpace = (string)time() . '_' . $synopsisRequest->getScrollsId() . '.pdf';

        $preSignedUrl = $s3Service->getPreSignedUrl($nameSpace);

        $synopsis                 = new Synopsis();
        $synopsis->team_id        = $synopsisRequest->getTeamId();
        $synopsis->scrolls_id     = $synopsisRequest->getScrollsId();
        $synopsis->namespace      = $nameSpace;
        $synopsis->pre_signed_url = $preSignedUrl;
        $synopsis->save();

        return $this->response->item($synopsis, new SynopsisTransformer());
    }

    public function completeSynopsisUpload($scrollsId) {
        $user = Auth::user();

        $this->leaderAuth($user, $scrollsId);

        $synopsis = Synopsis::whereScrollsId($scrollsId)->first();

        if (!$synopsis) {
            throw new SynopsisNotFoundException();
        }

        $synopsis->is_completed   = true;
        $synopsis->pre_signed_url = null;
        $synopsis->save();

        return $this->response->item($synopsis, new SynopsisTransformer());
    }


    public function deleteSynopsis($scrollsId) {
        $user = Auth::user();

        $this->leaderAuth($user, $scrollsId);

        $synopsis = Synopsis::whereScrollsId($scrollsId)->first();

        if (!$synopsis) {
            throw new SynopsisNotFoundException();
        }

        $s3Service = new S3Service();
        $s3Service->deleteSynopsis($synopsis->namespace);

        $synopsis->delete();
    }

    public function leaderAuth(User $user, $scrollsId) {
        if ($user->scrolls_id != $scrollsId || $user->status !== User::LEADER) {
            throw new AccessDeniedException();
        }
    }

}
