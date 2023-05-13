<?php

namespace App\Services\Auth\Exception;

use App\Exceptions\Api\AbstractApiException;

class InvalidLoginCodeException extends AbstractApiException
{
   public $reason = "invalid_login_code";
}
