<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('order/{order}/pay',[OrderController::class, 'pay']);
Route::post('order/create', [OrderController::class, 'store']);
Route::get('orders', [OrderController::class, 'index']);

Route::post('send', [LoginController::class, 'send']);//отправка пароля(на почту)
Route::post('login', [LoginController::class, 'login']);//логирование
