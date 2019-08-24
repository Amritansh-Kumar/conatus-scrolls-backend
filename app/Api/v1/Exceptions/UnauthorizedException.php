<?php

namespace App\Api\V1\Exceptions;


class UnauthorizedException extends HttpException
{
    const ERROR_MESSAGE = "You do not have right access to perform the requested operation.";

    public function __construct($message = null)
    {
        if (is_null($message)) {
            $message = self::ERROR_MESSAGE;
        }

        parent::__construct($message, self::ERROR_UNAUTHORIZED_ACCESS, 403);
    }
}