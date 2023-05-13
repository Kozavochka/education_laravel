<?php

namespace App\Services\Auth;

use App\Mail\SendCodeAuth;
use App\Models\User;
use App\Services\Auth\Contracts\RegisterServiceContract;
use Illuminate\Support\Facades\Mail;

class RegisterService implements RegisterServiceContract
{

/*    const DEFAULT_NAME='Ronaldo';*/ //теперь эта штука в модельке
    private $password;

    public function register(array $data):void
    {
       // $data['name']=$data['name'] ?? User::DEFAULT_NAME;
        //генерация пароля
        $this->generatePassword();
        //создание юсера
        $this->createUser($data)->sendMail($data['email']);
    }

    private function generatePassword()
    {
        $this->password = rand(1000, 9999);
    }

    //Создание юсера
    private function createUser(array $data)
    {
        User::query()->updateOrCreate([
            'email' => $data['email'],//поиск пользователя
        ],[
            'name' => $data['name'] ?? User::DEFAULT_NAME,
            'otp' => $this->password,
            'attempts' => User::MAX_LOGIN_ATTEMPT_COUNT,
        ]);
        return $this;
    }

    //отправка письма
    private function sendMail($email)
    {
        Mail::to($email)->send(new SendCodeAuth($this->password));
    }
}
