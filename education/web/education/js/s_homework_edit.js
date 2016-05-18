$(document).ready(function(){
    loadHomeWork();


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
            loadHomeWork();
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


function loadHomeWork() {
    var id = $.getUrlVar('id');
    $("#id").val(id);
    var url1 = "index.php?r=/education/stu-work/view&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json",
        success: function(data) {
            var data1 = data.data;
            $("#img").attr("src",data1.model.img);
            $("#desc").append(data1.model.desc);
            $("#is_name").append(data1.model.is_name);

            //$("#simg").attr("src",data1.simg);
            $("#sdesc").append(data1.model.sdesc);
            var div_1_cnt = "";
            if(data1.uploadList.length>0) {
                for(var i=0;i<data1.uploadList.length;i++) {
                    if(data1.uploadList[i].img_file)
                        div_1_cnt += "<img width='100px' src='/uploads/"+data1.uploadList[i].file+"' alt='' style='padding: 5px 10px 15px 0;'/>";
                    else
                        div_1_cnt += "<a href='/uploads/"+data1.uploadList[i].file+"' alt='' style='padding: 5px 10px 15px 0;' target='_blank'><img src='/img/006.png' title='下载' /></a>";
                }
                $("#uploadListPanel").append(div_1_cnt);
            }

            if(data1.model.score) {
                $("#score").val(data1.model.score);
            }

            if(data1.model.tdesc) {
                $("#tdesc").val(data1.model.tdesc);
            }
        },
        error: function(data) {}
    });
}