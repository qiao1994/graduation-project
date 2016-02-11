$(document).ready(function(){
    //关闭对话框
    $('.comment-dialog-close').click(function(){
        $('#comment-dialog').removeClass('show');
    });
    //打开对话框
    $('#comment-button').click(function(){
        $('#comment-dialog').addClass('show');
    });    
    //提交表单验证
    $('#comment-form').submit(function(){
        if ($('#content').val() == '') {
            alert('请输入评价内容!');
            return false;
        }
    });

});