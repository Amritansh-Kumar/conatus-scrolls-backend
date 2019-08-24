<?php
/**
 * Created by PhpStorm.
 * User: Hemant Saini
 * Date: 22-09-2017
 * Time: 08:33 PM
 */

namespace App\Api\V1\Exceptions;

class InvalidPasswordResetCodeException extends HttpException
{

    const ERROR_MESSAGE = "Invalid Password Reset Code";

    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, self::ERROR_PASSWORD_RESET_CODE);
    }
}