$(document).ready(function(){
    search();
    delChecked();
});

function search(){
    var formObj = $('#formId');
    formObj.ajaxSubmit(options);
}

var formObj = $('#formId');
var id = $.getUrlVar('id');
var options = {
    success:showResponse,  //处理完成
    resetForm: false,
    dataType:  'json',
    url: "index.php?r=/education/permission/index-id&id="+id
};

function showResponse(responseText, statusText)  {
    if(responseText.s == 1){
        var data_body = $("#data_body");
        var cnt = data_body.html();
        data_body.empty();
        var list = responseText.data.list;
        for (key in list)
        {
            var str = '<tr>\
                            <td align="center">\
                                <input type="checkbox" name="r_p#r_id#_#p_id#" value="#r_id#_#p_id#"/>\
                            </td>\
                            <td style="text-align:center">#name#</td>\
                            <td style="text-align:center">#alias#</td>\
                        </tr>';
            str = str.replace("#name#",list[key].r_name).replace(/#r_id#_#p_id#/g,list[key].r_id + '_' + list[key].p_id).replace("#alias#",list[key].p_alias);
            data_body.append(str);
        }
    }else{
        $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
    }
}

function add(){
    var id = $.getUrlVar('id');
    document.location.href="index.php?r=/education&page=access/add_permission&id="+id;
}

function delChecked(){
    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/permission/deletes",
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
        var formId = $('#formId');
        formId.ajaxSubmit(options);
        return false;
    });
}