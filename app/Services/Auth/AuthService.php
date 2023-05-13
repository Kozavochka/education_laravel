<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Contracts\AuthServiceContract;
use App\Services\Auth\Exception\InvalidLoginCodeException;
use App\Services\Auth\Exception\TooManyAttemptsException;
use App\Services\Auth\Exception\UserNotFoundException;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceContract
{
    private User $user;
    public function setUser(string $email):AuthService
    {
        /**
         * @var $user User
         */
        $user=User::query()
            ->where('email',$email)
            ->first();

        if(!$user){
           throw new UserNotFoundException();
        }

        $this->user=$user;

        return $this;
    }

    public function checkAttempts():AuthService
    {
        if($this->user->attempts==0){
           throw new TooManyAttemptsException();
        }

        return $this;
    }

    public function checkCode(int $code):AuthService
    {
        $this->user->decrement('attempts');
        if ($this->user->otp != $code) {
            throw new InvalidLoginCodeException();
        }

        return  $this;
    }


    public function getToken():string
    {
        return Auth::guard('web')->tokenById($this->user->id);
    }

    public function login(array $data):string
    {
        return $this
            ->setUser($data['email'])
            ->checkAttempts()
            ->checkCode($data['otp'])
            ->getToken();
    }
}
