//admin.js

// --清除搜索条件
function resetFind() {
    $('.find').val('');
}
// --重置密码
function resetPassword(userId) {
    var controller = $('#controller').val();
    //ajax重置密码
    $.ajax({
        url:controller+'/ajaxResetUserPassword',
        type:'POST',
        dataType:'text',
        data:'id='+userId,
        success:function(ret) {
            if (ret == 0) {
                alert('密码已重置为当前用户的用户名！');
                return true;
            } else {
                alert('重置密码失败！');
                return false;
            }
        },
    });
}
// --删除用户
function deleteUser(userId) {
    var controller = $('#controller').val();
    //ajax删除用户
    $.ajax({
        url:controller+'/ajaxDeleteUser',
        type:'POST',
        dataType:'text',
        data:'id='+userId,
        success:function(ret) {
            if (ret == 0) {
                alert('删除用户成功');
                location.reload();
                return true;
            } else {
                alert('删除用户失败');
                return false;
            }
        },
    });
}
// --删除商家
function deleteShop(shopId) {
    var controller = $('#controller').val();
    //ajax删除用户
    $.ajax({
        url:controller+'/ajaxDeleteShop',
        type:'POST',
        dataType:'text',
        data:'id='+shopId,
        success:function(ret) {
            if (ret == 0) {
                alert('删除店铺成功');
                location.reload();
                return true;
            } else {
                alert('删除店铺失败');
                return false;
            }
        },
    });
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

// --删除商品评价
function deleteGoodsComment(commentId) {
    var controller = $('#controller').val();
    //ajax删除商品
    $.ajax({
        url:controller+'/ajaxDeleteGoodsComment',
        type:'POST',
        dataType:'text',
        data:'id='+commentId,
        success:function(ret) {
            if (ret == 0) {
                alert('删除评价成功');
                location.reload();
                return true;
            } else {
                alert('删除评价失败');
                return false;
            }
        },
    });
}

