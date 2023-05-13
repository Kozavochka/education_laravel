<?php

namespace App\Http\Controllers;

use App\Events\OrderPaid;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Mail\SendPaidMail;
use App\Models\Order;
use App\Services\Order\Contracts\OrderServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;

class OrderController extends Controller
{
    private $orderSerivce;

    public function __construct(OrderServiceContract $orderServ)
    {
       $this->orderSerivce=$orderServ;
    }

    //Вывод заказов
    public function index()
    {
        $page = request('page', 1);
        $perPage = request('per_page', 1);

        $orders=$this->orderSerivce
        ->getQueryBuilderOrders()
        ->paginate($perPage, '*', 'page', $page);

        return OrderResource::collection($orders);
    }

    //Создание заказа
    public function store(OrderRequest $request)
    {
       $order = $this->orderSerivce->makeOrder($request->validated());

       return new OrderResource($order);
    }

    //Оплата заказа
    public function pay(Order $order)
    {
        $this->orderSerivce->set_paid($order);
        $order->refresh();
        event(new OrderPaid($order));//event на оплату//

        return new OrderResource($order);
    }
}
