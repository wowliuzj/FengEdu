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
                <td style="text-align:center;width:20%">#title#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:view(\'#it_id#\')">查看</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
           
            temp = cnt.replace("#title#",list[key].title).replace("#it_sex#",list[key].it_sex).replace(/#it_id#/g,list[key].id).replace("#it_start_date#",list[key].it_start_date).replace("#it_tel#",list[key].it_tel);
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
    document.location.href="index.php?r=/education&page=answer/check&id="+id;
}
function view(id){
    alert(111);
    var url1 = "index.php?r=/education/answer/check&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json",
        success: function(responseText, statusText) {
            var s = responseText.s;
            alert(s);
            var user_id =  responseText.data.user_id;
            if (s == 1) {
                document.location.href="index.php?r=/education&page=question/answer_show&category_id="+id+"&user_id="+user_id;
            }
            else if(s == 2){
                document.location.href="index.php?r=/education&page=answer/tindex&id="+id;
            }else{
                $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
            }
        },
        error: function(data) {}
    });
}
function add(){
    document.location.href="index.php?r=/education&page=question/add";
}

