$(document).ready(function(){
    var id = $.getUrlVar('id');
    $("#category").val(id);
    var data='';
    var url1 = "index.php?r=/education/questionnaire/view&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json",
        success: function(responseText, statusText) {
            if(responseText.s == 1){
                var list = responseText.data.list;
                data=list;
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
                        cnt1 ='<br><div style="padding-left: 80px; padding-bottom: 20px;"> <textarea class="form-control" name="'+list[key].id+'.text" rows="3"></textarea></div>';
                    }
                    if(list[key].type==1){
                        cnt1 ='<br><div style="padding-left: 80px; padding-bottom: 20px;font-size: 14px;">\
                    <label style="display:inline;padding-left: 20px"><input type="radio"name="'+list[key].id+'.status" value="1" ></label>'+list[key].option1+'\
                    <label style="display:inline;padding-left: 20px"><input type="radio" name="'+list[key].id+'.status" value="2"  ></label>'+list[key].option2+'\
                    <label style="display:inline;padding-left: 20px"><input type="radio" name="'+list[key].id+'.status" value="3"  ></label>'+list[key].option3+'\
                    <label style="display:inline;padding-left: 20px"><input type="radio" name="'+list[key].id+'.status" value="4" ></label>'+list[key].option4+'\
                    <label style="display:inline;padding-left: 20px"><input type="radio" name="'+list[key].id+'.status" value="5" ></label>'+list[key].option5+'\
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
        },
        error: function(data) {}
    });

    var formObj = $('#formId');
     var options = {
        success:showResponse,  //处理完成 
        resetForm: false,  
        dataType:  'json' 
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){
            alert("修改成功");
            document.location.href="index.php?r=/education&page=answer/index";
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
        }
    }
    formObj.submit(function() {
        /*for (key in data) {
            $("input[name="+list[key].id+"'.status']:checked").val();
        }
        $("input[type='radio']:checked").val();*/
        $(this).ajaxSubmit(options);
        return false; 
    });

});
