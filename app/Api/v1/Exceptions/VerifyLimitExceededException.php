<?php


namespace App\Api\V1\Exceptions;


class VerifyLimitExceededException extends HttpException
{
    const ERROR_MESSAGE = "You have exceeded maximum attempts. Please Resend the code.";

    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, self::ERROR_VERIFY_LIMIT_EXCEEDED);
    }
}