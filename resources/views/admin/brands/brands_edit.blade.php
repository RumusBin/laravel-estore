@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Brand <a href="{{route('brands.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {{--specify the name of the page for processing pictures with the js script--}}
                    <input type="hidden" id="_page_name" value="brands">
                    <br />
                    <form method="post" action="{{ route('brands.update', ['id' => $brand->id]) }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        {{ method_field('PUT') }}
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
                                                                <input class="summernote form-control" name="translations[{{ $lang_id }}][{{ $page_name }}]" placeholder="Введите текст" value="{{ old('translations.' . $lang_id . '.' . $page_name) ?? $text }}">
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
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="image"> Image <span class="required">*</span>
                            </label>
                            <div class="image-inner col-md-8 col-md-offset-4 col-sm-6 col-xs-12">
                                <ul id="img_galery" class="galleryContainer">
                                    <li class="img-item col-md-4">
                                        <div class="img_overlay">
                                            <div class="img_icon_reload" title="Image reload">
                                                <input type="hidden" value="{{$brand->id}}">
                                            </div>
                                        </div>
                                        <img src="{{$brand->image}}" class="image" alt="#">
                                    </li>
                                </ul>
                            </div>
                            {{--<div class="col-md-8 col-md-offset-4 col-sm-6 col-xs-12">--}}
                                {{--<input type="file" value="{{ Request::old('image') ?? $brand->image}}" id="image" name="image" class="">--}}
                                {{--@if ($errors->has('image'))--}}
                                    {{--<span class="help-block">{{ $errors->first('image') }}</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                <button type="submit" class="btn btn-success">Update Brand</button>
                            </div>
                        </div>
                    </form>
                    {{--<form method="post" action="{{ route('brands.update', ['id' => $brand->id]) }}" data-parsley-validate class="form-horizontal form-label-left">--}}
                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Brand <span class="required">*</span>--}}
                            {{--</label>--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                {{--<input type="text" value="{{$brand->name}}" id="name" name="name" class="form-control col-md-7 col-xs-12">--}}
                                {{--@if ($errors->has('name'))--}}
                                {{--<span class="help-block">{{ $errors->first('name') }}</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">--}}
                            {{--<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span>--}}
                            {{--</label>--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
                                {{--<input type="text" value="{{$brand->description}}" id="description" name="description" class="form-control col-md-7 col-xs-12">--}}
                                {{--@if ($errors->has('description'))--}}
                                {{--<span class="help-block">{{ $errors->first('description') }}</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">--}}

                            {{--<div class="image-inner col-md-6 col-sm-6 col-xs-12 col-md-offset-4">--}}

                                {{--<div class="img-item col-md-4">--}}
                                    {{--<div class="img_overlay">--}}
                                        {{--<div class="img_icon_reload" title="Image reload">--}}
                                            {{--<input type="hidden" value="{{$brand->id}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<img src="{{$brand->image}}" alt="image-category-{{$brand->id}}">--}}
                                    {{--<input type="hidden" name="category_image" value="{{$brand->image}}">--}}
                                {{--</div>--}}

                                {{--@if ($errors->has('image'))--}}
                                    {{--<span class="help-block">{{ $errors->first('image') }}</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="ln_solid"></div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">--}}
                                {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}
                                {{--<input name="_method" type="hidden" value="PUT">--}}
                                {{--<button type="submit" class="btn btn-success">Save Brand Changes</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}

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
