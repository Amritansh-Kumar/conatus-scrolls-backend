<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 24/8/19
 * Time: 3:12 PM
 */

namespace App\Api\v1\Requests;


use App\Services\Contracts\UploadSynopsisContract;

class UploadSynopsisRequest extends BaseRequest implements UploadSynopsisContract {

    const TEAM_ID    = 'team_id';
    const SCROLLS_ID = 'scrolls_id';

    public function rules() {
        return [
            self::TEAM_ID    => 'required|exists:teams,id',
            self::SCROLLS_ID => 'required|string'
        ];
    }

    public function getTeamId() {
        return $this->get(self::TEAM_ID);
    }

    public function getScrollsId() {
        return $this->get(self::SCROLLS_ID);
    }

}
