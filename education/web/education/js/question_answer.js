$(document).ready(function(){
    var id = $.getUrlVar('id');
    $('#category').val(id);
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
                <td style="text-align:center;width:20%">#title#(#name#_提交)</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:view(\'#it_id#\',\'#it_category#\')">预览</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace("#title#",list[key].title).replace("#name#",list[key].user_name).replace(/#it_id#/g,list[key].user_id).replace("#it_category#",list[key].category_id).replace("#it_tel#",list[key].it_tel);
            data_body.append(temp);
        }
       // pageSearch(search,responseText.data.pageNo);
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
function view(user_id,category_id){
    document.location.href="index.php?r=/education&page=question/answer_show&category_id="+category_id+"&user_id=1";
}
function add(){
    document.location.href="index.php?r=/education&page=question/add";
}
