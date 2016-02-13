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
            <form method="post" class="form-x" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="label">
                        <label for="name">系统名称</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="name" name="name" size="50" placeholder="系统名称" data-validate="required:请填写系统名称"  value="<?php echo ($system['name']); ?>" />
                    </div>
                </div>              
                <div class="form-group">
                    <div class="label">
                        <label for="slider[0]">滑动图片1</label>
                    </div>
                    <div class="field">
                        <img src="/Public/wap/img/Index/index/slider/<?php echo ($system['slider'][0]); ?>" style="width:260px;height:100px;margin-right:10px;" />
                        <a class="button input-file bg-green" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="slider[0]"/></a>
                        <div class="input-note">
                            详情页滑动图片1，分辨率260*100
                        </div>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="label">
                        <label for="slider[1]">滑动图片2</label>
                    </div>
                    <div class="field">
                        <img src="/Public/wap/img/Index/index/slider/<?php echo ($system['slider'][1]); ?>" style="width:260px;height:100px;margin-right:10px;" />
                        <a class="button input-file bg-green" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="slider[1]"/></a>
                        <div class="input-note">
                            详情页滑动图片1，分辨率260*100
                        </div>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="label">
                        <label for="slider[2]">滑动图片3</label>
                    </div>
                    <div class="field">
                        <img src="/Public/wap/img/Index/index/slider/<?php echo ($system['slider'][2]); ?>" style="width:260px;height:100px;margin-right:10px;" />
                        <a class="button input-file bg-green" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="slider[2]"/></a>
                        <div class="input-note">
                            详情页滑动图片1，分辨率260*100
                        </div>
                    </div>
                </div>
                <div class="form-button">
                    <input type="hidden" id="id" name="id" value="1" />
                    <button class="button bg-main" type="submit">提交</button>
                </div>
            </form>
        </div>
    </body>
</html>