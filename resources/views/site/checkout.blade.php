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
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="step-one">
                <h2 class="heading"> Всего на сумму: {{$totalPrice}} грн.</h2>
            </div>

            <div class="checkout-options">


                @if(!Auth::guard())
                <h3>New User</h3>
                <p>Checkout options</p>
                <ul class="nav">
                    <li>
                        <label><input type="checkbox"> Register Account</label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Guest Checkout</label>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-times"></i>Cancel</a>
                    </li>
                </ul>

            </div><!--/checkout-options-->

            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
            </div><!--/register-req-->
            @endif
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="shopper-info">
                            <p>Оплатить покупку банковской картой </p>
                            <form id="card_payInfo" method="post" action="">
                                <input type="text" name="card_number" placeholder="№ банковской карт" required>
                                <input type="text" name="exp_month" placeholder="Месяц" required>
                                <input type="text" name="exp_year" placeholder="Год" required>
                                <input type="text" name="card_code_sct" placeholder="CVV" required>
                                {{csrf_field()}}

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Комментарий к заказу </p>
                            <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>

                        </div>
                    </div>
                </div>
            </div>

            <div class="payment-options">
					<span>
						<label><input type="radio" id="newPost_chekd" name="delivery_options" value="nova_poshta"> Отправить компанией "Новая почта"</label>
					</span>
                <span>
						<label><input type="radio" id="intime_checkd" name="delivery_options" value="intime"> Отправить компанией "Intime"</label>
					</span>
                <span>
						<label><input type="radio" id="courier_checkd" name="delivery_options" value="courier"> доставка курьером по г. Харькову</label>
					</span>
            </div>
            <lable><input type="submit" name="submit">Продолжить</lable>
            </form>


        </div>
    </section> <!--/#cart_items-->
    @include('templates.site.partials._footer')
@endsection