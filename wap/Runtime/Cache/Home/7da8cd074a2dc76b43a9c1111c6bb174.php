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
                <li data-href="seller.html" class="ui-border-r"><a href="/Home/Index/shop"><i class="ui-icon-hall"></i></a></li>
                <li data-href="user.html"><a href="/Home/Index/user"><i class="ui-icon-personal"></i></a></li>
            </ul>
        </footer>
        <section class="ui-container">
    <input type="hidden" id="controller" value="/Home/Index">

    <!-- 商家详情 -->
    <section class="ui-placehold-img">
        <span style="background-image:url(/Public/web/images/shop/<?php echo ($shop['img']); ?>)"></span>
    </section>
    <ul class="ui-list ui-list-pure ui-border-tb">
        <li class="ui-border-t"> 
            <ul class="ui-row ui-whitespace">
                <i class="ui-icon-pin" style="display:inline;"></i><?php echo ($shop['address']); ?>
            </ul>
        </li>
        <li class="ui-border-t"> 
            <ul class="ui-row ui-whitespace">
                <i class="ui-icon-tag-pop" style="display:inline;"></i> <?php echo ($shop['tel']); ?>
            </ul>
        </li>
        <li class="ui-border-t"> 
            <ul class="ui-row ui-whitespace">
                <h1>商家简介</h1>
                <?php echo ($shop['introduction']); ?>
            </ul>
        </li>

        <!-- 推荐菜品 -->
        <li class="ui-border-t"> 
            <ul class="ui-row ui-whitespace">
                <a href="/Home/Index/goods/shopId/<?php echo ($shop['id']); ?>">
                    <h2 class="ui-arrowlink">推荐菜品</h2>
                </a>
            </ul>
        </li>
        <li class="ui-border-t"> 
            <ul class="ui-list ui-list-link ui-border-tb ui-whitespace">
                <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ui-border-t goods " goods-id="<?php echo ($vo['id']); ?>">
                        <div class="ui-list-img">
                            <span style="background-image:url(/Public/web/images/goods/<?php echo ($vo['img']); ?>)"></span>
                        </div>
                        <div class="ui-list-info">
                            <h4 class="ui-nowrap"><?php echo ($vo['name']); ?></h4>
                            <p class="ui-nowrap"><?php echo ($vo['introduction']); ?></p>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li>
        <!-- 推荐菜品结束 -->
    </ul>
        </section>
    </body>
</html>