<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo ($system['name']); ?></title>
        <link rel="stylesheet" href="/Public/wap/frozenui-1.3.0/css/frozen.css">
        <script src="/Public/wap/frozenui-1.3.0/lib/zepto.min.js"></script>
        <script src="/Public/wap/frozenui-1.3.0/js/frozen.js"></script> 
        <script src="/Public/wap/js/jquery.min.js"></script>
        <script src="/Public/wap/js/public.js"></script>

    </head>
    <body ontouchstart>
        <?php if($header['headerFlag']): ?><header class="ui-header ui-header-positive ui-border-b">
                <i class="ui-icon-return" onclick="history.back()"></i>
                <h1><?php echo ($header['headerName']); ?></h1>
            </header><?php endif; ?>
        <footer class="ui-footer ui-footer-btn">
            <ul class="ui-tiled ui-border-t">
                <li data-href="index.html" class="ui-border-r"><a href="/Home/Index"><i class="ui-icon-home"></i></a></li>
                <li data-href="seller.html" class="ui-border-r"><a href="/Home/Index/cart"><i class="ui-icon-cart"></i></a></li>
                <li data-href="user.html"><a href="/Home/Index/user"><i class="ui-icon-personal"></i></a></li>
            </ul>
        </footer>
        <section class="ui-container">
    <input type="hidden" id="controller" value="/Home/Index">

    <script src="/Public/wap/js/cart.js"></script>

    <style type="text/css">
    .cart-title {
        font-weight: bolder;
    }
    .cart-buy-price {
        font-size: xx-large;
        text-align: right;
        margin: 0px 15px;
    }
    .cart-buy-price label {
        color: orange;
    }
    .cart-remark {
        height: 100px;

    }
    .cart-remark textarea {
        width: 100%;
        height: 100%;
    }
    </style>
    <!-- 购物车 -->
    <div class="ui-border-t">
        <ul class="ui-list ui-list-text ui-list-checkbox">
            <li class="ui-border-t cart-list">
                <label class="ui-checkbox">
                    <input type="checkbox">
                </label>
                <ul class="cart-title ui-tiled">
                    <li class="cart-item">菜品名称</li>
                    <li class="cart-item">单价</li>
                    <li class="cart-item">数量</li>
                    <li class="cart-item">总价</li>
                </ul>
            </li>
            <li class="ui-border-t cart-list">
                <label class="ui-checkbox">
                    <input type="checkbox">
                </label>
                <ul class="ui-tiled cart-list">
                    <li>菜品名称</li>
                    <li>￥28.88</li>
                    <li>
                        <div class="ui-select">
                            <select>
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                            </select>
                        </div>
                    </li>
                    <li>￥87.89</li>
                </ul>
            </li>
        </ul>
        <form action="" method="post">
            <div class="cart-buy">                    
                <div class="cart-buy-price">
                    总价 <label>￥</label> <label id="price">88.88</label>
                </div>
                <div class="ui-form-item-textarea cart-remark">
                    <textarea class="ui-border-radius" name="remark" id="remark" placeholder="请输入备注"></textarea>
                </div>
                <input type="text" id="goods" name="goods"/>
                <input type="text" id="number" name="number"/>
                <button type="submit" class="ui-btn-lg ui-btn-primary">购买</button>
            </div>
        </form>
    </div>
        </section>
    </body>
</html>