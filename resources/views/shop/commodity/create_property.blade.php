@extends('layouts.shop.app')

@section('title')
    添加商品属性
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
            <h3>商品属性添加</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <!-- right panel -->

        <div class="col-md-6 col-md-offset-3">
            <div class="x_panel">
                <div class="x_title">

                    <h2>商品属性添加 </h2>
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
                          action="{{ route('goods.property.store',['id' => $goods->id]) }}"
                          method="post">
                        {!!csrf_field()!!}
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">所属分类</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" class="form-control hidden"  name="goods_id" value="{{ $goods->id }}">
                                <input type="text" class="form-control" disabled="disabled" value="{{ $goods->category->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">商品名称</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" class="form-control" disabled="disabled" value="{{ $goods->name }}" name="name" placeholder="请输入商品名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">属性名称</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <select class="property-values-list" name="property_name" tabindex="-1" aria-hidden="true" style="width: 100%">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">属性值</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <select class="property-values-list" name="property_value[]" multiple tabindex="-1" aria-hidden="true" style="width: 100%">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">库存量</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" class="form-control" name="stock" value="0" placeholder="请输入商品库存量">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">库存报警数</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" class="form-control" name="warning_stock" value="1" placeholder="请输入商品库存报警量">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">销售价</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" class="form-control" name="price" value="0" placeholder="请输入商品销售量">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-3">
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
        $(".property-values-list").select2({
            tags:true
        })
    </script>
@endsection