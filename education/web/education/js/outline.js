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
                    <input type=\'checkbox\' name=\'did#id#\' value=\'#id#\' />\
                </td>\
                <td style="text-align:center;width:50%">\
                <input type=\'text\' id=\'title#id#\' value=\'#title#\' readonly="readonly"/>\
                </td>\
                <td style="text-align:center;width:10%">#icl_number#</td>\
                <td style="text-align:center;width:20%">#time#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:edit(\'#id#\')">课程管理</button>\
                     <button type="button" onclick="javascript:update(\'#id#\')" id=\'update#id#\'>修改大纲</button>\
                     <button type="button" onclick="javascript:save(\'#id#\')" id=\'save#id#\'  style="display:none;">保存大纲</button>\
                </td>\
               </tr>';
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace("#title#",list[key].title).replace("#icl_number#",list[key].icl_number).replace("#time#",list[key].time).replace(/#id#/g,list[key].id);
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
    document.location.href="index.php?r=/education&page=course/index&id="+id;
}
function add(){
    document.location.href="index.php?r=/education&page=outline/add";
}
function update(id){
    $('#update'+id).hide();
    $('#save'+id).show();
    $('#title'+id).removeAttr("readonly");

}
function save(id){
    $('#save'+id).hide();
    $('#update'+id).show();
    var title=$('#title'+id).val();
    $.post("index.php?r=/education/outline/update", { id: id, title: title },
        function(data){
            $('#title'+id).attr("readonly","readonly");
            alert("修改成功 ");
        });



}

//删除选中
function delChecked(){

    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/outline/deletes",
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
        var outlineForm = $('#outlineForm');
        outlineForm.ajaxSubmit(options);
        return false;
    });
}