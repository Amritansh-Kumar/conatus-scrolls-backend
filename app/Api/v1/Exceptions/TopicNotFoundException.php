<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 6:46 PM
 */

namespace App\Api\v1\Exceptions;


class TopicNotFoundException extends HttpException {
    const ERROR_MESSAGE = "Topic Not Found";

    public function __construct() {

        parent::__construct(self::ERROR_MESSAGE, self::TOPIC_NOT_FOUND_EXCEPTION);
    }
}
