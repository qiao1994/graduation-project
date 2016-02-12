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
                            <a href="/Home/Seller/order" class="icon-bars"> 订单</a>
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
    <script language="javascript" type="text/javascript" src="/Public/web/My97DatePicker/WdatePicker.js"></script>
    <div class="admin">
        <div class="panel admin-panel">
            <div class="panel-head"><strong>数据统计</strong></div>
            <div class="padding border-bottom">
            <form action="" method="get">
                <div class="line">
                    <div class="x4">
                        <input class="input find" type="text" placeholder="开始日期" onClick="WdatePicker()" id="startDate" name="startDate" value="<?php echo ($statisticsData['startDate']); ?>" />
                    </div>
                    <div class="x4">
                        <input class="input find" type="text" placeholder="开始日期" onClick="WdatePicker()" id="endDate" name="endDate" value="<?php echo ($statisticsData['endDate']); ?>" />
                    </div>
                    <div class="x4">
                        <select class="input" id="goods_id" name="goods_id">
                            <option value="0">所有菜品</option>
                            <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>" 
                                <?php if($vo['id'] == $statisticsData['goodsId']): ?>selected="selected"<?php endif; ?>
                                ><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="line" align="right" style="margin-top:10px;">
                    <input type="button" class="button button-small border-yellow" value="清空" onclick="resetFind()">
                    <input type="submit" class="button button-small border-blue" value="提交查询">
                </div>
            </form>
            </div>
            <table class="table table-bordered">
                <tr>
                    <td width="50%">
                        开始日期
                    </td>                    
                    <td>
                        <?php echo ($statisticsData['startDate']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        结束日期
                    </td>                    
                    <td>
                        <?php echo ($statisticsData['endDate']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        菜品名称
                    </td>                    
                    <td>
                        <?php echo ($statisticsData['goodsName']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        订单数量
                    </td>                    
                    <td>
                        <?php echo ($statisticsData['orderNumber']); ?>
                    </td>
                </tr>                
                <tr>
                    <td>
                        总金额
                    </td>                    
                    <td>
                        ￥ 
                        <?php if($statisticsData['orderAmount']): echo ($statisticsData['orderAmount']); ?>
                        <?php else: ?>
                            0<?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
        <br />
    </div>
    </body>
</html>