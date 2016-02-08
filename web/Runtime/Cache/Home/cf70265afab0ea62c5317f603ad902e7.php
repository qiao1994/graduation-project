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
                                <li><a href="#">示例</a></li>
                                <li><a href="#">示例</a></li>
                                <li><a href="#">示例</a></li>
                                <li><a href="#">示例</a></li>
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
                        <li><a href="#" class="icon-shopping-cart"> 订单</a></li>
                        <li><a href="#" class="icon-user"> 会员</a></li>
                        <li><a href="#" class="icon-file"> 文件</a></li>
                        <li><a href="#" class="icon-th-list"> 栏目</a></li>
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
							<li><span class="float-right badge bg-red">88</span><span class="icon-user"></span> 用户</li>
							<li><span class="float-right badge bg-main">828</span><span class="icon-file"></span> 文件</li>
							<li><span class="float-right badge bg-main">828</span><span class="icon-shopping-cart"></span> 订单</li>
							<li><span class="float-right badge bg-main">828</span><span class="icon-file-text"></span> 内容</li>
							<li><span class="float-right badge bg-main">828</span><span class="icon-database"></span> 数据库</li>
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
								<th colspan="2">服务器信息</th>
								<th colspan="2">系统信息</th>
							</tr>
							<tr>
								<td width="110" align="right">操作系统：</td>
								<td>Windows 2008</td>
								<td width="90" align="right">系统开发：</td>
								<td><a href="http://www.pintuer.com" target="_blank">拼图前端框架</a></td>
							</tr>
							<tr>
								<td align="right">Web服务器：</td>
								<td>Apache</td>
								<td align="right">主页：</td>
								<td><a href="http://www.pintuer.com" target="_blank">http://www.pintuer.com</a></td>
							</tr>
							<tr>
								<td align="right">程序语言：</td>
								<td>PHP</td>
								<td align="right">演示：</td>
								<td><a href="http://www.pintuer.com/demo/" target="_blank">demo/</a></td>
							</tr>
							<tr>
								<td align="right">数据库：</td>
								<td>MySQL</td>
								<td align="right">群交流：</td>
								<td><a href="http://shang.qq.com/wpa/qunwpa?idkey=a08e4d729d15d32cec493212f7672a6a312c7e59884a959c47ae7a846c3fadc1" target="_blank">201916085</a> (点击加入)</td>
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