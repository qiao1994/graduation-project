<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
                                <li><a href="/Home/Admin/statistics">数据统计</a></li>
                                <li><a href="/Home/Admin/system">系统设置</a></li>
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
                        <li class="<?php echo ($header['system']); ?>">
                            <a href="/Home/Admin/system" class="icon-cog"> 系统</a>
                            <ul>
                                <li class="<?php echo ($header['system_system']); ?>"><a href="/Home/Admin/system">系统设置</a></li>
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
			<div class="line-big">
				<div class="xm3">
					<!-- 管理员信息 -->
					<div class="panel border-back">
						<div class="panel-body text-center">
							<img src="/Public/web/admin/images/admin.png" width="120" class="radius-circle" />
							<br /> <?php echo ($admin['username']); ?>
						</div>
						<div class="panel-foot bg-back border-back">您好，<?php echo ($admin['username']); ?>，欢迎您来到【<?php echo ($system['name']); ?>】后台管理。</div>
					</div>
					<!-- 管理员信息结束 -->
					<br />
					<!-- 网站信息统计 -->
					<div class="panel">
						<div class="panel-head"><strong>站点统计</strong></div>
						<ul class="list-group">
							<li><span class="float-right badge bg-main"><?php echo ($statisticsData['userNumber']); ?></span><span class="icon-user"></span> 用户数量</li>
							<li><span class="float-right badge bg-main"><?php echo ($statisticsData['shopNumber']); ?></span><span class="icon-bank"></span> 店铺数量</li>
							<li><span class="float-right badge bg-main"><?php echo ($statisticsData['goodsNumber']); ?></span><span class="icon-shopping-cart"></span> 菜品数量</li>
							<li><span class="float-right badge bg-main"><?php echo ($statisticsData['orderNumber']); ?></span><span class="icon-bars"></span> 订单数量</li>
							<li><span class="float-right badge bg-main"><?php echo ($statisticsData['toHandleOrderNumber']); ?></span><span class="icon-bars"></span> 待处理订单</li>
							<li><span class="float-right badge bg-main"><?php echo ($statisticsData['toFinishOrderNumber']); ?></span><span class="icon-bars"></span> 未完成订单</li>
						</ul>
					</div>
					<!-- 网站统计信息结束 -->
					<br />
				</div>
				<div class="xm9">
					<!-- 网站介绍 -->
					<div class="alert">
						<h4><?php echo ($system['name']); ?>介绍</h4>
						<p class="text-gray padding-top">
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
							<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介<?php echo ($system['name']); ?>的简介简介
						</p>
					</div>
					<!-- 网站介绍结束 -->

					<!-- 系统基本信息 -->
					<div class="panel">
						<div class="panel-head"><strong>系统信息</strong></div>
						<table class="table">
							<tr>
								<td width="110" align="right">操作系统：</td>
								<td>CentOS</td>
							</tr>
							<tr>
								<td align="right">Web服务器：</td>
								<td>Nginx</td>
							</tr>
							<tr>
								<td align="right">程序语言：</td>
								<td>PHP</td>
							</tr>
							<tr>
								<td align="right">数据库：</td>
								<td>MySQL</td>
							</tr>
						</table>
					</div>
					<!-- 系统信息结束 -->
				</div>
			</div>
			<br />
		</div>
    </body>
</html>