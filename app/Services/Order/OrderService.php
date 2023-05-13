<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Services\Order\Contracts\OrderServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


class OrderService implements OrderServiceContract
{
    public function makeOrder($data):Order
    {
        /**
         * @var $order Order
         */
        $order = Order::query()->create($data);//заказ

        $order->cars()->sync($data['cars']);//связь с машинами

        return $order;
    }

    public function getQueryBuilderOrders(): QueryBuilder
    {
        $ordersQuery = QueryBuilder::for(Order::class)
            ->with(['user', 'cars'])
            ->allowedFilters([
                'description',//по вхождению
                AllowedFilter::exact('is_paid'),
                AllowedFilter::callback('user_mail', function (Builder $query, $value){//фильтр по mail
                        $query->whereHas('user' , function (Builder $subQuery) use($value){
                            return $subQuery->where('email', $value);
                        });
                }),
                AllowedFilter::callback('car_name', function (Builder $query, $value){
                        $query->whereHas('cars' , function (Builder $subQuery) use($value){
                            return $subQuery->where('name', 'like', "%$value%");//вхождение
                        });
                })
            ]);

        return $ordersQuery;
    }

    public function set_paid(Order $order):void
    {
        //if(!$order->is_paid){
            $order->update([
                'is_paid' => true,
            ]);
       // }
    }
}
