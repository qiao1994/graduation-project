$(document).ready(function(){
    //点击商家打开商家详情
    $('.shop').click(function(){
        var shopId = $(this).attr('shop-id');
        location.href = $('#controller').attr('value')+'/shop/id/'+shopId;
    });
});