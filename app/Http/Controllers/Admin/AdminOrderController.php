<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Services\Order\Contracts\OrderServiceContract;

class AdminOrderController extends Controller
{
    private $orderSerivce;

    public function __construct(OrderServiceContract $orderServ)
    {
        $this->orderSerivce=$orderServ;
    }

    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 20);

        $orders=$this->orderSerivce
            ->getQueryBuilderOrders()
            ->paginate($perPage, '*', 'page', $page);

        return view('orders.index', compact('orders'));
    }
}
