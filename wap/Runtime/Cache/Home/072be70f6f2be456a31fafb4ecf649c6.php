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

    <!-- 引入首页js和css -->
    <link rel="stylesheet" href="/Public/wap/css/index.css">
    <script src="/Public/wap/js/index.js"></script>
    <!-- 首页滚动图 -->
    <div class="ui-slider" id="slider">
        <ul class="ui-slider-content">
            <?php if(is_array($system['slider'])): $i = 0; $__LIST__ = $system['slider'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span class="slide-img" style="background-image:url(/Public/<?php echo ($vo); ?>)"></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <script class="script">
    (function (){
        var slider = new fz.Scroll('#slider', {
            role: 'slider',
            indicator: true,
            autoplay: true,
            interval: 3000
        });
        slider.on('beforeScrollStart', function(fromIndex, toIndex) {
            console.log(fromIndex,toIndex)
        });
        slider.on('scrollEnd', function(cruPage) {
            console.log(cruPage)
        });
    })();
    </script>
    <!-- 首页滚动图结束 -->

    <!-- 推荐商家 -->
    <section class="ui-panel">
    	<a href="/Home/Index/shop">
            <h2 class="ui-arrowlink">推荐商家<span class="ui-panel-subtitle"><?php echo ($shopCount); ?>家</span></h2>
        </a>
        <ul class="ui-grid-trisect">
            <?php if(is_array($recommendShop)): $i = 0; $__LIST__ = $recommendShop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="shop" shop-id="<?php echo ($vo['id']); ?>">
                    <div class="ui-border">
                        <div class="ui-grid-trisect-img tj-img">
                            <span style="background-image:url(/Public/web/images/shop/<?php echo ($vo['img']); ?>)"></span>
                        </div>
                        <div style="margin-left:10px;">
                            <h4 class="tj-name ui-nowrap-multi"><?php echo ($vo['name']); ?></h4>
                        </div>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </section>
    <!-- 推荐商家结束 -->

    <!-- 推荐菜品 -->
    <section class="ui-panel">   
        <a href="/Home/Index/goods">
            <h2 class="ui-arrowlink">推荐菜品<span class="ui-panel-subtitle"><?php echo ($goodsCount); ?>款</span></h2>
        </a>
        <ul class="ui-grid-trisect">
            <?php if(is_array($recommendGoods)): $i = 0; $__LIST__ = $recommendGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="goods" goods-id="<?php echo ($vo['id']); ?>">
                    <div class="ui-border">
                        <div class="ui-grid-trisect-img tj-img">
                            <span style="background-image:url(/Public/web/images/goods/<?php echo ($vo['img']); ?>)"></span>
                        </div>
                        <div style="margin-left:10px;">
                            <h4 class="tj-name ui-nowrap-multi"><?php echo ($vo['name']); ?></h4>
                        </div>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>                
        </ul>                
    </section>
    <!-- 推荐菜品结束 -->
        </section>
    </body>
</html>