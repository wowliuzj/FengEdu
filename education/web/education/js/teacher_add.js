$(document).ready(function(){
    getSchoolList("campus_id");
    var formObj = $('#formId');
    var isValidate = false;
    formObj.validate({
        submitHandler:function(form){
            isValidate = true;
        }    
    });
    var options = {
            success:showResponse,
            resetForm: false,  
            dataType:  'json' 
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
           alert("添加成功");
          document.getElementById("formId").reset();
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
