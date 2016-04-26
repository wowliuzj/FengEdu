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

//企业信息查询
function getArticle(){
    var url1 = "index.php?r=/education/article/index";
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        async:false,
        
        success: function(response) {
            if (response.s == 1) {
                // var data = response.data;
                // var a = $("#a-admin-campus-homework-1-1");
                // a.text(data.title+"     "+data.time);

                // var div = $("#div-admin-campus-homework-1-1");
                // div.empty();

                // var divCnt = $("<img src='"+data.img+"' alt=''/>\
                //                 <h5>"+data.desc+"</h5>\
                //                 <hr/>\
                //                 ");                 

                // div.append(divCnt);
                
            }else
            {
                alert("数据错误"+data);
            }
        },
        error: function(data) {
            alert("错误信息"+data);
        },
    })
}