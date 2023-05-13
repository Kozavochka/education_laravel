<?php

namespace App\Services\Auth\Exception;

use App\Exceptions\Api\AbstractApiException;

class UserNotFoundException extends AbstractApiException
{
    public $reason = "user_not_found";
}
