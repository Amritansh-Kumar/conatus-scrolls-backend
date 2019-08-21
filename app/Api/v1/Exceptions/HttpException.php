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

    public function __construct($message, $errorCode, $statusCode = 422) {
        parent::__construct($statusCode, $message, null, array(), $errorCode);
    }

}
