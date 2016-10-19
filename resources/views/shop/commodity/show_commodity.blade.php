@extends('layouts.shop.app')

@section('title')
    商品列表@parent
@endsection

@section('css')
    @include('css.dataTable')
@endsection

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>分类商品列表</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">搜索</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <a href="{{ route('goods.create',['id'=>$category_id]) }}"
                            class="btn btn-success btn-xs">添加商品</a>
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

                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all" class="flat"></th>
                            <th>所属分类</th>
                            <th>商品编号</th>
                            <th>商品名称</th>
                            <th>点击量</th>
                            <th>商品属性</th>
                            <th>描述</th>
                            <th>新品</th>
                            <th>赠送积分</th>
                            <th>操作</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($goods as $good)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $good->category->name }}</td>
                                <td>{{ $good->goods_sn }}</td>
                                <td>{{ $good->name }}</td>
                                <td>{{ $good->click_count }}</td>
                                <td>
                                    @foreach($good->property as $property)
                                        <span class="label label-info label-sm">{{ $property->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $good->goods_brief }}</td>
                                <td>
                                    @if($good->is_new == 1)
                                        <span class="label label-success" title="是"><i class="fa fa-check"></i></span>
                                    @else
                                        <span class="label label-danger" title="否"><i class="fa fa-close"></i></span>
                                    @endif
                                </td>
                                <td>{{ $good->give_integral }}</td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm" title="查看"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('goods.edit',['id'=> $good->id ]) }}" class="btn btn-success btn-sm" title="编辑"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('goods.property',['id'=> $good->id ]) }}" class="btn btn-warning btn-sm" title="添加属性"><i class="fa fa-plus"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('scripts.dataTable')
@endsection