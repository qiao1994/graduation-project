<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<script src="__PUBLIC__/web/artDialog-master/lib/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="__PUBLIC__/web/artDialog-master/css/ui-dialog.css">
<script src="__PUBLIC__/web/artDialog-master/dist/dialog-min.js"></script>
</head>
<body>

</body>
<script type="text/javascript">
    <?php if(isset($message)) {?>
    var d = dialog({
        title: '提示',
        content: '<?php echo($message); ?>',
        okValue: '确定',
        esc:false,
        ok: function () {
            location.href = "<?php echo($jumpUrl); ?>";
        },
    });
    d.show();
    <?php }else{?>
    var d = dialog({
        title: '提示',
        content: '<?php echo($error); ?>',
        okValue: '确定',
        esc:false,
        ok: function () {
            location.href = "<?php echo($jumpUrl); ?>";
        },
    });
    d.show();
    <?php }?>

</script>
</html>