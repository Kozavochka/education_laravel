<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderComment extends Model
{
    use HasFactory;

    protected  $fillable = [
      'text',
      'order_id',
    ];

    //Через order к user
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //Получение пользователя по комментарию
    public function getUserCommentAttribute()
    {
        return $this->order->user;
    }
}
