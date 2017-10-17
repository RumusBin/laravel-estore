@extends('templates.site.layout')
@section('title')
   Profile title
@endsection

@section('content')
    @include('templates.site.partials._header')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User  Profile</div>

                <div class="panel-body">
                    @component('components.who')
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
    @include('templates.site.partials._footer')
@endsection
