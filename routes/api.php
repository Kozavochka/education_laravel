<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// здесь прописываются руты апи

//middleware - промежуточная стадия от запроса к api
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::middleware('')->group(function (){
Route::resource('cars',CarController::class);

Route::post('order/create', [OrderController::class, 'store']);
Route::get('orders', [OrderController::class, 'index']);

//Чтобы можно было логин, можно поместить сначала все методы под авторизацией, а другие вынести вне блока(прим. стр22)
//Либо перенести в открытую "группу" open_api
//Методы перенесены в open_api
/*Route::post('send', [LoginController::class, 'send']);//отправка пароля(на почту)
Route::post('login', [LoginController::class, 'login']);//логирование*/
//});


/*// Связка API методов с контроллерами
// Фасад
Route::resource('cars',CarController::class);
//Route сделал пути до методов контроллера

// по url вызывает store(только один метод)
Route::post('order/create', [OrderController::class, 'store']);
Route::get('orders', [OrderController::class, 'index']);

Route::post('send', [LoginController::class, 'send']);//отправка пароля(на почту)
Route::post('login', [LoginController::class, 'login']);//логирование*/


