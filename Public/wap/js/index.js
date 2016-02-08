$(document).ready(function(){
    //点击商家打开商家详情
    $('.shop').click(function(){
        var shopId = $(this).attr('shop-id');
        location.href = $('#controller').attr('value')+'/shop/id/'+shopId;
    });
    //点击菜品打开菜品详情
    $('.goods').click(function(){
        var goodsId = $(this).attr('goods-id');
        location.href = $('#controller').attr('value')+'/goods/id/'+goodsId;
    });
});