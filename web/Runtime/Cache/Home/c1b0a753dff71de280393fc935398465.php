<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="renderer" content="webkit">
        <title><?php echo ($header['title']); ?></title>
        <link rel="stylesheet" href="/Public/web/admin/pintuer/pintuer.css">
        <link rel="stylesheet" href="/Public/web/admin/css/admin.css">
        <script src="/Public/web/admin/pintuer/jquery.js"></script>
        <script src="/Public/web/admin/pintuer/pintuer.js"></script>
        <script src="/Public/web/admin/js/seller.js"></script>
        <script type="text/javascript" src="/Public/web/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" src="/Public/web/ueditor/ueditor.all.js"></script>
    </head>
    <body>
        <input type="hidden" id="controller" value="/Home/Seller">
        <div class="lefter" style="padding-top:30px;">
            <h1><?php echo ($system['name']); ?><h1/>
        </div>
        <div class="righter nav-navicon" id="admin-nav">
            <div class="mainer">
                <div class="admin-navbar">
                    <span class="float-right">
                    <a class="button button-little bg-main" href="http://www.pintuer.com" target="_blank">前台首页</a>
                    <a class="button button-little bg-yellow" href="/Home/Seller/logout">注销登录</a>
                </span>
                    <ul class="nav nav-inline admin-nav">
                        <li class="<?php echo ($header['index']); ?>">
                            <a href="/Home/Seller" class="icon-home"> 开始</a>
                            <ul>
                                <li><a href="#">示例</a></li>
                                <li><a href="#">示例</a></li>
                                <li><a href="#">示例</a></li>
                                <li><a href="#">示例</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo ($header['shop']); ?>">
                            <a href="/Home/Seller/shop" class="icon-bank"> 店铺</a>
                            <ul>
                                <li class="<?php echo ($header['shop_shop']); ?>"><a href="/Home/Seller/shop">店铺信息</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo ($header['goods']); ?>">
                            <a href="/Home/Seller/goods" class="icon-shopping-cart"> 菜品</a>
                            <ul>
                                <li class="<?php echo ($header['goods_goods']); ?>"><a href="/Home/Seller/goods">菜品列表</a></li>
                                <li class="<?php echo ($header['goods_comment']); ?>"><a href="/Home/Seller/goodsComment">菜品评价</a></li>
                                <li class="<?php echo ($header['goods_create']); ?>"><a href="/Home/Seller/goodsCreate">新增菜品</a></li>
                            </ul>   
                        </li>
                        <li class="<?php echo ($header['order']); ?>">
                            <a href="/Home/Seller/ORDER" class="icon-bars"> 订单</a>
                            <ul>
                                <li class="<?php echo ($header['order_order']); ?>"><a href="/Home/Seller/order">订单列表</a></li>
                            </ul> 
                        </li>

                        <li class="<?php echo ($header['statistics']); ?>">
                            <a href="/Home/Seller/statistics" class="icon-table"> 数据</a>
                            <ul>
                                <li class="<?php echo ($header['statistics_statistics']); ?>"><a href="/Home/Seller/statistics">数据统计</a></li>
                            </ul> 
                        </li>
                    </ul>
                </div>
                <div class="admin-bread">
                    <ul class="bread">
                        <li><a href="/Home/Seller/<?php echo ($header['url']); ?>" class="<?php echo ($header['icon']); ?>"> <?php echo ($header['bread1']); ?></a></li>
                        <?php if($header['bread2'] != ''): ?><li><?php echo ($header['bread2']); ?></li><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    <div class="admin">
        <div class="panel admin-panel">
            <div class="panel-head"><strong>菜品评价</strong></div>
            <div class="padding border-bottom">
            <form action="" method="get">
                <div class="line">
                    <div class="x6">
                        <input type="text" class="input find" id="goods_id" name="goods_id" value="<?php echo ($findData['goods_id']); ?>" placeholder="请输入菜品编号">
                    </div>
                </div>
                <div class="line" align="right" style="margin-top:10px;">
                    <input type="button" class="button button-small border-yellow" value="清空" onclick="resetFind()">
                    <input type="submit" class="button button-small border-blue" value="提交查询">
                </div>
            </form>
            </div>
            <table class="table table-hover">
                <tr>
                    <th width="5%" style="text-align:center;">ID</th>
                    <th width="30%" style="text-align:center;">菜品</th>
                    <th width="10%" style="text-align:center;">用户</th>
                    <th width="40%" style="text-align:center;">评价内容</th>
                    <th width="15%" style="text-align:center;">评价时间</th>
                </tr>
                <?php if(is_array($goodsComment['list'])): $i = 0; $__LIST__ = $goodsComment['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
                        <td ><?php echo ($vo['id']); ?></td>
                        <td ><?php echo ($vo['goods_name']); ?></td>
                        <td><?php echo ($vo['username']); ?></td>
                        <td><?php echo ($vo['content']); ?></td>
                        <td><?php echo date("Y-m-d H:i:s", $vo['time']); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <?php echo ($goodsComment['page']); ?>                     
        </div>
        <br />
    </div>
    </body>
</html>