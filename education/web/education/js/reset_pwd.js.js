$(document).ready(function(){
    var id = $.getUrlVar('id');
    $("#a_id").val(id);

    var formObj = $('#formId');
    var options = {
            success:showResponse,  //处理完成 
            resetForm: false,  
            dataType:  'json' 
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
           alert("重置密码成功");
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
        }
    }

    formObj.submit(function() {
        $(this).ajaxSubmit(options);
        return false; 
    });
});
