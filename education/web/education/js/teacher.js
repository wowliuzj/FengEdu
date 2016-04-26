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
           
            temp = cnt.replace("#it_name#",list[key].it_name).replace("#it_sex#",list[key].it_sex).replace("#it_id#",list[key].it_id).replace("#it_start_date#",list[key].it_start_date).replace("#it_tel#",list[key].it_tel);
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