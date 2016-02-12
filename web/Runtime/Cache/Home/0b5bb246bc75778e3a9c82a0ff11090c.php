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
            <div class="panel-head"><strong>订单列表</strong></div>
            <div class="padding border-bottom">
            <form action="" method="get">
                <div class="line">
                    <div class="x4">
                        <input type="text" class="input find" id="id" name="id" value="<?php echo ($findData['id']); ?>" placeholder="请输入订单编号">
                    </div>
                    <div class="x4">
                        <input type="text" class="input find" id="goods_name" name="name" value="<?php echo ($findData['goods_name']); ?>" placeholder="请输入菜品名称">
                    </div>
                    <div class="x4">
                        <input type="text" class="input find" id="shop_id" name="shop_id" value="<?php echo ($findData['shop_id']); ?>" placeholder="请输入店铺编号">
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
                    <th width="10%" style="text-align:center;">菜品名称</th>
                    <th width="5%" style="text-align:center;">数量</th>
                    <th width="10%" style="text-align:center;">用户电话</th>
                    <th width="15%" style="text-align:center;">订单时间</th>
                    <th width="25%" style="text-align:center;">备注</th>
                    <th width="10%" style="text-align:center;">订单状态</th>
                    <th width="15%" style="text-align:center;">操作</th>
                </tr>
                <?php if(is_array($order['list'])): $i = 0; $__LIST__ = $order['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
                        <td ><?php echo ($vo['id']); ?></td>
                        <td><?php echo ($vo['goods_name']); ?></td>
                        <td><?php echo ($vo['number']); ?></td>
                        <td><?php echo ($vo['user']['phone']); ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $vo['purchase_time']); ?></td>
                        <td><?php echo ($vo['remark']); ?></td>
                        <td><?php echo ($vo['state']); ?></td>
                        <td><a href="#" class="button border-blue button-little dialogs" data-toggle="click" data-target="#order-detail-<?php echo ($vo['id']); ?>" data-mask="1" data-width="50%">详情</a> <a class="button border-yellow button-little dialogs" href="#" data-toggle="click" data-target="#order-handle-<?php echo ($vo['id']); ?>" data-mask="1" data-width="50%">处理</a> <a class="button border-red button-little" href="#" onclick="{if(confirm('确认删除?')){deleteOrder(<?php echo ($vo['id']); ?>);}return false;}" >删除</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <?php echo ($order['page']); ?>                     
        </div>
        <br />
    </div>
    <!-- 订单详情 -->
    <?php if(is_array($order['list'])): $i = 0; $__LIST__ = $order['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div id="order-detail-<?php echo ($vo['id']); ?>">
            <div class="dialog">
                <div class="dialog-head">
                    <span class="close rotate-hover"></span><strong>订单详情</strong>
                </div>
                <div class="dialog-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>
                                订单编号
                            </td>
                            <td id="id">
                                <?php echo ($vo['id']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                菜品名称
                            </td>
                            <td id="goods_name">
                                <?php echo ($vo['goods_name']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                数量
                            </td>
                            <td  id="number">
                                <?php echo ($vo['number']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                用户
                            </td>
                            <td  id="user-username">
                                <?php echo ($vo['user']['username']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                用户电话
                            </td>
                            <td  id="user-phone">
                                <?php echo ($vo['user']['phone']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                购买时间
                            </td>
                            <td  id="purchase_time">
                                <?php echo ($vo['purchase_time']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                备注
                            </td>
                            <td  id="remark">
                                <?php echo ($vo['remark']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                订单状态
                            </td>
                            <td  id="state">
                                <?php echo ($vo['state']); ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="dialog-foot">
                    <button class="button bg-green dialog-close">
                        确认</button>
                </div>
            </div>
        </div>
        <div id="order-handle-<?php echo ($vo['id']); ?>">
            <div class="dialog">
                <form method="post" action="/Home/Admin/orderHandle">
                    <div class="dialog-head">
                        <span class="close rotate-hover"></span><strong>处理订单</strong>
                    </div>
                    <div class="dialog-body">
                        <input type="hidden" id="id" name="id" value="<?php echo ($vo['id']); ?>" />
                        <select class="input" id="state" name="state">
                            <option value="等待处理" 
                            <?php if($vo['state'] == 等待处理): ?>selected<?php endif; ?>
                            >等待处理</option>
                            <option value="制作中"
                            <?php if($vo['state'] == 制作中): ?>selected<?php endif; ?>
                            >制作中</option>
                            <option value="制作完成"
                            <?php if($vo['state'] == 制作完成): ?>selected<?php endif; ?>
                            >制作完成</option>
                            <option value="订单完成"
                            <?php if($vo['state'] == 订单完成): ?>selected<?php endif; ?>
                            >订单完成</option>
                        </select>
                    </div>
                    <div class="dialog-foot">
                        <button class="button dialog-close" type="button">
                            取消
                        </button>
                        <button class="button bg-green" type="submit">
                            确认
                        </button>
                    </div>
                </form>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <!-- 订单详情 -->
    </body>
</html>