@extends('templates.admin.layout')
@section('title'){{$title}}@endsection

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create Product <a href="{{route('products.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('products.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">






                        <div class="form-group{{ $errors->has('product_code') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_code">Product Code <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <ul class="nav nav-tabs">
                                    @foreach($langs as $code=>$countryName)
                                        <li @if(App::getLocale()==$code)class="active"@endif>
                                            <a  href="#product_code_{{$code}}" data-toggle="tab">{{$countryName}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content ">
                                    @foreach($langs as $code=>$countryName)
                                        <div class="tab-pane @if(App::getLocale() == $code) active @endif" id="product_code_{{$code}}">
                                            <input type="text" value="{{ Request::old('product_code') ?: '' }}"  name="['localization']['product_code']['{{$code}}']" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    @endforeach
                                </div>
                                <hr>

                                {{--<input type="text" value="{{ Request::old('product_code') ?: '' }}" id="product_code" name="product_code" class="form-control col-md-7 col-xs-12">--}}


                                @if ($errors->has('product_code'))
                                <span class="help-block">{{ $errors->first('product_code') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_name">Product Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('product_name') ?: '' }}" id="product_name" name="product_name" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('product_name'))
                                <span class="help-block">{{ $errors->first('product_name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('price') ?: '' }}" id="price" name="price" class="form-control col-md-7 col-xs-12">
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
                                            <option value="{{$row->id}}">{{$row->name}}</option>
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
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="help-block">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            <span class="control-label col-md-3 col-sm-3 col-xs-12" >Images <span class="required">*</span>
                            </span>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="img_new"></div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="images[]" id="image_input" accept="jpg|jpeg|png" class="form-control col-md-7 col-xs-12" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <span>Product description *</span>
                        </div>

                        <div class="form-group">
                            {{--input CKE editor here--}}

                            <textarea id="description" name="description" rows="10" cols="80">

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
                                <button type="submit" class="btn btn-success">Create Product</button>
                            </div>
                        </div>
                    </form>
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
    <script>

    </script>

@endsection