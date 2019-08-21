<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 11:56 AM
 */

namespace App\Api\v1\Exceptions;


class UserNotFoundException extends HttpException {
    const ERROR_MESSAGE = "User not found";

    public function __construct()
    {

        parent::__construct(self::ERROR_MESSAGE, self::USER_NOT_FOUND_EXCEPTION);
    }
}
