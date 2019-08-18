<?php

namespace App\Api\v1\Exceptions;

class InvalidCredentialsException extends HttpException {
    const ERROR_MESSAGE = "Email or Password is Invalid";

    public function __construct()
    {

        parent::__construct(self::ERROR_MESSAGE, self::ERROR_CODE_INVALID_CREDENTIALS);
    }
}