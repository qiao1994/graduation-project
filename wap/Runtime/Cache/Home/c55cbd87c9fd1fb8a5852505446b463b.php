<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo ($system['name']); ?></title>
        <link rel="stylesheet" href="/Public/wap/frozenui-1.3.0/css/frozen.css">
        <script src="/Public/wap/frozenui-1.3.0/lib/zepto.min.js"></script>
        <script src="/Public/wap/frozenui-1.3.0/js/frozen.js"></script> 
        <script src="/Public/wap/js/public.js"></script>

    </head>
    <body ontouchstart>
        <?php if($header['headerFlag']): ?><header class="ui-header ui-header-positive ui-border-b">
                <i class="ui-icon-return" onclick="history.back()"></i>
                <h1><?php echo ($header['headerName']); ?></h1>
            </header><?php endif; ?>
        <footer class="ui-footer ui-footer-btn">
            <ul class="ui-tiled ui-border-t">
                <li data-href="index.html" class="ui-border-r"><a href="/Home/Index"><i class="ui-icon-home"></i></a></li>
                <li data-href="seller.html" class="ui-border-r"><a href="/Home/Index/shop"><i class="ui-icon-hall"></i></a></li>
                <li data-href="user.html"><a href="/Home/Index/user"><i class="ui-icon-personal"></i></a></li>
            </ul>
        </footer>
        <section class="ui-container">
    <input type="hidden" id="controller" value="/Home/Index">

    <!-- 引入js -->
    <script src="/Public/wap/js/login.js"></script>
    <!-- 系统名称 -->
    <div class="ui-whitespace" style="text-align:center;font-size:200%;margin-top:40px;">
        <?php echo ($system['name']); ?>
    </div>
    <!-- 系统名称结束 -->

    <!-- 登录表单 -->
    <div class="ui-form ui-border-t" style="margin-top:40px">
         <form method="post" id="login-form">
            <div class="ui-form-item ui-border-b">
                <label style="display:inlin-block;text-align:center;">
                    用户名
                </label>
                <input id="username" name="username" type="text" placeholder="请输入您的用户名">
                <a href="#" input-id="username" class="ui-icon-close"></a>
            </div>
            <div class="ui-form-item ui-border-b">
                <label style="display:inlin-block;text-align:center;">
                    密码
                </label>
                <input id="password" name="password" type="password" placeholder="请输入您的密码">
                <a href="#" input-id="pwssword" class="ui-icon-close"></a>
            </div>
            <div class="ui-btn-group" style="margin-top:20px">
                <button class="ui-btn-lg ui-btn-primary" type="submit">
                    登录
                </button>
                <button class="ui-btn-lg" type="button" id="register-button" >
                    注册
                </button>
            </div>
        </form>
    </div>
    <!-- 登录表单结束 -->
    <a href="http://127.0.0.1:8001/home/seller" style="float:right;margin:10px 20px">商家登录</a>
        </section>
    </body>
</html>