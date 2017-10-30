<!DOCTYPE html>
<html lang="{{$app->getLocale()}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />

    <title>{{$title or "Laravel Admin Panel"}}</title>

    <link rel="shortcut icon" type="image/png" href="{{asset('admin/images/favicon.png')}}"/>
    <!-- Bootstrap -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/css/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('admin/css/green.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{asset('admin/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('admin/css/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="{{asset('admin/css/custom.min.css')}}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{asset('admin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css" />


</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>E-Store Admin!</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="{{asset('admin/images/user.png')}}" alt="..." class="img-circle profile_img">
                        </div>



                        <div class="profile_info">
                            <span>@lang('admin/header.welcome')</span>
                            <h2>{{Auth::user()->name}} </h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> @lang('admin/header.admin') </a></li>
                                <li><a><i class="fa fa-edit"></i> @lang('admin/header.products') <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{route('brands.index')}}">@lang('admin/header.brands')</a></li>
                                        <li><a href="{{route('brands.rip')}}">@lang('admin/header.brands_del')</a></li>
                                        <li><a href="{{route('product-categories.index')}}">@lang('admin/header.categories')</a></li>
                                        <li><a href="{{route('products.index')}}">@lang('admin/header.prod_list')</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{route('customers.index')}}"><i class="fa fa-user"></i> @lang('admin/header.customers') </a></li>
                                <li><a href="{{route('orders.index')}}"><i class="fa fa-shopping-cart"></i> @lang('admin/header.orders') </a></li>
                                <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> @lang('admin/header.managers') </a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <div class="langselect navbar-left">

                            <form action="{{route('changelocale')}}" method="post" class="form-inline navbar-select form-locale-select">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group @if($errors->first('locale')) has-error @endif">
                                    <span aria-hidden="true"><i class="fa fa-flag"></i></span>
                                <select name="locale" onchange="this.form.submit()">
                                    @foreach (config('translatable.locales') as $lang => $language)
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



                            {{--{!! Form::open(['method' => 'POST', 'route' => 'changelocale', 'class' => 'form-inline navbar-select']) !!}--}}

                            {{--<div class="form-group @if($errors->first('locale')) has-error @endif">--}}
                                {{--<span aria-hidden="true"><i class="fa fa-flag"></i></span>--}}
                                {{----}}
                                {{--{!! Form::select(--}}
                                    {{--'locale',--}}
                                    {{--['en' => 'EN', 'ru' => 'RU'],--}}
                                    {{----}}
                                    {{--App::getLocale(),--}}
                                    {{--[--}}
                                        {{--'id'       => 'locale',--}}
                                        {{--'class'    => 'form-control',--}}
                                        {{--'required' => 'required',--}}
                                        {{--'onchange' => 'this.form.submit()',--}}
                                    {{--]--}}
                                {{--) !!}  --}}
                                {{--<small class="text-danger">{{ $errors->first('locale') }}</small>--}}
                            {{--</div>--}}

                            {{--<div class="btn-group pull-right sr-only">--}}
                                {{--{!! Form::submit("Change", ['class' => 'btn btn-success']) !!}--}}
                            {{--</div>--}}

                            {{--{!! Form::close() !!}--}}
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('admin/images/user.png')}}" alt="">
                                    {{Auth::user()->name}}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="#"> Profile</a></li>
                                    <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>

                            </li>


                        </ul>

                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                @include('templates.admin.partials.alerts')
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Bootstrap Admin Template by <a href="#">RumusBin</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('admin/js/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('admin/js/nprogress.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('admin/js/icheck.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('admin/js/datatables.scroller.min.js')}}"></script>
    <script src="{{asset('admin/js/jszip.min.js')}}"></script>
    <script src="{{asset('admin/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/js/vfs_fonts.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('admin/js/custom.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>

    <!-- Datatables -->
    <script>
        $(document).ready(function() {
            var handleDataTableButtons = function() {
                if ($("#datatable-buttons").length) {
                    $("#datatable-buttons").DataTable({
                        dom: "Bfrtip",
                        buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                        ],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function() {
                "use strict";
                return {
                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();

            $('#datatable').dataTable();

            $('#datatable-keytable').DataTable({
                keys: true
            });

            $('#datatable-responsive').DataTable();

            $('#datatable-scroller').DataTable({
                ajax: "js/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });

            $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });

            var $datatable = $('#datatable-checkbox');

            $datatable.dataTable({
                'order': [[ 1, 'asc' ]],
                'columnDefs': [
                { orderable: false, targets: [0] }
                ]
            });
            $datatable.on('draw.dt', function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });
            });

            TableManageButtons.init();
        });
    </script>
    <script src="{{asset('js/images_sc.js')}}"></script>
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @yield('page_scripts')
    <!-- /Datatables -->
</body>
</html>