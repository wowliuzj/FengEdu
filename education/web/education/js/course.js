$(document).ready(function(){
    var id = $.getUrlVar('id');
    $("#outline_id").val(id);
    search();
    delChecked();
});

var formObj = $('#formId');
var options = {
        success:showResponse,  //处理完成 
        resetForm: false,  
        dataType:  'json' 
};
function showResponse(responseText, statusText)  {
    if(responseText.s == 1){
        var list = responseText.data.list;
        var data_body = $("#data_body");
        var cnt = '<tr>\
                <td>\
                    <input type=\'checkbox\' name=\'did#id#\' value=\'#id#\'/>\
                </td>\
                <td style="text-align:center">#name#</td>\
                <td style="text-align:center">#cnt#</td>\
                <td style="text-align:center">#num#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:edit(\'#id#\')">修改</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace("#name#",list[key].name).replace("#cnt#",list[key].cnt).replace("#num#",list[key].num).replace(/#id#/g,list[key].id);
            data_body.append(temp);
        }
        pageSearch(search,responseText.data.pageNo);
    }else{
        $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
    }
}
function search(){
    var formObj = $('#formId');
    formObj.ajaxSubmit(options);
}

function buttonClickSearch(){
     $("#page").val(1);
     search();
}

function edit(id){
    document.location.href="index.php?r=/education&page=course/edit&id="+id;
}

//学生端
//获取学习课程进度
function getStudyPlan(){
    var url1 = "index.php?r=/education/course/tongji";
    $.ajax({
        type:"get",
        url:url1,
        dataType:"json",

        success:function(response){
            if(response.s == 1){
                var data = response.data.list;
                var tbody = $("#student_list_tbody_id");
                tbody.empty();

                if(data.length == 0){
                    alert("没有数据");
                    return;
                }

                for(var key in data){
                    var teachRate = data[key].teachRate;
                    if(teachRate > 0){
                        teachRate = teachRate + "%";
                    }
                    var trCnt = $("<tr class='gradeA'>\
                                        <td style='text-align:center'>"+data[key].name+"</td>\
                                        <td style='text-align:center'>"+data[key].it_name+"</td>\
                                        <td style='text-align:center'>"+data[key].num+"</td>\
                                        <td style='text-align:center'>"+teachRate+"</td>\
                                    </tr>");

                    tbody.append(trCnt);
                }
                pageSearch(getStudyPlan, response.data.pageNo);
            }else{
                alert("数据错误"+response);
            }
        },
        error:function(response){
            alert("错误信息"+response);
        }
    })
}

//删除选中
function delChecked(){

    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/course/deletes",
        resetForm: false,
        dataType:  'json'
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
            alert("删除成功");
            search();
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
        }
    }
    var del_btn = $('#del_btn');
    del_btn.click(function() {
        var courseForm = $('#courseForm');
        courseForm.ajaxSubmit(options);
        return false;
    });
}