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
                <li data-href="seller.html" class="ui-border-r"><a href="/Home/Index/shop"><i class="ui-icon-hall"></i></a></li>
                <li data-href="user.html"><a href="/Home/Index/user"><i class="ui-icon-personal"></i></a></li>
            </ul>
        </footer>
        <section class="ui-container">
    <input type="hidden" id="controller" value="/Home/Index">

    <script src="/Public/wap/js/goods.js"></script>
    <!-- 购买 -->
    <div class="ui-form ui-border-t">
        <form method="post" action="">
            <input name="id" id="id" type="hidden" value="<?php echo ($goods['id']); ?>" />
            <input id="univalent" type="hidden" value="<?php echo ($goods['univalent']); ?>" />
            <div class="ui-form-item ui-form-item-show ui-border-b">
                <label for="#">菜品名称</label>
                <input type="text" value="<?php echo ($goods['name']); ?>" readonly>
            </div>
            <div class="ui-form-item ui-form-item-show ui-border-b">
                <label for="#">单价</label>
                <input type="text"  value="￥ <?php echo ($goods['univalent']); ?>" readonly>
            </div>
            <div class="ui-form-item ui-border-b">
                <label>购买数量</label>
                <div class="ui-select">
                    <select id="number" name="number" class="buy-number">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="ui-form-item ui-form-item-show ui-border-b">
                <label for="#">总金额</label>
                <input type="text" id="amount" value="￥ <?php echo ($goods['univalent']); ?>" readonly>
            </div>
            <div class="ui-form-item ui-form-item-show ui-border-b">
                <label for="#">备注</label>
                <input type="text" id="remark" name="remark">
            </div>
            <div class="ui-btn-group" style="margin-top:20px">
                <button class="ui-btn-lg ui-btn-primary" type="submit" onclick="{if(confirm('确认购买?')){return true;}return false;}">
                    提交
                </button>
                <button class="ui-btn-lg" type="button" onclick="javascript:history.go(-1);" >
                    返回
                </button>
            </div>
        </form>
    </div>
        </section>
    </body>
</html>