$(document).ready(function(){
    var id = $.getUrlVar('id');
    $("#id").val(id);
    var url1 = "index.php?r=/education/stu-work/view&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        success: function(data) {
            var data1 = data.data;
            $("#img").attr("src",data1.img);
            $("#desc").append(data1.desc);

            $("#simg").attr("src",data1.simg);        
            $("#sdesc").append(data1.sdesc);
        },
        error: function(data) {}
    });


    function showData(data){
        var title = data.title;
        var time = data.time;
        var desc = data.desc;
    }



    var formObj = $('#formId');
     var options = {
        success:showResponse,  //处理完成 
        resetForm: true,  
        dataType:  'json' 
    };
    var isValidate = false;
    formObj.validate({
        submitHandler:function(form){
            isValidate = true;
        }    
    });
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
            alert("批改完成");
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
