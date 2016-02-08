//seller.js

// --清除搜索条件
function resetFind() {
    $('.find').val('');
}

// --删除商品
function deleteGoods(goodsId) {
    var controller = $('#controller').val();
    //ajax删除商品
    $.ajax({
        url:controller+'/ajaxDeleteGoods',
        type:'POST',
        dataType:'text',
        data:'id='+goodsId,
        success:function(ret) {
            if (ret == 0) {
                alert('删除菜品成功');
                location.reload();
                return true;
            } else {
                alert('删除菜品失败');
                return false;
            }
        },
    });
}