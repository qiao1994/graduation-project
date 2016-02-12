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

    <!-- 个人中心 -->
    <div class="ui-form ui-border-t">
        <form action="#">
            <div class="ui-form-item ui-form-item-show ui-border-b">
                <label for="#">账号</label>
                <input type="text" value="<?php echo ($user['username']); ?>" readonly>
            </div>
            <div class="ui-form-item ui-form-item-show ui-border-b">
                <label for="#">电话</label>
                <input type="text" value="<?php echo ($user['phone']); ?>" readonly>
            </div>
            <div class="ui-form-item ui-form-item-show ui-border-b">
                <label for="#">余额</label>
                <input type="text" value="<?php echo ($user['balance']); ?>" readonly>
            </div>
            <div class="ui-form-item ui-form-item-r ui-border-b">
                <input type="text" placeholder="请输入金额">
                <button type="button" class="ui-border-l">充值</button>
                <a href="#" class="ui-icon-close"></a>
            </div>
            <a href="/Home/Index/order">
                <div class="ui-form-item ui-form-item-link ui-border-b">
                    我的订单
                </div>
            </a>
        </form>
    </div>
    <div class="ui-btn-wrap">
        <button class="ui-btn-lg ui-btn-danger" onclick="location.href = $('#controller').attr('value')+'/logout';">
            注销
        </button>
    </div>
        </section>
    </body>
</html>