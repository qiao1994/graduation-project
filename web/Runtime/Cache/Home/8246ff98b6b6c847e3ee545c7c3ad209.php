<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="renderer" content="webkit">
		<title><?php echo ($system['name']); ?>-管理员登录</title>
		<link rel="stylesheet" href="/Public/web/admin/pintuer/pintuer.css">
		<link rel="stylesheet" href="/Public/web/admin/css/admin.css">
		<script src="/Public/web/admin/pintuer/jquery.js"></script>
		<script src="/Public/web/admin/pintuer/pintuer.js"></script>
		<script src="/Public/web/admin/js/admin.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="line">
				<div class="xs6 xm4 xs3-move xm4-move">
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<form method="post">
						<div class="panel">
							<div class="panel-head"><strong>登录<?php echo ($system['name']); ?>后台管理系统</strong></div>
							<div class="panel-body" style="padding:30px;">
								<div class="form-group">
									<div class="field field-icon-right">
										<input type="text" class="input" name="username" placeholder="登录账号" data-validate="required:请填写账号,length#>=5:账号长度不符合要求" />
										<span class="icon icon-user"></span>
									</div>
								</div>
								<div class="form-group">
									<div class="field field-icon-right">
										<input type="password" class="input" name="password" placeholder="登录密码" data-validate="required:请填写密码,length#>=6:密码长度不符合要求" />
										<span class="icon icon-key"></span>
									</div>
								</div>
							</div>
							<div class="panel-foot text-center">
								<button class="button button-block bg-main text-big">立即登录后台</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>