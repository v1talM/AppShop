@extends('layouts.shop.app')

@section('title')
    添加商品@parent

@endsection
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2/dist/css/select2.min.css') }}">

    {!! we_css() !!}
    @include('UEditor::head')
@endsection

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>添加商品</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <form id="goods_form" action="{{ route('goods.store') }}" class="form" accept-charset="utf-8" method="post" enctype="multipart/form-data">
            <div class="x_panel">
                <div class="x_title">
                    <h2>商品信息</h2>
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
                    <div class="form-horizontal form-label-left input_mask">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">所属分类</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control hidden"  name="category_id" value="{{ $category->id }}">
                                    {{ csrf_field() }}
                                    <input type="text" class="form-control" disabled="disabled" value="{{ $category->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">商品名称</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="name" placeholder="请输入商品名称">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">点击量</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="click_count" value="0" placeholder="请输入商品点击量">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">缩略图</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <a id="upload-img" v-on:click="uploadImage"  class="btn btn-info btn-block hidden">上传图片</a>
                                    <input type="file" class="form-control " name="thumb">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">是否新品</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="1" checked  name="is_new">是
                                        </label>
                                        <label>
                                            <input type="radio" value="0"  name="is_new">否
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">是否上架</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="0"   name="is_delete">是
                                        </label>
                                        <label>
                                            <input type="radio" value="1" checked name="is_delete">否
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">赠送积分</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="give_integral" value="0" placeholder="请输入赠送积分">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">简短描述</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea name="goods_brief" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12">详细描述</label>
                                <div class="col-md-11 col-sm-11 col-xs-12">
                                    <script id="container" name="goods_desc" type="text/plain">
                                    </script>
                                    <script type="text/javascript">
                                        var ue = UE.getEditor('container');
                                        ue.ready(function() {
                                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                            ue.setHeight(600);
                                        });

                                    </script>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">

                                <div class="col-md-4 col-sm-4 col-xs-6 col-md-offset-1">
                                    <input type="submit" value="添加商品" class="btn btn-lg btn-success btn-block">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 col-md-offset-2">
                                    <div class="btn btn-lg btn-danger btn-block">返回</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>

    </div>

@endsection

@section('scripts')
    <script src="http://cdn.bootcss.com/vue/2.0.1/vue.min.js"></script>
    <script src="http://cdn.bootcss.com/vue-resource/1.0.3/vue-resource.min.js"></script>
    <script src="{{ asset('vendors/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".select2_tag").select2({
                placeholder: "请选择商品属性",
                allowClear: true
            })
        })
        $.fn.serializeObject = function() {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [ o[this.name] ];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        }
        Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name='csrf-token']").attr('content');
        new Vue({
            el:"#goods_form",
            methods:{
                uploadImage:function () {
                    $("#goods_thumb").click();
                },
                uploadForm:function () {
                    var data = $("#goods_form").serializeObject();
                    console.log(data);
                    this.$http.post("{{ route('goods.store') }}",data).then(function(res){
                        console.log(res.data);
                    },function (error) {
                        alert('error');
                    })
                }
            }
        });
    </script>
@endsection