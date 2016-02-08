$(document).ready(function(){
    //点击x清除input内容
    $('.ui-icon-close').click(function(){
        if($(this).attr('input-id')) {
            var inputId = $(this).attr('input-id');
            $('#'+inputId).val('');
        }
    });
});