<?php

namespace App\Services\Order\Contracts;

use App\Models\Order;
use Spatie\QueryBuilder\QueryBuilder;


interface OrderServiceContract
{
    public function makeOrder($data):Order;

    public function getQueryBuilderOrders():QueryBuilder;

    public function set_paid(Order $order):void;
}
