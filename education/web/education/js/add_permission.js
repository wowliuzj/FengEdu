$(document).ready(function(){
    var id = $.getUrlVar('id');
    $("#r_id").val(id);
    var url1 = "index.php?r=/education/permission/other&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        success: function(list) {
            var data_body = $("#data_body");
            var cnt = data_body.html();
            data_body.empty();
            for (key in list)
            {
                temp = cnt.replace("#alias#",list[key].p_alias).replace("#p_name#",list[key].p_name).replace("#p_id_value#",list[key].p_id).replace("#p_id#","p_id"+key).replace("#checkbox#","checkbox");
                data_body.append(temp);
            }
            $.uniform.update();
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
            alert("添加成功");
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
        }
    }
    formObj.submit(function() {
        $(this).ajaxSubmit(options);
        return false; 
    });
});
