<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 11:54 AM
 */

namespace App\Api\v1\Exceptions;


class AccessDeniedException extends HttpException {
    const ERROR_MESSAGE = "Access denied";

    public function __construct() {
        parent::__construct(self::ERROR_MESSAGE, self::ACCESS_DENIED, 401);
    }
}
