@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create Category <a href="{{route('product-categories.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('product-categories.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

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
                                                            @elseif($page_name == 'description')
                                                                <textarea class="summernote form-control" id="text_{{$lang_id}}" name="translations[{{ $lang_id }}][{{ $page_name }}]" placeholder="Введите текст">{{ old('translations.' . $lang_id . '.' . $page_name) ?? $text }}</textarea>
                                                            @elseif($page_name == 'meta_title')
                                                                <input class="summernote form-control" name="translations[{{ $lang_id }}][{{ $page_name }}]" placeholder="Введите текст">
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

                        {{--<div class="form-group">--}}
                             {{--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Category name <span class="required">*</span></label>--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                {{--<ul class="nav nav-tabs">--}}
                                    {{--@foreach($langs as $code=>$countryName)--}}
                                        {{--<li @if(App::getLocale()==$code)class="active"@endif>--}}
                                            {{--<a  href="#category_name_{{$code}}" data-toggle="tab">{{$countryName}}</a>--}}
                                        {{--</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                                {{--<div class="tab-content ">--}}
                                    {{--@foreach($langs as $code=>$countryName)--}}
                                        {{--<div class="tab-pane @if(App::getLocale() == $code) active @endif" id="category_name_{{$code}}">--}}
                                            {{--<input type="text" value="{{ Request::old('product_code') ?: '' }}"  name="category_name['{{$code}}']" class="form-control col-md-7 col-xs-12">--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_description">Category description <span class="required">*</span></label>--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                {{--<ul class="nav nav-tabs">--}}
                                    {{--@foreach($langs as $code=>$countryName)--}}
                                        {{--<li @if(App::getLocale()==$code)class="active"@endif>--}}
                                            {{--<a  href="#category_description_{{$code}}" data-toggle="tab">{{$countryName}}</a>--}}
                                        {{--</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                                {{--<div class="tab-content ">--}}
                                    {{--@foreach($langs as $code=>$countryName)--}}
                                        {{--<div class="tab-pane @if(App::getLocale() == $code) active @endif" id="category_description_{{$code}}">--}}
                                            {{--input CKE editor here--}}
                                            {{--<textarea id="description_{{$code}}" name="category_description['{{$code}}']" rows="10" cols="80"></textarea>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}

                                {{--@if ($errors->has('product_code'))--}}
                                    {{--<span class="help-block">{{ $errors->first('product_code') }}</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>     --}}

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image"> Image <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" value="{{ Request::old('image') ?: '' }}" id="image" name="image" class="">
                                @if ($errors->has('image'))
                                    <span class="help-block">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <button type="submit" class="btn btn-success">Create Category</button>
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