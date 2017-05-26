$(document).ready(function(){
    var category_id = $.getUrlVar('category_id');
    $('#category').val(category_id);
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
        var title = $("#widget-title");
        title.empty();
        data_body.empty();
        var category=' <span>'+responseText.data.title+'</span>'
        title.append(category);
        for (key in list)
        {
            var cnt = '<div class="control-group">\
                <label style="padding-left: 50px;padding-top: 20px;font-size: 16px;font-weight: bold;">'+key+'、'+list[key].title+'</label>'
            var cnt1 ='';
            if(list[key].type==2){
                cnt1 ='<br><div style="padding-left: 80px; padding-bottom: 20px;"> <textarea class="form-control" rows="3"></textarea></div>';
            }
            if(list[key].type==1){
                cnt1 ='<br><div style="padding-left: 80px; padding-bottom: 20px;font-size: 14px;">\
                   <label style="display:inline;padding-left: 20px"><input type="radio"name="'+list[key].id+'.status" value="1"  '+(list[key].option_id==1)?'checked':''+'></label>'+list[key].option1+'\
                    <label style="display:inline;padding-left: 20px"><input type="radio" name="'+list[key].id+'.status" value="2"  '+(list[key].option_id==2)?'checked':''+'></label>'+list[key].option2+'\
                    <label style="display:inline;padding-left: 20px"><input type="radio" name="'+list[key].id+'.status" value="3"  '+(list[key].option_id==3)?'checked':''+'></label>'+list[key].option3+'\
                    <label style="display:inline;padding-left: 20px"><input type="radio" name="'+list[key].id+'.status" value="4" '+(list[key].option_id==4)?'checked':''+'></label>'+list[key].option4+'\
                    <label style="display:inline;padding-left: 20px"><input type="radio" name="'+list[key].id+'.status" value="5" '+(list[key].option_id==5)?'checked':''+'></label>'+list[key].option5+'\
                    </div>';
            }
            var cnt2 ='</div>\
            </div>';
            temp = cnt+cnt1+cnt2;
            data_body.append(temp);
        }
        
    }else{
        $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
    }
}
function search(){
    var formObj = $('#formId');
    formObj.ajaxSubmit(options);
}

function backHref(){
    document.location.href='index.php?r=/education&page=question/index';
}

