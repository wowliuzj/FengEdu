$(document).ready(function(){
    getClassList("cid");
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
                    <input type=\'checkbox\' name=\'dicl_id#shid#\' value=\'#shid#\'/>\
                </td>\
                <td style="text-align:center;width:30%">#title#</td>\
                <td style="text-align:center;width:10%">#icl_number#</td>\
                <td style="text-align:center;width:10%">#is_name#</td>\
                <td style="text-align:center;width:15%">#time#</td>\
                <td style="text-align:center;width:15%">#stime#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:edit(\'#shid#\')">批改</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace("#title#",list[key].title).replace("#icl_number#",list[key].icl_number).replace("#is_name#",list[key].is_name).replace("#time#",list[key].time).replace("#stime#",list[key].stime).replace(/#shid#/g,list[key].shid);
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
    document.location.href="index.php?r=/education&page=homework/sedit&id="+id;
}
//删除选中
function delChecked(){

    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/homework/deletes",
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