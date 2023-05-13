<?php

namespace App\Exceptions\Api;

abstract class AbstractApiException extends \Exception
{
    private $payload;
    protected $reason = 'api_exception';
    protected $code = 422;

    public function __construct(array $payload = [])
    {
        parent::__construct($this->reason, $this->code);
        $this->payload = $payload;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
