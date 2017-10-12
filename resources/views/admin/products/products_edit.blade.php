@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Product <a href="{{route('products.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <input type="hidden" id="_page_name" value="products">
                    <br />
                    <form method="post" action="{{ route('products.update', ['id' => $product->id]) }}" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group{{ $errors->has('product_code') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_code">Product Code <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="{{$product->product_code}}" id="product_code" name="product_code" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('product_code'))
                                <span class="help-block">{{ $errors->first('product_code') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_name">Product Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$product->product_name}}" id="product_name" name="product_name" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('product_name'))
                                <span class="help-block">{{ $errors->first('product_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$product->price}}" id="price" name="price" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('price'))
                                <span class="help-block">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand_id">Brand <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="brand_id" name="brand_id">
                                    @if(count($brands))
                                    @foreach($brands as $row)
                                    <option value="{{$row->id}}" {{$row->id == $product->brand_id ? 'selected="selected"' : ''}}>{{$row->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('brand_id'))
                                <span class="help-block">{{ $errors->first('brand_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="category_id" name="category_id">
                                    @if(count($categories))
                                    @foreach($categories as $row)
                                    <option value="{{$row->id}}" {{$row->id == $product->category_id ? 'selected="selected"' : ''}}>{{$row->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="help-block">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="images">Images<span class="required">*</span>
                            </label>
                            <div class="image-inner col-md-6 col-sm-6 col-xs-12">
                                <ul id="img_galery" class="galleryContainer">
                                @if(count($images)>0)
                                @foreach($images as $image)


                                            @if($image->is_main == 1)
                                                <li class="img-item col-md-4">

                                                    <div class="img_overlay">
                                                        <div class="img_icon_reload" title="Image reload">
                                                            <input type="hidden" value="{{$image->id}}">
                                                        </div>
                                                        <div class="img_icon_delete" title="Image delete">
                                                            <input type="hidden" value="{{$image->id}}">
                                                        </div>
                                                    </div>
                                                    <span>Main image * </span>
                                                    <div class="main_image">
                                                        <img class="image" src="{{$image->image_path}}" alt="image_{{$product->product_name}}_main">
                                                    </div>

                                                </li>
                                            @else
                                                <li class="img-item col-md-4">

                                                        <div class="img_overlay">
                                                            <div class="img_icon_reload" title="Image reload">
                                                                <input type="hidden" value="{{$image->id}}">
                                                            </div>
                                                            <div class="img_icon_delete" title="Image delete">
                                                            <input type="hidden" value="{{$image->id}}">
                                                            </div>
                                                        </div>
                                                        <img src="{{$image->image_path}}" class="image" alt="{{$product->product_name}}">

                                                </li>
                                            @endif


                                @endforeach
                                    @endif
                                    <li class="img-item col-md-4" id="new-img-add">
                                        <input type="hidden" value="{{$product->id}}" name="product_id" id="item-img-id">
                                        <img src="{{asset('images/add-image.png')}}" alt="add-image">

                                    </li>
                                </ul>


                            </div>
                            <div class="clearfix"></div>
                        </div>


                            <div class="form-group">
                                {{--input CKE editor here--}}
                                <span>Product description *</span>

                                    <textarea id="description" name="description" rows="10" cols="80">
                                            {!! $product->description !!}
                                    </textarea>

                                {{--<input type="text" value="{{$product->description}}" id="description" name="description" class="form-control col-md-7 col-xs-12">--}}
                                @if ($errors->has('description'))
                                    <span class="help-block">{{ $errors->first('description') }}</span>
                                 @endif

                            </div>


                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input name="_method" type="hidden" value="PUT">
                                <button type="submit" class="btn btn-success">Save Product Changes</button>
                            </div>
                        </div>

                    </form>
                    <div class="form_inner">
                        <form id="reload_img" name="form_reload" action="#" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                            <div class="img-form-keeper">
                                <img src="" alt="" id="upl_img">
                            </div>

                            <input type="file" name="img_new" id="img_new">
                            <button type="button" id="inp_submit" name="btn_submit" class="btn btn-outline-success" >Reload img</button>>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop
    @section('page_scripts')
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace( 'description' );
        </script>

    @endsection
