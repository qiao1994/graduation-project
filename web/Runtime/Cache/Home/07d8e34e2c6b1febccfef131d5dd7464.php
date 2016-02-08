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
			<div class="panel admin-panel">
				<div class="panel-head"><strong>用户列表</strong></div>
				<div class="padding border-bottom">
				<form action="" method="get">
					<div class="line">
	                    <div class="x3">
	                        <input type="text" class="input find" id="id" name="id" value="<?php echo ($findData['id']); ?>" placeholder="请输入用户编号">
	                    </div>
	                    <div class="x3">
	                        <input type="text" class="input find" id="username" name="username" value="<?php echo ($findData['username']); ?>" placeholder="请输入用户名">
	                    </div>
	                    <div class="x3">
	                        <input type="text" class="input find" id="phone" name="phone" value="<?php echo ($findData['phone']); ?>" placeholder="请输入用户电话">
	                    </div>
	                    <div class="x3">
	                        <input type="text" class="input find" id="qq" name="qq" value="<?php echo ($findData['qq']); ?>" placeholder="请输入用户QQ">
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
						<th width="20%" style="text-align:center;">用户名</th>
						<th width="15%" style="text-align:center;">余额</th>
						<th width="20%" style="text-align:center;">电话</th>
						<th width="10%" style="text-align:center;">QQ</th>
						<th width="20%" style="text-align:center;">微信</th>
						<th width="10%" style="text-align:center;">操作</th>
					</tr>
					<?php if(is_array($user['list'])): $i = 0; $__LIST__ = $user['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
							<td ><?php echo ($vo['id']); ?></td>
							<td><?php echo ($vo['username']); ?></td>
							<td>￥ <?php echo ($vo['balance']); ?></td>
							<td><?php echo ($vo['phone']); ?></td>
							<td><?php echo ($vo['qq']); ?></td>
							<td><?php echo ($vo['wechat']); ?></td>
							<td><a class="button border-blue button-little" href="#" onclick="{if(confirm('确认重置当前用户密码?')){resetPassword(<?php echo ($vo['id']); ?>);}return false;}">重置</a> <a class="button border-yellow button-little" href="#" onclick="{if(confirm('确认删除?')){deleteUser(<?php echo ($vo['id']); ?>);}return false;}">删除</a></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</table>
				<?php echo ($user['page']); ?>						
			</div>
			<br />
		</div>
    </body>
</html>