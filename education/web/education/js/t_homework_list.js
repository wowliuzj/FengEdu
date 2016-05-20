$(document).ready(function(){
    getHomeWorkByCourseList();
});

var homeWorkFormObj = $('#homeworkId');
var options = {
    success:showHomeWorkResponse,  //处理完成
    resetForm: false,
    dataType:  'json'
};
function showHomeWorkResponse(responseText, statusText)  {
    if(responseText.s == 1){
        var list = responseText.data.list;
        var data_body = $("#data_body");
        var cnt = '<tr>\
                <td style="text-align:center">#name#</td>\
                <td style="text-align:center">#time#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:pwork(\'#cid#\',\'#course_id#\',\'#name#\')">修改</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace("#name#",list[key].name).replace("#time#",list[key].cnt).replace("#num#",list[key].num).replace("#cid#",list[key].cid).replace("#course_id#",list[key].id).replace("#name#",list[key].name);
            data_body.append(temp);
        }
        pageSearch(search,responseText.data.pageNo);
    }else{
        $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
    }
}
function getHomeWorkByCourseList(){
    var homeWorkFormObj = $('#homeworkId');
    homeWorkFormObj.ajaxSubmit(options);
}

function buttonClickSearch(){
     $("#page").val(1);
    getHomeWorkByCourseList();
}

function pwork(cid,course_id,name){
    //store.set("y_name",name);
    document.location.href="index.php?r=/education&page=homework/add&cid="+cid+"&course_id="+course_id;
}

