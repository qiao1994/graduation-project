<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>商家辅助系统</title>
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
                <li data-href="goods.html" class="ui-border-r"><a href="/Home/Seller/goods"><i class="ui-icon-cart"></i></a></li>
                <li data-href="order.html" class="ui-border-r"><a href="/Home/Seller/order"><i class="ui-icon-order"></i></a></li>
            </ul>
        </footer>
        <section class="ui-container">
    <input type="hidden" id="controller" value="/Home/Seller">

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
    <script type="text/javascript">
        function changeOrderState(orderId, state) {
            var controller = $('#controller').val();
            $.ajax({
                url:controller+'/ajaxChangeOrderState',
                type:'POST',
                dataType:'text',
                data:'id='+orderId+'&state='+state,
                success:function(ret) {
                    if (ret == 0) {
                        alert('操作成功');
                        location.reload();
                        return true;
                    } else {
                        alert('操作失败');
                        return false;
                    }
                },
            });
        }
    </script>
    <table class="ui-table ui-border-tb">
        <thead>
            <tr class="order-tr"><th>菜品名称</th><th>数量</th><th>备注</th><th>联系方式</th><th>状态</th><th>操作</th></tr>
        </thead>
        <tbody>
            <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="order-tr">
                    <td><?php echo ($vo['goods_name']); ?></td>
                    <td><?php echo ($vo['number']); ?></td>
                    <td><?php echo ($vo['remark']); ?></td>
                    <td><?php echo ($vo['user']['phone']); ?></td>
                    <td><?php echo ($vo['state']); ?></td>
                    <td>
                    <?php if($vo['state'] == 等待处理): ?><a href="#" onclick="javascript:if(confirm('确定要更改当前订单状态？')){changeOrderState(<?php echo ($vo['id']); ?>, '制作中');} else {return false;}">制作中</a>
                    <?php elseif($vo['state'] == 制作中): ?>
                        <a href="#" onclick="javascript:if(confirm('确定要更改当前订单状态？')){changeOrderState(<?php echo ($vo['id']); ?>, '制作完成');} else {return false;}">制作完成</a>                    
                    <?php elseif($vo['state'] == 制作完成): ?>
                        <a href="#" onclick="javascript:if(confirm('确定要更改当前订单状态？')){changeOrderState(<?php echo ($vo['id']); ?>, '订单完成');} else {return false;}">订单完成</a>
                    <?php else: endif; ?>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
        </section>
    </body>
</html>