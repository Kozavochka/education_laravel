<?php

namespace App\Services\Auth\Exception;

use App\Exceptions\Api\AbstractApiException;

class TooManyAttemptsException extends AbstractApiException
{
    public $reason = "too_many_attempts";
}
