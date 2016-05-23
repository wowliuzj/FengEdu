$(document).ready(function(){
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
                <td style="text-align:center;width:30%">#name#</td>\
                <td style="text-align:center;width:30%">#phone#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:reset_pwd(\'#id#\')">重置密码</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace("#name#",list[key].aname).replace(/#id#/g,list[key].a_id).replace("#phone#",list[key].phone);
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

function reset_pwd(id){
    document.location.href="index.php?r=/education&page=admin/reset_pwd&id="+id;
}

//删除选中
function delChecked(){

    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/admin/deletes",
        resetForm: false,
        dataType:  'json',
        type: "post"
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
        var selForm = $('#selForm');
        selForm.ajaxSubmit(options);
        return false;
    });
}