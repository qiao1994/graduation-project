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
        <script src="/Public/wap/js/jquery.min.js"></script>
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
                <li data-href="seller.html" class="ui-border-r"><a href="/Home/Index/cart"><i class="ui-icon-cart"></i></a></li>
                <li data-href="user.html"><a href="/Home/Index/user"><i class="ui-icon-personal"></i></a></li>
            </ul>
        </footer>
        <section class="ui-container">
    <input type="hidden" id="controller" value="/Home/Index">

    <!-- 引用商品页面js -->
    <script src="/Public/wap/js/goods.js"></script>
    <!-- 商品详情 -->

    <!-- 商品banner图 -->
    <section class="ui-placehold-img">
        <span style="background-image:url(/Public/web/images/goods_banner/<?php echo ($goods['img']); ?>)"></span>
    </section>
    <!-- 商品banner图结束 -->

    <ul class="ui-list-pure ui-border-tb">
        <!-- 价格+购买 -->
        <li class="ui-border-t"> 
            <ul class="ui-row ui-whitespace">
                <li class="ui-col ui-col-75" style="text-align:center;">
                    <i class="ui-icon-emo" style="display:inline;"></i>
                    现在购买只需<span style="font-size:20px;color:orange;"><?php echo ($goods['univalent']); ?></span> 元
                    
                </li>
                <li class="ui-col ui-col-25 buy-li ui-border-l" style="text-align:center;" goods-id="<?php echo ($goods['id']); ?>" >
                    <i class="ui-icon-cart" style="display:inline;"></i> 购买
                </li>
            </ul>
        </li>
        <!-- 价格+购买结束 -->

        <!-- 店铺 -->
        <li class="ui-border-t">
            <ul class="ui-row ui-whitespace">
                <a href="/Home/Index/shop/id/<?php echo ($shop['id']); ?>">
                    <div class="ui-list-info">
                        <h1 class="ui-nowrap"><?php echo ($shop['name']); ?></h1>
                        <p class="ui-nowrap"><?php echo ($shop['introduction']); ?></p>
                    </div>
                </a>
            </ul>
        </li>
        <!-- 店铺结束 -->

        <!-- 菜品详情 -->
        <li class="ui-border-t"> 
            <ul class="ui-row ui-whitespace">
                <h1>菜品详情</h1>
                <p><?php echo ($goods['details']); ?></p>
            </ul>
        </li>
        <!-- 菜品详情结束 -->

        <!-- 菜品评价 -->
        <li class="ui-border-t ui-arrowlink"> 
            <ul class="ui-row ui-whitespace">
                <a href="/Home/Index/goods/shopId/<?php echo ($shop['id']); ?>">
                    <h2>菜品评价</h2>
                </a>
            </ul>
        </li>
        <?php if(is_array($comment)): $i = 0; $__LIST__ = array_slice($comment,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ui-border-t">
                <ul class="ui-row ui-whitespace">
                    <div class="ui-list-info">
                        <p><span><?php echo ($vo['username']); ?> </span><span class="date"> <?php echo date("Y-m-d H:i:s", $vo['time']); ?></span></p>
                        <p class="ui-nowrap"><?php echo ($vo['content']); ?></p>
                    </div>
                </ul>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <!-- 菜品评价结束 -->
    </ul>
        </section>
    </body>
</html>