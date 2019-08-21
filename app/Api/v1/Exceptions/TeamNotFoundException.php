<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 6:45 PM
 */

namespace App\Api\v1\Exceptions;


class TeamNotFoundException extends HttpException {
    const ERROR_MESSAGE = "Team Not Found";

    public function __construct()
    {

        parent::__construct(self::ERROR_MESSAGE, self::TEAM_NOT_FOUND_EXCEPTION);
    }
}
