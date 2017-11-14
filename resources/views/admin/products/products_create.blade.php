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

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_code">Product Code <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="tab-pane" id="product_code">
                                            <input type="text" value="{{ Request::old('product_code') ?: '' }}"  name="product_code" class="form-control col-md-7 col-xs-12">
                                        </div>

                                @if ($errors->has('product_code'))
                                <span class="help-block">{{ $errors->first('product_code') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="tab-pane" id="slug">
                                    <input type="text" value="{{ Request::old('product_code') ?: '' }}"  name="slug" class="form-control col-md-7 col-xs-12">
                                </div>

                                @if ($errors->has('slug'))
                                    <span class="help-block">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                        </div>
                        <br>
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
                        <br>

                        @if(!empty($trans_fields))
                            @foreach($trans_fields as $page_name => $translation)

                                <div class="form-group no-margin-bottom">
                                    <label class="col-sm-2 control-label @if($page_name == 'name') required @endif ">
                                        @if($page_name == 'name') Название
                                        @elseif($page_name == 'description') Описание
                                        @elseif($page_name == 'meta_title') Meta title
                                        @elseif($page_name == 'meta_description') Meta description
                                        @endif
                                    </label>
                                    <div class="col-sm-10">
                                        @if(!empty($translation))
                                            <div class="nav-tabs-custom">
                                                <ul class="nav nav-tabs">
                                                    @foreach($translation as $lang_id => $text)

                                                        <li @if(App::getLocale() == $lang_id) class="active" @endif><a href="#{{ $page_name }}_{{ $lang_id }}" data-toggle="tab">{{ $lang_id }}</a></li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content">
                                                    @foreach($translation as $lang_id => $text)
                                                        <div class="tab-pane @if(App::getLocale() == $lang_id) active @endif" id="{{ $page_name }}_{{ $lang_id }}">
                                                            @if($page_name =='name')
                                                                <input class="form-control" id="name" name="translations[{{ $lang_id }}][{{ $page_name }}]" placeholder="Введите залоговок" value="{{ old('translations.' . $lang_id . '.' . $page_name) ?? $text }}" required>
                                                                <br>
                                                            @elseif($page_name == 'description')
                                                                <textarea class="summernote form-control" id="text_{{$lang_id}}" name="translations[{{ $lang_id }}][{{ $page_name }}]" placeholder="Введите текст">{{ old('translations.' . $lang_id . '.' . $page_name) ?? $text }}</textarea>
                                                                <br>
                                                                <hr>
                                                                <div class="form-group">
                                                                    <span style="text-align: center">Выбор картинки продукта</span>
                                                                </div>
                                                                <hr>

                                                                <div class="form-group">
                                                                    {{--image block--}}
                                                                    <span class="control-label col-md-3 col-sm-3 col-xs-12" >Images <span class="required">*</span></span>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <div id="img_new"></div>
                                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="file" name="images[]" id="image_input" accept="jpg|jpeg|png" class="form-control col-md-7 col-xs-12" multiple>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <span style="text-align: center">Бренд</span>
                                                                </div>
                                                                <hr>

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
                                                                <div class="form-group">
                                                                    <span style="text-align: center">Категория</span>
                                                                </div>
                                                                <hr>

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
                                                                                    <span style="text-align: center">SEO</span>
                                                                                </div>

                                                                <hr>
                                                            @elseif($page_name == 'meta_title')
                                                                <input class="summernote form-control" name="translations[{{ $lang_id }}][{{ $page_name }}]" placeholder="Введите текст"
                                                                value="{{ old('translations.' . $lang_id . '.' . $page_name) ?? $text }}">
                                                            @elseif($page_name == 'meta_description')
                                                                <textarea class="summernote form-control" id="text_{{$lang_id}}" name="translations[{{ $lang_id }}][{{ $page_name }}]" placeholder="Введите текст">{{ old('translations.' . $lang_id . '.' . $page_name) ?? $text }}</textarea>

                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="ln_solid"></div>
                        {{--tokens and fields --}}
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
        $(function(){
            let locales = ['ru', 'ua', 'en'];
            $.each(locales, function(index, value){
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'text_'+value );
            });
        });
    </script>
@endsection