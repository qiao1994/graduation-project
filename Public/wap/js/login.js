$(document).ready(function(){
    //提交表单验证
    $('#login-form').submit(function(){
        if ($('#username').val() == '') {
            alert('请输入用户名!');
            return false;
        }
        if ($('#pwssword').val() == '') {
            alert('请输入密码!');
            return false;
        }
        return true;
    });
    //点击注册按钮
    $('#register-button').click(function(){
        location.href = $('#controller').attr('value')+'/register';
    });
});