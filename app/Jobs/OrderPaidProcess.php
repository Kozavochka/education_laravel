<?php

namespace App\Jobs;

use App\Mail\SendCodeAuth;
use App\Mail\SendPaidMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderPaidProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $order;
    //Хранятся в БД. (RabbitMQ)
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        Mail::to($this->order->user->email)->send(new SendPaidMail($this->order->id));
    }
}
