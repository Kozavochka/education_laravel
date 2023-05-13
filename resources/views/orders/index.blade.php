<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
</head>
<body>

<div>Hello world</div>

@foreach($orders as $order)
    <div>Заказ: {{$order->id}} 8===> @include('user.detail', ['user' => $order->user]) |
        Машины: @foreach($order->cars as $car) {{$car->name}} | @endforeach
        Описание: {{$order?->description}} | Оплачен: {{$order->is_paid ? 'Да': 'Нет'}}
    </div>
@endforeach
</body>
</html>
