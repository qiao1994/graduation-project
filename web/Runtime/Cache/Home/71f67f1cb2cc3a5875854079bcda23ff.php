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
                                <li class="<?php echo ($header['goods_create']); ?>"><a href="/Home/Seller/goodsCreate">新增菜品</a></li>
                            </ul>   
                        </li>
                        <li><a href="#" class="icon-user"> 会员</a></li>
                        <li><a href="#" class="icon-file"> 文件</a></li>
                        <li><a href="#" class="icon-th-list"> 栏目</a></li>
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
            <form method="post" class="form-x" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="label">
                        <label for="sale_state">销售状态</label>
                    </div>
                    <div class="field">
                        <select class="input" name="sale_state" id="sale_state">
                            <option value="1">正在销售</option>
                            <option value="0">暂停销售</option>
                        </select>                    
                    </div>
                </div>                
                <div class="form-group">
                    <div class="label">
                        <label for="name">菜品名称</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="name" name="name" size="50" placeholder="菜品名称" data-validate="required:请填写你的菜品名称"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="univalent">菜品单价</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="univalent" name="univalent" size="50" placeholder="菜品单价" data-validate="required:请填写你的菜品单价"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="serial">菜品顺序</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="serial" name="serial" size="50" placeholder="菜品顺序" data-validate="required:请填写你的菜品顺序"/>
                    </div>
                </div>                
                <div class="form-group">
                    <div class="label">
                        <label for="introduction">菜品简介</label>
                    </div>
                    <div class="field">
                        <textarea rows="5" id="introduction" name="introduction" cols="50" placeholder="请填写菜品简介" data-validate="required:请填写菜品简介"></textarea>
                        <script type="text/javascript">var editor = UE.getEditor('introduction');</script>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="img">首页图片</label>
                    </div>
                    <div class="field">
                        <a class="button input-file bg-green" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="img" validate="required:请选择首页图片"/></a>
                        <div class="input-note">
                            首页图片，分辨率160*160
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="banner">横幅图片</label>
                    </div>
                    <div class="field">
                        <a class="button input-file bg-green" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="banner" validate="required:请选择横幅图片"/></a>
                        <div class="input-note">
                            详情页横幅图片，分辨率260*100
                        </div>
                    </div>
                </div>
                <div class="form-button">
                    <button class="button bg-main" type="submit">提交</button>
                    <button class="button" onclick="javascript:history.back(-1);" type="button">返回</button>
                </div>
            </form>
        </div>
    </body>
</html>