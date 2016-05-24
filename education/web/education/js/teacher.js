$(document).ready(function(){
    getCampusClassList("cid");
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
                    <input type=\'checkbox\' name=\'dicl_id#it_id#\' value=\'#it_id#\'/>\
                </td>\
                <td style="text-align:center;width:20%">#it_name#</td>\
                <td style="text-align:center;width:10%">#it_sex#</td>\
                <td style="text-align:center;width:20%">#it_start_date#</td>\
                <td style="text-align:center;width:20%">#it_tel#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:edit(\'#it_id#\')">修改</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
           
            temp = cnt.replace("#it_name#",list[key].it_name).replace("#it_sex#",list[key].it_sex).replace(/#it_id#/g,list[key].it_id).replace("#it_start_date#",list[key].it_start_date).replace("#it_tel#",list[key].it_tel);
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
    document.location.href="index.php?r=/education&page=teacher/edit&id="+id;
}
function add(){
    document.location.href="index.php?r=/education&page=teacher/add";
}

function getCampusClassList(selId){
    //请求教师班级列表
    var url1 = "index.php?r=/education/info-class/classes1";
    $.ajax({
        type: "post",
        url: url1,
        dataType: "json",
        async:false,

        success: function(data) {
            // var classNums = document.getElementById("icl_id");
            var classNums = $("#"+selId);
            var s = data.s;
            if (s == 1) {
                var list = data.data;
                classNums.append("<option value='0' selected>选择班级</option>");
                for(key in list)
                {
                    var id = list[key].icl_id;
                    var value = list[key].icl_number;

                    // alert("获取班主任班级数据成功"+id + value + "<option value='" + id + "' selected>" + value + "</option>");
                    // classNums.append("<option value='1508'>1508</option>");
                    classNums.append("<option value='" + id + "'>" + value + "</option>");
                }

                classNums.select2();
            }else
            {
                alert("获取班主任班级数据错误"+data);
            };
            //classes info == " + data + "length == " + data.length);
        },
        error: function(data) {
            alert("错误信息"+data);
        }
    });
}
function delChecked(){
    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/teacher/deletes",
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
        var classForm = $('#classForm');
        classForm.ajaxSubmit(options);
        return false;
    });

}