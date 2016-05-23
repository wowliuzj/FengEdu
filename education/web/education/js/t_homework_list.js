$(document).ready(function(){
    var clid = $.getUrlVar('clid');
    var course_id = $.getUrlVar('course_id');
    $("#clid").val(clid);
    $("#course_id").val(course_id);
    getHomeWorkByCourseList();
    delChecked();
});

var homeWorkFormObj = $('#homeworkId');
var options = {
    success:showHomeWorkResponse,  //处理完成
    resetForm: false,
    dataType:  'json'
};
function showHomeWorkResponse(responseText, statusText)  {
    if(responseText.s == 1){
        var list = responseText.data;
        var data_body = $("#data_body");
        var cnt = '<tr>\
                <td>\
                    <input type=\'checkbox\' name=\'dicl_id#id#\' value=\'#id#\'/>\
                </td>\
                <td style="text-align:center">#name#</td>\
                <td style="text-align:center">#time#</td>\
                <td style="text-align:center">#desc#</td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace(/#id#/g,list[key].id).replace("#name#",list[key].title).replace("#time#",list[key].finish_time).replace("#desc#",list[key].desc);
            data_body.append(temp);
        }
      /*  pageSearch(search,responseText.data.pageNo);*/
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
function delChecked(){

    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/homework/del",
        resetForm: false,
        dataType:  'json'
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
            alert("删除成功");
            getHomeWorkByCourseList();
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

