$(document).ready(function(){
    //点击菜品打开菜品详情
    $('.goods').click(function(){
        var goodsId = $(this).attr('goods-id');
        location.href = $('#controller').attr('value')+'/goods/id/'+goodsId;
    });
    //点击购买菜品
    $('.buy-li').click(function(){
        var goodsId = $(this).attr('goods-id');
        location.href = $('#controller').attr('value')+'/buy/id/'+goodsId;
    });
    //修改购买商品的数量
    $('.buy-number').change(function(){
        univalent = $('#univalent').val();
        number = $(this).val();
        amount = univalent*number;
        $('#amount').val('￥'+amount);
    });
});
