<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 22/8/19
 * Time: 1:15 PM
 */

namespace App\Api\v1\Exceptions;


class UserAlreadyExistsException extends HttpException {
    const ERROR_MESSAGE = "User Already Exists";

    public function __construct() {

        parent::__construct(self::ERROR_MESSAGE, self::USER_ALREDAY_EXISTS_EXCEPTION);
    }
}
