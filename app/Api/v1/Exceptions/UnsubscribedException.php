<?php


namespace App\Api\v1\Exceptions;


class UnsubscribedException extends HttpException
{
    const ERROR_MESSAGE = 'You are not Privileged to have this information.';


    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, self::ERROR_CODE_UNSUBSCRIBED);
    }
}