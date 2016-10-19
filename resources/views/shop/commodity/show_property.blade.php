@extends('layouts.shop.app')

@section('title')
    商品属性列表
    @parent
@endsection

@section('css')
    @include('css.dataTable')
    <!-- PNotify -->
    <link href="{{ asset('vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.brighttheme.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
@endsection

@section('content')
<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>商品属性 <small>goods properties</small></h2>
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
                <div class="x_content" style="display: block;">
                    <p class="text-muted font-13 m-b-30">商品属性列表</p>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>所属分类</th>
                            <th>属性名称</th>
                            <th>创建日期</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>{{ $property->category->name }}</td>
                                <td>{{ $property->name }}</td>
                                <td>{{ $property->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('property.delete',['id'=>$property->id]) }}" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    @include('scripts.dataTable')
    <!-- PNotify -->
    <script src="{{ asset('vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <script>
        $('#datatable').dataTable();
    </script>
    @if (session()->has('flash_notification.message'))
        <script>
            new PNotify({
                title: '{{ session('flash_notification.level') }}',
                text: '{!! session('flash_notification.message') !!}',
                type: '{{ session('flash_notification.level') }}'
            });
        </script>
    @endif
@endsection