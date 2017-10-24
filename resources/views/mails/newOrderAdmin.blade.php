<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="assets/css/default.css">

</head>
<body>
<style>
    .order-tab-wrapper th{
        background: #aeaeae;
    }
    .order-tab-wrapper tr{
        background: #ae8d0e;
    }
</style>
  <h1>Новый заказ № {{$order->id}}! </h1>
  <h2>Данные покупателя: </h2>
  @if($user->name != 'Guest')
      <p>Имя пользователя: </p>
      <span>{{$user->name}}</span>
      @else
      <p>Новый покупатель</p>
  @endif
<table class="order-tab-wrapper" width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #dd1526; background: #aeaeae;">
    <tr>
        <th style="padding: 5px; background: #aeaeae; font-size: 11px; font-family: 'Arial Black', arial-black;">Код товара</th>
       <th style="padding: 5px; background: #aeaeae; font-size: 11px; font-family: 'Arial Black', arial-black;">Название товара</th>
       <th style="padding: 5px; background: #aeaeae; font-size: 11px; font-family: 'Arial Black', arial-black;">Изображение</th>
       <th style="padding: 5px; background: #aeaeae; font-size: 11px; font-family: 'Arial Black', arial-black;">Цена</th>
       <th style="padding: 5px; background: #aeaeae; font-size: 11px; font-family: 'Arial Black', arial-black;">Количество</th>
    </tr>

    @foreach($arr_products as $product)
        <tr >
            <td style="text-align: center; border: 1px solid #55dd1d; background: #f0f9f2;padding: 5px">{{$product['item']['product_code']}}</td>

            <td style="text-align: center; border: 1px solid #55dd1d; background: #f0f9f2;padding: 5px">{{$product['item']['product_name']}}</td>
            <td style="text-align: center; border: 1px solid #55dd1d; background: #f0f9f2;padding: 5px"> --- </td>
            <td style="text-align: center; border: 1px solid #55dd1d; background: #f0f9f2;padding: 5px">{{$product['price']}}</td>
            <td style="text-align: center; border: 1px solid #55dd1d; background: #f0f9f2;padding: 5px">{{$product['qty']}}</td>
        </tr>
    @endforeach


</table>
        <div>
            <span>Всего товаров в заказе: </span><p>{{$totalQty}}</p>
            <span>На сумму: </span><p>{{$totalPrice}}</p>
        </div>

<div>
    <br>
    <br>
    <p>Данные по доставке:</p>
    <br>
    <p>Имя: {{$order->name}}</p>
    <p>Фамилия: {{$order->surname}}</p>
    <p>Телефон: {{$order->phone}}</p>
    <p>Город: {{$order->city}}</p>
    <p>склад новой почты: {{$order->warhouse}}</p>

    <p>Сообщение к заказу:</p>
    <span>{{$order->message}}</span>

    <p>Дата создания:</p>
    <span>{{$order->created_at}}</span>


</div>
</body>
</html>
