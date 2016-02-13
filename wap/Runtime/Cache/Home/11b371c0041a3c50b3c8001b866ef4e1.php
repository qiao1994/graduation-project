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

    <style type="text/css">
    .page {
        float: right;
        padding-right: 10px;
    }
    .page a {
        padding: 0px 5px;
    }
    .order-tr {
        line-height: 39px;
    }
    </style>
    <table class="ui-table ui-border-tb">
        <thead>
            <tr class="order-tr"><th>订单号</th><th>菜品名称</th><th>购买时间</th><th>订单状态</th></tr>
        </thead>
        <tbody>
            <?php if(is_array($order['list'])): $i = 0; $__LIST__ = $order['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="order-tr"><td><?php echo ($vo['id']); ?></td><td><?php echo ($vo['goods_name']); ?></td><td><?php echo date('Y-m-d H:i:s', $vo['purchase_time']); ?></td><td><a href="/Home/Index/order/id/<?php echo ($vo['id']); ?>"><?php echo ($vo['state']); ?></a></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="page">
        <?php echo ($order['page']); ?>  
    </div>
        </section>
    </body>
</html>