$(document).ready(function(){
    var formObj = $('#formId');
    formObj.validate();
    var options = {
            success:showResponse,
            resetForm: true,  
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
