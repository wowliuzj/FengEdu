$(document).ready(function(){
    getTitleList();
    var id = $.getUrlVar('id');
    $('#category').val(id);
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
            var id=responseText.data;
            document.location.href="index.php?r=/education&page=questionnaire/add&id="+id;
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
        }
    }

    formObj.submit(function() {
        $(this).ajaxSubmit(options);
        return false;
    });
});
function getTitleList(){
    //请求教师班级列表
    var url1 = "index.php?r=/education/option/title";
    $.ajax({
        type: "post",
        url: url1,
        dataType: "json",
        async:false,

        success: function(data) {
            // var classNums = document.getElementById("icl_id");
            var option = $("#option");
            var s = data.s;
            if (s == 1) {
                var list = data.data;
                option.append("<option value='0' selected>选择选项类型</option>");
                for(key in list)
                {
                    var id = list[key].id;
                    var value = list[key].title;

                    // alert("获取班主任班级数据成功"+id + value + "<option value='" + id + "' selected>" + value + "</option>");
                    // classNums.append("<option value='1508'>1508</option>");
                    option.append("<option value='" + id + "'>" + value + "</option>");
                }

               // classNums.select2();
            }else
            {
                alert("获取数据错误"+data);
            };
            //classes info == " + data + "length == " + data.length);
        },
        error: function(data) {
            alert("错误信息"+data);
        }
    });
}