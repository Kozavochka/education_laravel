<?php

namespace App\Services\Auth\Contracts;

use App\Models\User;
use App\Services\Auth\AuthService;

interface AuthServiceContract
{
    public function setUser(string $email): self;

    public function checkAttempts():self;

    public function checkCode(int $code):self;

    public function getToken():string;
    public function login(array $data):string;
}
