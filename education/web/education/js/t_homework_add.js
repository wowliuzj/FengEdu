$(document).ready(function(){
    var cid = $.getUrlVar('cid');
    var course_id = $.getUrlVar('course_id');
    $("#cid").val(cid);
    $("#course_id").val(course_id);
    $("#fileImg").click(function(){
      $('#img').trigger("click");
    });
    var formObj = $('#formId');
    formObj.validate();
    var options = {
            success:showResponse,
            resetForm: false,  
            dataType:  'json' 
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
           alert("布置作业成功");
           $("#imgHeadPhoto").attr("src","");
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
        }
    }

    formObj.submit(function() {

        if($("#finish_time").val() == '选择日期'){
            alert("选择作业完成时间");
            return false;
        }

        //if($("#desc").text() == ''){
        //    alert("作业要求不能为空");
        //    return false;
       // }
       
        $(this).ajaxSubmit(options);
        return false; 
    });
});