<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SendRequest;
use App\Mail\SendCodeAuth;
use App\Models\User;
use App\Services\Auth\Contracts\AuthServiceContract;
use App\Services\Auth\Contracts\RegisterServiceContract;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;

class LoginController extends Controller
{
    private $authSerivce;
    private $registerSerivce;
    //Сервисный слой, вынос методов в отдельные сервисы
    public function __construct(AuthServiceContract $authServ, RegisterServiceContract $regServ)
    {
        $this->authSerivce=$authServ;
        $this->registerSerivce=$regServ;
    }

    //Отправка письма юсеру
    public function send(SendRequest $request)
    {
        $data = $request->validated();
       /* $password = rand(1000, 9999);

        $user=User::query()->updateOrCreate([
            'email' => $data['email'],//поиск пользователя
        ],[
            'name' => $data['name'] ?? self::DEFAULT_NAME,
            'otp' => $password,
            'attempts' => self::MAX_ATTEMPT_COUNT,
        ]);
        //dd($user);
        Mail::to($data['email'])->send(new SendCodeAuth($password));*/
        $this->registerSerivce->register($data);
        return [
            'result' => true,
        ];
    }

    public function login(LoginRequest $request)
    {
       /* $data = $request->validated();*/
        /*//получение пользователя
        $user=User::query()
            ->where('email',$data['email'])
            ->first();


        if(!$user){
            return [
                'result' => false,
                'message' => 'User not found',
            ];
        }

        if($user->attempts==0){
            return [
                'result' => false,
                'message' => 'Count of attempts end, please retry get OTP',
            ];
        }

        if($user->otp != $data['otp']){
            //уменьшение попыток
            $user->decrement('attempts');
            return [
                'result' => false,
                'message' => 'Code is not valued',
            ];
        }

        //генерация токена по id пользователя
        //guard - разделение уровня доступа пользователя, namespace авторизации
        //различные guard для различных пользователей
        $token=Auth::guard('web')->tokenById($user->id);*/
        //dd($token);
       /* return [
            'result' => true,
            'token' => $token,
        ];*/
        /*try{
           $token= $this->authSerivce->login($request->validated());
           $result = true;
           $message='';
        }catch (\Exception $exception){
          $result = false;
          $message= $exception->reason;
        }

         return [
            'result' => $result,
            'token' => $result ? $token : '',
            'message' => $message,
        ];*/
        return[
            'result' => true,
            'token' => $this->authSerivce->login($request->validated()),
        ];
    }
}
