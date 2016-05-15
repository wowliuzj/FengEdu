$(document).ready(function(){
    getAllClassList("cid");
    var formObj = $('#formId');
    formObj.validate();
    var options = {
            success:showResponse,
            resetForm: true,  
            dataType:  'json' 
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
           alert("添加成功");
            window.location.href = "index.php?r=/education&page=outline/index";
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
        }
    }

    formObj.submit(function() {
        $(this).ajaxSubmit(options);
        return false; 
    });
});

