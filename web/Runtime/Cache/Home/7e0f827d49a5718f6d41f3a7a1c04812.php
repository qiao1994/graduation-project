<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="renderer" content="webkit">
        <title>商家注册</title>
        <link rel="stylesheet" href="/Public/web/admin/pintuer/pintuer.css">
        <link rel="stylesheet" href="/Public/web/admin/css/admin.css">
        <script src="/Public/web/admin/pintuer/jquery.js"></script>
        <script src="/Public/web/admin/pintuer/pintuer.js"></script>
        <script src="/Public/web/admin/js/seller.js"></script>
    </head>
    <body>
    	<h1 style="text-align:center;margin:40px 10px;">欢迎注册<?php echo ($system['name']); ?></h1>
    		<div class="register-form" style="width:50%;float:center;margin:10px auto;">
    		<div class="panel">
				<div class="panel-head">
					填写信息
				</div>
				<div class="panel-body">
					<form method="post" class="form-x" action="">
						<div class="form-group">
							<div class="label">
								<label for="user[username]">用户名</label>
							</div>
							<div class="field">
								<input type="text" class="input" id="user[username]" name="user[username]" size="50" placeholder="请填写用户名" data-validate="required:请填写用户名,username:请填写英文字母开头的字母、下划线、数字作为用户名" />
							</div>
						</div>
						<div class="form-group">
							<div class="label">
								<label for="user[password]">密码</label>
							</div>
							<div class="field">
								<input type="password" class="input" id="user[password]" name="user[password]" size="50" placeholder="请填写密码" data-validate="required:请填写密码,length#>=6:请输入至少6位作为密码" />
							</div>
						</div>
						<div class="form-group">
							<div class="label">
								<label for="user[phone]">私人电话</label>
							</div>
							<div class="field">
								<input type="text" class="input" id="user[phone]" name="user[phone]" size="50" placeholder="请填写私人电话" data-validate="required:请填写私人电话,tel:请填写合法的电话或手机" />
							</div>
						</div>
						<div class="form-group">
							<div class="label">
								<label for="user[qq]">QQ号码</label>
							</div>
							<div class="field">
								<input type="text" class="input" id="user[qq]" name="user[qq]" size="50" placeholder="请填写QQ号码" data-validate="required:请填写QQ号码,qq:请填写合法的QQ号码" />
							</div>
						</div>	
						<div class="form-group">
							<div class="label">
								<label for="shop[name]">店铺名称</label>
							</div>
							<div class="field">
								<input type="text" class="input" id="shop[name]" name="shop[name]" size="50" placeholder="请填写店铺名称" data-validate="required:请填写你的店铺名称" />
							</div>
						</div>
						<div class="form-group">
							<div class="label">
								<label for="shop[address]">地址</label>
							</div>
							<div class="field">
								<input type="text" class="input" id="shop[address]" name="shop[address]" size="50" placeholder="请填写店铺地址" data-validate="required:请填写你的店铺地址" />
							</div>
						</div>
						<div class="form-group">
							<div class="label">
								<label for="shop[tel]">店铺电话</label>
							</div>
							<div class="field">
								<input type="text" class="input" id="shop[tel]" name="shop[tel]" size="50" placeholder="请填写店铺电话" data-validate="required:请填写店铺电话,tel:请填写合法的电话或手机" />
							</div>
						</div>
						<div class="form-group">
							<div class="label">
								<label for="shop[introduction]">店铺简介</label>
							</div>
							<div class="field">
								<textarea class="input" id="shop[introduction]" name="shop[introduction]" rows="5" cols="50" placeholder="请填写店铺简介" data-validate="required:请填写店铺简介"></textarea>
							</div>
						</div>
						<div class="form-button">
							<button class="button bg-main" type="submit">提交</button>
							<button class="button" type="button" onclick="javascript:history.back(-1);">返回</button>
						</div>
					</form>
				</div>
			</div>
			</div>
    </body>
</html>