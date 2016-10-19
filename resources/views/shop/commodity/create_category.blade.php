@extends('layouts.shop.app')

@section('title')
    添加商品分类
    @parent
@endsection

@section('css')
    <!-- iCheck -->
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ asset('vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.brighttheme.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendors/jquery-nestable/jquery.nestable.css') }}">
@endsection

@section('content')
@inject('category','App\Presenters\CategoryPresenter')
    <div class="page-title">
        <div class="title_left">
            <h3>商品类型添加</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <!-- left panel -->
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>商品分类结构 <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content bs-example-popovers">
                    <div class="dd" id="nestable_list_3">
                        <ol class="dd-list">
                            {!! $category->getAllCategoriesList($categories) !!}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end left panel -->
        <!-- right panel -->

        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">

                    <h2>商品类型添加 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br />
                    <form class="form-horizontal form-label-left"
                          id="menuForm"
                          action="{{ route('category.store') }}"
                          method="post">
                        {!!csrf_field()!!}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">类型名称</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">父级类型</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" name="parent_id">
                                    {!! $category->getCategory($categories) !!}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">类型描述</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">类型关键词</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="keywords" class="form-control" value="{{ old('keywords') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">计量单位</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="measure_unit" class="form-control" value="{{ old('measure_unit') }}">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="button" class="btn btn-default">取 消</button>
                                <button type="submit" class="btn btn-success">添 加</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    <!-- end right panel -->
    </div>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- nestable -->
    <script src="{{ asset('vendors/jquery-nestable/jquery.nestable.js') }}"></script>
    <!-- PNotify -->
    <script src="{{ asset('vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <script src="{{ asset('build/js/menu-list.js')}}"></script>

    <script>
        $(document).ready(function() {
            MenuList.init();
        });
    </script>
@endsection