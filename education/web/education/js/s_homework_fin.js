$(document).ready(function(){
    getClassList("cid");
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
                <td style="text-align:center;">#title#</td>\
                <td style="text-align:center;">#icl_number#</td>\
                <td style="text-align:center;">\
                <span class="icon24 icomoon-icon-arrow-up-2 green">#fin#%</span>\
                   <div class="progress progress-danger progress-striped ">\
                  <div style="width: #fin#%;" class="bar"></div>\
                </div></td>\
               </tr>';
               // <span class="pull-right strong">#finCount#</span>\
        data_body.empty();
        for (key in list)
        {
            temp = cnt.replace("#title#",list[key].title).replace("#icl_number#",list[key].icl_number).replace("#fin#",list[key].fin).replace("#fin#",list[key].fin).replace("#finCount#",list[key].finCount);
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
