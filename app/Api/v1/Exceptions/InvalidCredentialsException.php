<?php

namespace App\Api\v1\Exceptions;


class InvalidCredentialsException extends HttpException {
    const ERROR_MESSAGE = "Incorrect Login Details";

    public function __construct()
    {

        parent::__construct(self::ERROR_MESSAGE, self::ERROR_CODE_INVALID_CREDENTIALS);
    }
}
