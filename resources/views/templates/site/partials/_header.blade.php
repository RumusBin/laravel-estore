<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{route('home')}}"><img src="{{asset('site/images/home/logo.png')}}" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">

                            <form action="{{route('changelocale')}}" method="post" class="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group @if($errors->first('locale')) has-error @endif">

                                    {{--<span aria-hidden="true"><i class="fa fa-flag"></i></span>--}}
                                    <select name="locale" onchange="this.form.submit()" class="btn btn-default dropdown-toggle usa">

                                        @foreach (config('translatable.locales') as $lang => $language)
                                            <span class="caret"></span>
                                            <option
                                                    @if($lang == App::getLocale())
                                                    selected
                                                    @endif
                                                    value="{{$lang}}">{{$language}}</option>

                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{ $errors->first('locale') }}</small>
                                </div>
                                {{--<div class="btn-group pull-right sr-only">--}}
                                {{--<input type="submit" class="btn btn-success">--}}
                                {{--</div>--}}
                            </form>
                            {{--<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">--}}
                                {{--<span class="caret"></span>--}}
                            {{--</button>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<li><a href="">Canada</a></li>--}}
                                {{--<li><a href="">UK</a></li>--}}
                            {{--</ul>--}}
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canadian Dollar</a></li>
                                <li><a href="">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">

                            <li><a href="{{route('showToCart')}}"><i class="fa fa-shopping-cart"></i>@lang('site/main/main_layout.cart') <span class="badge badge-secondary">{{Session::has('cart')&& Session::get('cart')->totalQty > 0 ? Session::get('cart')->totalQty : ''}}</span></a></li>
                            @if(Auth::guest())
                            <li><a href="{{route('login')}}"><i class="fa fa-unlock"></i> @lang('site/main/main_layout.login')</a></li>
                                @else
                                <li><a href="{{route('profile')}}"><i class="fa fa-user"></i> @lang('site/main/main_layout.account')</a></li>
                                <li><a href=""><i class="fa fa-star"></i> @lang('site/main/main_layout.wishlist'),</a></li>
                                <li>
                                    <a href="#"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-lock"></i> @lang('site/main/main_layout.logout')
                                    </a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        {{csrf_field()}}
                                    </form>
                                </li>
                                @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{route('home')}}">@lang('site/main/main_layout.home')</a></li>
                            <li class="dropdown"><a href="#" class="active">@lang('site/main/main_layout.shop')<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html" class="active">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="login.html">Login</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">@lang('site/main/main_layout.blog')<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">@lang('site/main/main_layout.contact')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="@lang('site/main/main_layout.search')"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>