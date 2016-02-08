$(document).ready(function(){
    //点击菜品打开菜品详情
    $('.goods').click(function(){
        var goodsId = $(this).attr('goods-id');
        location.href = $('#controller').attr('value')+'/goods/id/'+goodsId;
    });
});