<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 24/8/19
 * Time: 3:18 PM
 */

namespace App\Api\v1\Exceptions;


class SynopsisAlreadyExistsExceptiion extends HttpException {
    const ERROR_MESSAGE = "Synopsis Already Exists";

    public function __construct() {

        parent::__construct(self::ERROR_MESSAGE, self::SYNOPSIS_ALREDAY_EXISTS_EXCEPTION);
    }
}
