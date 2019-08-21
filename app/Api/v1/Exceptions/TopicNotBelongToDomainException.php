<?php
/**
 * Created by PhpStorm.
 * User: piyushkantm
 * Date: 21/8/19
 * Time: 7:22 PM
 */

namespace App\Api\v1\Exceptions;


class TopicNotBelongToDomainException extends HttpException {
    const ERROR_MESSAGE = "Topic does not belong to your domain";

    public function __construct() {

        parent::__construct(self::ERROR_MESSAGE, self::TOPIC_NOT_BELONG_TO_DOMAIN_EXCEPTION);
    }
}
