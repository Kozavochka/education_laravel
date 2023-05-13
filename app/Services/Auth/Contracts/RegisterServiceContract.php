<?php

namespace App\Services\Auth\Contracts;

interface RegisterServiceContract
{
    public function register(array $data):void;

}
