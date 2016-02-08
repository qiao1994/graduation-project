$(document).ready(function(){
    $('#username').blur(function(){
        var controller = $('#controller').val();
        var username = $('#username').val()
        //ajax验证用户名是否存在
        $.ajax({
            type: 'POST',
            url: controller+'/ajaxIfUsernameExists',
            data: 'username='+username,
            success: function(msg) {
                if (msg==0) {
                    alert('当前用户名已经被注册，请重新输入');
                    return false;
                }
            },
        });
    });
    //提交表单验证
    $('#register-form').submit(function(){
        // 用户名
        var username = $('#username').val();
        if (username == '') {
            alert('请输入用户名!');
            return false;
        }
        var patrn=/^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){4,19}$/;
        if (!patrn.exec(username)) {
            alert('请输入5-20个以字母开头、可带数字、“_”、“.”的字串作为用户名');
            return false;
        }
        // 密码
        var password = $('#password').val();
        if (password == '') {
            alert('请输入密码!');
            return false;
        }
        var patrn=/^(\w){6,20}$/;
        if (!patrn.exec(password)) {
            alert('请输入6-20个字母、数字、下划线作为密码!');
            return false;
        }
        // 重复密码
        if ($('#repassword').val() == '') {
            alert('请重复密码!');
            return false;
        }
        if ($('#repassword').val() != $('#password').val()) {
            alert('密码和重复密码不一致!');
            return false;
        }

        // 电话
        var phone = $('#phone').val()
        if (phone == '') {
            alert('请输入电话!');
            return false;
        }
        var patrn=/^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/;
        if (!patrn.exec(phone)) {
            alert('请输入合法的电话或手机号码!');
            return false;
        }
        // QQ
        if ($('#qq').val() == '') {
            alert('请输入QQ号码!');
            return false;
        }
        var patrn=/^[0-9]{1,20}$/;
        if (!patrn.exec($('#qq').val())) {
            alert('请输入合法的QQ号码!');
            return false;
        }
        return true;
    });
});