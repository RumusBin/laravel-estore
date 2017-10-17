@extends('templates.site.layout')
@section('title')
    Home title
@endsection
 @section('content')
    @include('templates.site.partials._header')
    <section id="advertisement"{{asset('site/')}}>
        <div class="container">
            <img src="{{asset('site/images/shop/advertisement.jpg')}}" alt="" />
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Mens
                                        </a>
                                    </h4>
                                </div>
                                <div id="mens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="">Fendi</a></li>
                                            <li><a href="">Guess</a></li>
                                            <li><a href="">Valentino</a></li>
                                            <li><a href="">Dior</a></li>
                                            <li><a href="">Versace</a></li>
                                            <li><a href="">Armani</a></li>
                                            <li><a href="">Prada</a></li>
                                            <li><a href="">Dolce and Gabbana</a></li>
                                            <li><a href="">Chanel</a></li>
                                            <li><a href="">Gucci</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Womens
                                        </a>
                                    </h4>
                                </div>
                                <div id="womens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="">Fendi</a></li>
                                            <li><a href="">Guess</a></li>
                                            <li><a href="">Valentino</a></li>
                                            <li><a href="">Dior</a></li>
                                            <li><a href="">Versace</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @if($categories)
                                @foreach($categories as $category)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#">{{$category->name}}</a></h4>
                                </div>
                            </div>
                                @endforeach
                             @endif

                        </div><!--/category-productsr-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            @if($brands)
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brands as $brand)
                                    <li><a href=""> <span class="pull-right"></span>{{$brand->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div><!--/brands_products-->

                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                <b>$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{asset('site/images/home/shipping.jpg')}}" alt="" />
                        </div><!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>

                        @if($products)
                            @foreach($products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        @foreach($product->images as $image)
                                        @if($image->is_main == 1)
                                        <img src="{{$image->image_path}}" alt   ="" />
                                        @endif
                                        @endforeach
                                        <h2>${{$product->price}}</h2>
                                        <p>{!! $product->product_name !!}</p>
                                        <a href="{{route('addToCart', $product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    {{--<div class="product-overlay">--}}
                                        {{--<div class="overlay-content">--}}
                                            {{--<h2>${{$product->price}}</h2>--}}
                                            {{--<p>{!! $product->product_name !!}</p>--}}
                                            {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @endif



                    </div><!--features_items-->

                </div>
               {{$products->links()}}
            </div>

        </div>
    </section>
     @include('templates.site.partials._footer')
 @endsection