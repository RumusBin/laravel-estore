@extends('templates.admin.layout')

@section('content')
<div class="">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>@lang('admin/brands/brand_translate.title_rip')<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Test22 </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>@lang('admin/brands/brand_translate.name')</th>
                                <th>@lang('admin/brands/brand_translate.description')</th>
                                <th>@lang('admin/brands/brand_translate.image')</th>
                                <th>@lang('admin/brands/brand_translate.was_delete')</th>
                                <th>@lang('admin/brands/brand_translate.action')</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>@lang('admin/brands/brand_translate.name')</th>
                                <th>@lang('admin/brands/brand_translate.description')</th>
                                <th>@lang('admin/brands/brand_translate.image')</th>
                                <th>@lang('admin/brands/brand_translate.was_delete')</th>
                                <th>@lang('admin/brands/brand_translate.action')</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($delBrands))
                            @foreach($delBrands as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->description}}</td>
                                <td><img class="tab_img" src="/images/brands/{{$row->image}}" alt=""></td>
                                <td>{{$row->deleted_at}}</td>
                                <td>
                                    <a href="{{ route('brands.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                    <a href="{{ route('brands.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" data-id={{$row->id}} title="Delete"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop