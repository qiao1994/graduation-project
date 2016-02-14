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
        function changeGoodsState(goodsId, state) {
            var controller = $('#controller').val();
            $.ajax({
                url:controller+'/ajaxChangeGoodsState',
                type:'POST',
                dataType:'text',
                data:'id='+goodsId+'&state='+state,
                success:function(ret) {
                    if (ret == 0) {
                        alert('更改状态成功');
                        location.reload();
                        return true;
                    } else {
                        alert('更改状态失败');
                        return false;
                    }
                },
            });
        }
    </script>
    <table class="ui-table ui-border-tb">
        <thead>
            <tr class="order-tr"><th>菜品名称</th><th>菜品状态</th><th>操作</th></tr>
        </thead>
        <tbody>
            <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="order-tr">
                    <td><?php echo ($vo['name']); ?></td>
                    <td>
                    <?php if($vo['state'] == 1): ?>出售中
                    <?php else: ?>
                        已下架<?php endif; ?>
                    </td>
                    <td>
                    <?php if($vo['state'] == 1): ?><a href="#" onclick="changeGoodsState(<?php echo ($vo['id']); ?>, 0);">下架菜品</a>
                    <?php else: ?>
                        <a href="#" onclick="changeGoodsState(<?php echo ($vo['id']); ?>, 1);">上架菜品</a><?php endif; ?>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
        </section>
    </body>
</html>