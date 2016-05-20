$(document).ready(function(){

    getExamList();
    delChecked();
});


function getExamList()
{
    var url1 = "index.php?r=/education/exam/list";
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json",

        success: function(datas) {
            var msg_body = $("#msg_body");
            msg_body.empty();
            var data = datas.data;
            var cnt = "<tr>\
                <td>\
                 <input type=\'checkbox\' name=\'dicl_id#id#\' value=\'#id#\'/>\
                 </td>\
                 <td style='text-align:center'>#name#</td>\
                <td style='text-align:center'>#title#</td>\
                 <td style='text-align:center'>#time#</td>\
                  <td style='text-align:center'>#desc#</td>\
                   </tr>";
            for (key in data)
            {
                temp = cnt.replace(/#id#/g,data[key].id).replace("#name#",data[key].classNumber).replace("#title#",data[key].title).replace("#time#",data[key].time).replace("#desc#",data[key].desc);
                msg_body.append(temp);
            }
        },
        error: function(data) {
            alert("错误信息"+data.data);
        }
    })
}
function delChecked(){


    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/exam/deletes",
        resetForm: false,
        dataType:  'json'
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
            alert("删除成功");
            getExamList();
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