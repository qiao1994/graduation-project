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
                        <label>审核状态</label>
                    </div>
                    <div class="field">
                        <select class="input" name="state" id="state">
                            <option value="1" <?php if($goods['state'] == 1): ?>selected="selected"<?php endif; ?>>审核通过</option>
                            <option value="0" <?php if($goods['state'] == 0): ?>selected="selected"<?php endif; ?>>未审核</option>
                        </select> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>是否推荐</label>
                    </div>
                    <div class="field">
                        <select class="input" name="recommend" id="recommend">
                            <option value="1" <?php if($goods['recommend'] == 1): ?>selected="selected"<?php endif; ?>>推荐</option>
                            <option value="0" <?php if($goods['recommend'] == 0): ?>selected="selected"<?php endif; ?>>不推荐</option>
                        </select> 
                    </div>
                </div>                
                <div class="form-group">
                    <div class="label">
                        <label for="sale_state">销售状态</label>
                    </div>
                    <div class="field">
                        <select class="input" name="sale_state" id="sale_state">
                            <option value="1" <?php if($goods['sale_state'] == 1): ?>selected="selected"<?php endif; ?>>正在销售</option>
                            <option value="0" <?php if($goods['sale_state'] == 0): ?>selected="selected"<?php endif; ?>>暂停销售</option>
                        </select>                    
                    </div>
                </div>                
                <div class="form-group">
                    <div class="label">
                        <label for="name">菜品名称</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="name" name="name" size="50" placeholder="菜品名称" data-validate="required:请填写你的菜品名称" value="<?php echo ($goods['name']); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="univalent">菜品单价</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="univalent" name="univalent" size="50" placeholder="菜品单价" data-validate="required:请填写你的菜品单价" value="<?php echo ($goods['univalent']); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="serial">菜品顺序</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="serial" name="serial" size="50" placeholder="菜品顺序" data-validate="required:请填写你的菜品顺序" value="<?php echo ($goods['serial']); ?>"/>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="label">
                        <label for="introduction">菜品简介</label>
                    </div>
                    <div class="field">
                        <input type="text" class="input" id="introduction" name="introduction" size="50" placeholder="菜品简介" data-validate="required:请填写你的菜品简介" value="<?php echo ($goods['introduction']); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="details">菜品详情</label>
                    </div>
                    <div class="field">
                        <textarea rows="5" id="details" name="details" cols="50" placeholder="请填写菜品详情" data-validate="required:请填写菜品详情"><?php echo ($goods['details']); ?></textarea>
                        <script type="text/javascript">var editor = UE.getEditor('details');</script>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="img">首页图片</label>
                    </div>
                    <div class="field">
                        <img src="/Public/web/images/goods/<?php echo ($goods['img']); ?>" style="width:160px;height:160px;margin-right:10px;" />
                        <a class="button input-file bg-green" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="img"/></a>
                        <div class="input-note">
                            首页预览图片，分辨率160*160
                        </div>
                    </div>
                </div>                
                <div class="form-group">
                    <div class="label">
                        <label for="banner">横幅图片</label>
                    </div>
                    <div class="field">
                        <img src="/Public/web/images/goods_banner/<?php echo ($goods['banner']); ?>" style="width:260px;height:100px;margin-right:10px;" />
                        <a class="button input-file bg-green" href="javascript:void(0);">+ 浏览文件<input size="100" type="file" name="banner"/></a>
                        <div class="input-note">
                            详情页横幅图片，分辨率260*100
                        </div>
                    </div>
                </div>                
                <div class="form-button">
                    <input type="hidden" class="input" id="id" name="id" value="<?php echo ($goods['id']); ?>" />
                    <button class="button bg-main" type="submit">提交</button>
                    <button class="button" onclick="javascript:history.back(-1);" type="button">返回</button>
                </div>
            </form>
        </div>
    </body>
</html>