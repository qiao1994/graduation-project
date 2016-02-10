$(document).ready(function(){
    //点击x清除input内容
    $('.ui-icon-close').click(function(){
        if($(this).attr('input-id')) {
            var inputId = $(this).attr('input-id');
            $('#'+inputId).val('');
        }
    });
    //点击菜品打开菜品详情
    $('.goods').click(function(){
        var goodsId = $(this).attr('goods-id');
        location.href = $('#controller').attr('value')+'/goods/id/'+goodsId;
    });
    //点击商家打开商家详情
    $('.shop').click(function(){
        var shopId = $(this).attr('shop-id');
        location.href = $('#controller').attr('value')+'/shop/id/'+shopId;
    });
});