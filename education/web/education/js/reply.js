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
                <td style="text-align:center;width:30%">#title#</td>\
                <td style="text-align:center;width:30%">#type#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:edit(\'#id#\')">修改</button>\
                </td>\
               </tr>';
        data_body.empty();
        var types = {1:"企业介绍",2:"项目信息",3:"实习岗位",4:"就业岗位"};
        for (key in list)
        {
           
            temp = cnt.replace("#title#",list[key].title).replace("#type#",types[list[key].type]).replace("#id#",list[key].id);
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
    document.location.href="index.php?r=/education&page=article/edit&id="+id;
}
function add(){
    document.location.href="index.php?r=/education&page=article/add";
}
function dels(){
    
}