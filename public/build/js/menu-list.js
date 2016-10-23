/**
 * Created by Administrator on 2016/8/17 0017.
 */
var MenuList = function() {
    var menuInit = function(){
        // Select2
        var select2 = $(".select2_single").select2({
            placeholder: "Select a state",
            allowClear: true
        });

        // nestable
        $('#nestable_list_3').nestable({
            "maxDepth":2
        });
        // 添加按钮事件
        $(document).on('click','.createMenu',function () {
            var _item = $(this);
            // 改变select2默认值
            select2.val(_item.attr('data-pid')).trigger("change");
        });

        // 修改菜单按钮事件
        $(document).on('click','.editMenu',function () {
            var _url = $(this).attr('data-href');
            $.ajax({
                url:_url,
                dataType:'json',
                success:function(menu) {
                    console.log(menu);
                    menuFun.initAttribute(menu,select2);

                },
                error:function (err) {
                    alert('分类信息加载失败');
                }
            });
        });
        $(document).on('click','.destroyMenu',function () {
            var form = $(this).children('form');
            form.submit();
        });
        var menuFun = function() {
            var menuAttribute = function(menu,select2) {
                $('input[name=name]').val(menu.name);
                select2.val(menu.parent_id).trigger("change");
                $('textarea[name=description]').val(menu.description);
                $('input[name=keywords]').val(menu.keywords);
                $('input[name=measure_unit]').val(menu.measure_unit);
                $('#menuForm').attr('action',menu.update);
                $('#menuForm').append('<input type="hidden" name="_method" value="PATCH">');
            };
            return {
                initAttribute : menuAttribute
            }
        }();
    };

    return {
        init : menuInit
    }
}();