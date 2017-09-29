@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Category <a href="{{route('product-categories.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <input type="hidden" id="_page_name" value="categories">
                    <br />
                    <form method="post" action="{{ route('product-categories.update', ['id' => $category->id]) }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$category->name}}" id="name" name="name" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="description">Description <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$category->description}}" id="description" name="description" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('description'))
                                <span class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">

                            <div class="image-inner col-md-6 col-sm-6 col-xs-12 col-md-offset-4">

                                <div class="img-item col-md-4">
                                    <div class="img_overlay">
                                        <div class="img_icon_reload" title="Image reload">
                                            <input type="hidden" value="{{$category->id}}">
                                        </div>
                                    </div>
                                    <img src="{{$category->image}}" alt="image-category-{{$category->id}}">
                                    <input type="hidden" name="category_image" value="{{$category->image}}">
                                </div>

                                @if ($errors->has('image'))
                                    <span class="help-block">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input name="_method" type="hidden" value="PUT">
                                <button type="submit" class="btn btn-success">Save Category Changes</button>
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