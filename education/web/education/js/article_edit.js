$(document).ready(function(){
    var id = $.getUrlVar('id');
    $("#id").val(id);
    var url1 = "index.php?r=/education/article/view&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        success: function(data) {
           fillFormData(data.data);
        },
        error: function(data) {}
    });



    var formObj = $('#formId');
     var options = {
        success:showResponse,  //处理完成 
        resetForm: false,  
        dataType:  'json' 
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
            alert("修改成功");
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
        }
    }
    formObj.submit(function() {
        $(this).ajaxSubmit(options);
        return false; 
    });
});
