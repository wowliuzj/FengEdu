$(document).ready(function(){
    var isValidate = false;
    $('#formId').validate({
        submitHandler:function(form){
            isValidate = true;
        }    
    });
    var formObj = $('#formId');
    var options = {
            success:showResponse,
            resetForm: false,  
            dataType:  'json' 
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
           alert("添加成功");
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
        }
    }

    formObj.submit(function() {
        if(isValidate){
            $(this).ajaxSubmit(options);
        }
        isValidate = false;
        return false; 
    });
});
