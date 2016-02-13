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
                                <li><a href="/Home/Seller/shop">店铺信息</a></li>
                                <li><a href="/Home/Seller/goods">菜品管理</a></li>
                                <li><a href="/Home/Seller/order">订单管理</a></li>
                                <li><a href="/Home/Seller/statistics">数据统计</a></li>
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
		<div class="admin">
			<div class="line-big">
				<div class="xm3">
					<div class="panel border-back">
						<div class="panel-body text-center">
							<img src="/Public/web/admin/images/admin.png" width="120" class="radius-circle" />
							<br /> <?php echo ($seller['username']); ?>
						</div>
						<div class="panel-foot bg-back border-back">您好，<?php echo ($seller['username']); ?>，欢迎您来到商家管理系统。</div>
					</div>
					<br />
					<div class="panel">
						<div class="panel-head"><strong>店铺统计</strong></div>
						<ul class="list-group">
							<li>
							<span class="float-right badge bg-grey "><?php echo ($statisticsData['goodsNumber']); ?></span><span class="icon-shopping-cart"></span> 菜品
							</li>
							<li><span class="float-right badge bg-green"><?php echo ($statisticsData['orderNumber']); ?></span><span class="icon-bars"></span> 订单数量</li>
							<li><span class="float-right badge bg-red"><?php echo ($statisticsData['toHandleOrderNumber']); ?></span><span class="icon-bars"></span> 待处理订单</li>	
							<li><span class="float-right badge bg-main"><?php echo ($statisticsData['toFinishOrderNumber']); ?></span><span class="icon-bars"></span> 未完成订单</li>
						</ul>
					</div>
					<br />
				</div>
				<div class="xm9">
					<div class="alert">
						<h1><?php echo ($shop['name']); ?></h1>
						<p class="text-gray padding-top">
							<?php echo ($shop['details']); ?>
						</p>
					</div>
				</div>
			</div>
			<br />
		</div>