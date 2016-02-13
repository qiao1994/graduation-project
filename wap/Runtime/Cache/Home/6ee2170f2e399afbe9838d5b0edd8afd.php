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

    <script src="/Public/wap/js/order_detail.js"></script>
    <style type="text/css">
    .order-detail-table tr{
        line-height: 30px;
    }
    </style>
    <table class="ui-table ui-border-tb order-detail-table">
        <tbody>
            <tr>
                <td>
                    订单编号
                </td>
                <td>
                    <?php echo ($order['id']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    店铺名称
                </td>
                <td>
                    <?php echo ($order['shop']['name']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    店铺地址
                </td>
                <td>
                    <?php echo ($order['shop']['address']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    店铺电话
                </td>
                <td>
                    <?php echo ($order['shop']['tel']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    菜品名称
                </td>
                <td>
                    <?php echo ($order['goods_name']); ?>
                </td>
            </tr>            
            <tr>
                <td>
                    单价
                </td>
                <td>
                    ￥ <?php echo ($order['univalent']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    数量
                </td>
                <td>
                    <?php echo ($order['number']); ?> 份
                </td>
            </tr>
            <tr>
                <td>
                    总价
                </td>
                <td>
                    ￥ <?php echo ($order['amount']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    购买时间
                </td>
                <td>
                    <?php echo date('Y-m-d H:i:s', $order['purchase_time']);?>
                </td>
            </tr>
            <tr>
                <td>
                    处理时间
                </td>
                <td>
                    <?php echo date('Y-m-d H:i:s', $order['processing_time']);?>
                </td>
            </tr>
            <tr>
                <td>
                    备注
                </td>
                <td>
                    <?php echo ($order['remark']); ?>
                </td>
            </tr>
            <tr>
                <td>
                    订单状态
                </td>
                <td>
                    <?php echo ($order['state']); ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="ui-btn-group" style="margin-top: 40px;">
        <button class="ui-btn-lg ui-btn-primary"
            <?php if($order['if_comment'] == 2): ?>id="comment-button" >评价
            <?php elseif($order['if_comment'] == 0): ?>
                disabled >评价
            <?php elseif($order['if_comment'] == 1): ?>
                id="comment-button" >查看评价<?php endif; ?>
        </button>
        <button class="ui-btn-lg" onclick="javascript:history.go(-1);">
            返回
        </button>
    </div>
    <div class="ui-dialog" id="comment-dialog">
        <div class="ui-dialog-cnt">
            <header class="ui-dialog-hd ui-border-b">
                <h3>评价商品</h3>
                <i class="ui-dialog-close comment-dialog-close" data-role="button"></i>
            </header>
            <form action="/Home/Index/goodsComment" method="post" id="comment-form">
                <div class="ui-dialog-bd">
                    <div>
                        <div class="ui-form-item ui-form-item-textarea ui-border-radius" style="padding: 0px;">
                            <input id="goods_id" name="goods_id" type="hidden" value="<?php echo ($order['goods_id']); ?>">
                            <input id="order_id" name="order_id" type="hidden" value="<?php echo ($order['id']); ?>">
                            <textarea placeholder="请输入评价内容" id="content" name="content" style="padding-left: 0px;margin-top: 0px;padding-top: 0px;"
                            <?php if($order['if_comment'] == 1): ?>disabled<?php endif; ?>
                            ><?php if($order['if_comment'] == 1): echo ($order['comment']['content']); endif; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="ui-dialog-ft">
                    <?php if($order['if_comment'] == 1): ?><button type="button" class="comment-dialog-close" data-role="button">确定</button>
                    <?php else: ?>
                        <button type="button" class="comment-dialog-close" data-role="button">取消</button>
                        <button type="submit" data-role="button">提交</button><?php endif; ?>
                </div>
            </form>
        </div>        
    </div>
        </section>
    </body>
</html>