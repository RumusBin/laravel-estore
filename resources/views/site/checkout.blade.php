@extends('templates.site.layout')
@section('title')
    Checkout page
@endsection
@section('content')
    @include('templates.site.partials._header')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="step-one">
                <h2 class="heading" id="checkout_heading">Шаг 1</h2>
            </div>
            @if(Auth::guest())
            <div class="checkout-options">
                <h3>Новый покупатель</h3>
                <p>Варианты заказа</p>
                <ul class="nav">
                    <li>
                        <a href="{{route('login')}}">Зарегистрировать аккаунт</a>
                    </li>
                </ul>
            </div><!--/checkout-options-->


            <div class="register-req">
                <p>Добро пожаловать! Вы можете пройти простую процедуру регистрации в нашем интернет-магазине и всегда получать самую актуальную инфу!</p>
            </div><!--/register-req-->
                @else
                <div class="checkout-options">
                    <h3>Здравствуйте, {{Auth::user()->name}}</h3>
                    <p>Данне о заказе</p>

                </div><!--/checkout-options-->


                <div class="register-req">
                    <p>Пожалуйста, заполните поля ниже для уточнения данных о оплате и доставки!</p>
                </div><!--/register-req-->

            @endif
            <div class="shopper-informations">
                <div class="row">
                            <p>Данные о заказе</p>

                        <div class="bill-to">
                            {{--first step on checkout process--}}
                            <div class="form-one" >
                                <form id="checkout_form" action="{{route('new.order')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="user_id" value="@if(Auth::user()){{Auth::user()->id}}@endif">
                                    <div id="checkout_step_one">
                                        <div class="form-body">
                                            <input type="text" name="name" @if(Auth::user())value="{{Auth::user()->name}}" @else placeholder="Имя *" @endif>
                                            <input type="text" name="surname" placeholder="Фамилия *">
                                            <input type="text"name="phone"  placeholder="Телефон *">
                                            <br>
                                            <p id="hidden_town_text">начните вводить название города...</p>
                                            <input type="text" id="town_choose_local" name="town_choose">
                                            <ul id="suggestion_ul" class="suggestion">
                                                <li class="suggestion-i" name="0" text="Харьков">Харьков</li>
                                                <li class="suggestion-i" name="1" text="Киев">Киев</li>
                                                <li class="suggestion-i" name="2" text="Днепр">Днепр</li>
                                                <li class="suggestion-i" name="3" text="Одесса">Одесса</li>
                                                <li class="suggestion-i" name="4" text="Львов">Львов</li>
                                                <li class="suggestion-i" id="choose_t-i" name="5" text="Введите другой город ...">Выберите другой город ... </li>
                                            </ul>
                                        </div>
                                        <div class="order-message">
                                            <p>Комментарий к заказу </p>
                                            <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                                        </div>
                                     </div>
                                    <div id="checkout_step_two">

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                                            оплатить заказ
                                        </button>

                                        <p>Продолжить оформление и оплатить на при получении ТК "Nova Poshta"</p>

                                        <p>Ваш город:</p> <span id="cur_city"></span>

                                       <p>Выберите склад:</p>
                                        <select name="warhouse_checked" id="warhouse_list">

                                        </select>

                                    </div>

                                </form>
                                <div id="checkout_finishd_block" style="display: none">
                                    <span>Ваш заказ оформлен!</span>
                                    <p>Мы свяжемся с Вами скоро!</p>

                                    <a type="button" class="btn btn-primary" href="{{route('home')}}">
                                        Назад в магазин
                                    </a>

                                </div>
                            </div>
                        </div>
                </div>
            </div>



            <button class="btn btn-primary" href="" id="checkout_next">Продолжить</button>
            <button class="btn btn-primary" href="" id="finish_checkout" style="display: none">Заказать</button>
            {{--card payment block--}}
            <div id="card_payment">


                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Имя владельца</label>
                                        <input type="text" class="form-control" id="cardHolder_name" placeholder="Имя держателя карты *">
                                        <small id="emailHelp" class="form-text text-muted">Вевдите пожалуйста имя на карте</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleCurdNumber">Номер карты</label>
                                        <input type="number" class="form-control" id="exampleCurdNumber" placeholder="Номер карты *">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleCurdMonth">Месяц</label>
                                        <input type="number" class="form-control" id="exampleCurdNumber" placeholder="Месяц действия *">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleCurdYear">Месяц</label>
                                        <input type="number" class="form-control" id="exampleCurdYear" placeholder="Год действия *">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleCurdCVV">Секретный код CVV</label>
                                        <input type="number" class="form-control" id="exampleCurdCVV" placeholder="CVV *">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>

        </div>

    </section> <!--/#cart_items-->

    @include('templates.site.partials._footer')
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('site/js/checkout.js')}}"></script>
    <script type="text/javascript" src="{{asset('site/js/novaPoshta.js')}}"></script>
    <script type="text/javascript" src="{{asset('site/js/checkoutForm.js')}}"></script>
@endsection