<?php

namespace App\Api\v1\Exceptions;

class HttpException extends \Symfony\Component\HttpKernel\Exception\HttpException {
    const ERROR_CODE_INVALID_CREDENTIALS       = 1;
    const ERROR_CODE_UNSUBSCRIBED              = 2;
    const ACCESS_DENIED                        = 3;
    const USER_NOT_FOUND_EXCEPTION             = 4;
    const TEAM_NOT_FOUND_EXCEPTION             = 5;
    const TOPIC_NOT_FOUND_EXCEPTION            = 6;
    const TOPIC_NOT_BELONG_TO_DOMAIN_EXCEPTION = 7;
    const USER_ALREDAY_EXISTS_EXCEPTION        = 8;
    const MEMBER_ALREDAY_EXISTS_EXCEPTION      = 9;
    const SYNOPSIS_ALREDAY_EXISTS_EXCEPTION    = 10;
    const SYNOPSIS_DOESNT_EXISTS_EXCEPTION     = 11;
    const ERROR_UNAUTHORIZED_ACCESS            = 12;
    const ERROR_PASSWORD_RESET_CODE            = 13;
    const ERROR_VERIFY_LIMIT_EXCEEDED          = 14;

    public function __construct($message, $errorCode, $statusCode = 422) {
        parent::__construct($statusCode, $message, null, array(), $errorCode);
    }

}
