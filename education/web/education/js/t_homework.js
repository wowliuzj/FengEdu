$(document).ready(function(){
    search();
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
                <td style="text-align:center">#name#</td>\
                <td style="text-align:center">#cnt#</td>\
                <td style="text-align:center">#num#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:pwork(\'#cid#\',\'#course_id#\',\'#name#\')">布置作业</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace("#name#",list[key].name).replace("#cnt#",list[key].cnt).replace("#num#",list[key].num).replace("#cid#",list[key].cid).replace("#course_id#",list[key].id).replace("#name#",list[key].name);
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

function pwork(cid,course_id,name){
    //store.set("y_name",name);
    document.location.href="index.php?r=/education&page=homework/add&cid="+cid+"&course_id="+course_id;
}