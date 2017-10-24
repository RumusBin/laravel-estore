@extends('templates.site.layout')
@section('title')
   Profile title
@endsection

@section('content')
    @include('templates.site.partials._header')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Добро пожаловать {{Auth::user()->name}} в Ваш профайл!</div>
                <h3>Мои заказы:</h3>
                <hr>

                @if(!empty($orders))

                    @foreach($orders as $order)


                <div class="panel-body">
                    <ul class="list-group">
                       @foreach($order->cart->items as $item)
                        <li class="list-group-item">
                            <span class="badge">{{$item['price']}} грн.</span>
                            {{$item['item']['product_name']}} | {{$item['qty']}}
                        </li>
                       @endforeach
                    </ul>
                </div>


                <div class="panel-footer">
                    <strong>Всего: {{$order->cart->totalPrice}} грн.</strong>
                    <strong>Создан: {{$order->created_at->diffForHumans()}}</strong>
                </div>
                    @endforeach
                @else
                    <div class="text text-warning">
                        <p>Вы еще ничего не заказывали!!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
    @include('templates.site.partials._footer')
@endsection
