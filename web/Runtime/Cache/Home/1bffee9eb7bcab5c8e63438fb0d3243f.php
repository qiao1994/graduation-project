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
        <script src="/Public/web/admin/js/admin.js"></script>
        <script type="text/javascript" src="/Public/web/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" src="/Public/web/ueditor/ueditor.all.js"></script>
    </head>

    <body>
        <input type="hidden" id="controller" value="/Home/Admin">
        <div class="lefter" style="padding-top:30px;">
            <h1><?php echo ($system['name']); ?><h1/>
        </div>
        <div class="righter nav-navicon" id="admin-nav">
            <div class="mainer">
                <div class="admin-navbar">
                    <span class="float-right">
                    <a class="button button-little bg-main" href="http://www.pintuer.com" target="_blank">前台首页</a>
                    <a class="button button-little bg-yellow" href="/Home/Admin/logout">注销登录</a>
                </span>
                    <ul class="nav nav-inline admin-nav">
                        <li class="<?php echo ($header['index']); ?>">
                            <a href="/Home/Admin" class="icon-home"> 开始</a>
                            <ul>
                                <li><a href="/Home/Admin/user">用户管理</a></li>
                                <li><a href="/Home/Admin/shop">商家管理</a></li>
                                <li><a href="/Home/Admin/goods">菜品管理</a></li>
                                <li><a href="/Home/Admin/order">订单管理</a></li>
                                <li><a href="/Home/Admin/order">数据统计</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo ($header['user']); ?>">
                            <a href="/Home/Admin/user" class="icon-user"> 用户</a>
                            <ul>
                                <li class="<?php echo ($header['user_user']); ?>"><a href="/Home/Admin/user">用户列表</a></li>
                                <li class="<?php echo ($header['user_seller']); ?>"><a href="/Home/Admin/seller">商家用户</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo ($header['shop']); ?>">
                            <a href="/Home/Admin/shop" class="icon-bank"> 商家</a>
                            <ul>
                                <li class="<?php echo ($header['shop_shop']); ?>"><a href="/Home/Admin/shop">商家列表</a></li>
                            </ul>
                        </li>
                        <li class="<?php echo ($header['goods']); ?>">
                            <a href="/Home/Admin/goods" class="icon-shopping-cart"> 菜品</a>
                            <ul>
                                <li class="<?php echo ($header['goods_goods']); ?>"><a href="/Home/Admin/goods">菜品列表</a></li>
                                <li class="<?php echo ($header['goods_comment']); ?>"><a href="/Home/Admin/goodsComment">菜品评价</a></li>
                            </ul>

                        </li>
                        <li class="<?php echo ($header['order']); ?>">
                            <a href="/Home/Admin/order" class="icon-bars"> 订单</a>
                            <ul>
                                <li class="<?php echo ($header['order_order']); ?>"><a href="/Home/Admin/order">订单列表</a></li>
                            </ul> 
                        </li>
                        <li class="<?php echo ($header['statistics']); ?>">
                            <a href="/Home/Admin/statistics" class="icon-table"> 数据</a>
                            <ul>
                                <li class="<?php echo ($header['statistics_statistics']); ?>"><a href="/Home/Admin/statistics">数据统计</a></li>
                            </ul> 
                        </li>
                    </ul>
                </div>
                <div class="admin-bread">
                    <ul class="bread">
                        <li><a href="/Home/Admin/<?php echo ($header['url']); ?>" class="<?php echo ($header['icon']); ?>"> <?php echo ($header['bread1']); ?></a></li>
                        <?php if($header['bread2'] != ''): ?><li><?php echo ($header['bread2']); ?></li><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    <div class="admin">
        <div class="panel admin-panel">
            <div class="panel-head"><strong>商家列表</strong></div>
            <div class="padding border-bottom">
            <form action="" method="get">
                <div class="line">
                    <div class="x3">
                        <input type="text" class="input find" id="id" name="id" value="<?php echo ($findData['id']); ?>" placeholder="请输入商家编号">
                    </div>
                    <div class="x3">
                        <input type="text" class="input find" id="name" name="name" value="<?php echo ($findData['name']); ?>" placeholder="请输入商家名称">
                    </div>
                    <div class="x3">
                        <input type="text" class="input find" id="tel" name="tel" value="<?php echo ($findData['tel']); ?>" placeholder="请输入商家电话">
                    </div>
                    <div class="x3">
                        <select class="input" name="recommend">
                            <option 
                            <?php if(!$findData['recommend']): ?>selected="selected"<?php endif; ?>
                            value="">是否推荐</option>
                            <option 
                            <?php if($findData['recommend'] == 1): ?>selected="selected"<?php endif; ?>
                            value="1">推荐</option>
                            <option 
                            <?php if($findData['recommend'] == 0): ?>selected="selected"<?php endif; ?>
                            value="0">不推荐</option>
                        </select>
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
                    <th width="15%" style="text-align:center;">名称</th>
                    <th width="15%" style="text-align:center;">商家用户</th>
                    <th width="25%" style="text-align:center;">地址</th>
                    <th width="15%" style="text-align:center;">电话</th>
                    <th width="5%" style="text-align:center;">推荐</th>
                    <th width="5%" style="text-align:center;">顺序</th>
                    <th width="15%" style="text-align:center;">操作</th>
                </tr>
                <?php if(is_array($shop['list'])): $i = 0; $__LIST__ = $shop['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
                        <td ><?php echo ($vo['id']); ?></td>
                        <td><?php echo ($vo['name']); ?></td>
                        <td><?php echo ($vo['user']['username']); ?></td>
                        <td><?php echo ($vo['address']); ?></td>
                        <td><?php echo ($vo['tel']); ?></td>
                        <td>
                            <?php if($vo['recommend'] == 1): ?>是
                            <?php else: ?>
                                否<?php endif; ?>
                        </td>
                        <td><?php echo ($vo['serial']); ?></td>
                        <td>
                        <a class="button border-blue button-little" href="/Home/Admin/shopUpdate/id/<?php echo ($vo['id']); ?>">编辑</a> 
                        <a class="button border-green button-little" href="/Home/Admin/goods/shop_id/<?php echo ($vo['id']); ?>">菜品</a> 
                        <a class="button border-yellow button-little" href="#" onclick="{if(confirm('确认删除?')){deleteShop(<?php echo ($vo['id']); ?>);}return false;}">删除</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <?php echo ($shop['page']); ?>                     
        </div>
        <br />
    </div>
    </body>
</html>