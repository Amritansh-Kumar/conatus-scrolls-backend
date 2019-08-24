<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 24/8/19
 * Time: 3:46 PM
 */

namespace App\Api\v1\Exceptions;


class SynopsisNotFoundException extends HttpException {
    const ERROR_MESSAGE = "Synopsis Doens't Exists";

    public function __construct() {

        parent::__construct(self::ERROR_MESSAGE, self::SYNOPSIS_DOESNT_EXISTS_EXCEPTION);
    }
}

