$(document).ready(function(){
    search();
    delChecked();
});

var formObj = $('#formId');
var options = {
        success:showResponse,  //处理完成 
        resetForm: false,  
        dataType:  'json' 
};


                    // <nav role="navigation" class="navbar navbar-default navbar-static" id="navbar-example2">\
                    //     <div class="container-fluid">\
                    //         <div class="navbar-header">\
                    //             <button data-target=".bs-example-js-navbar-scrollspy" data-toggle="collapse" type="button" class="navbar-toggle collapsed">\
                    //                 <span class="sr-only">Toggle navigation</span>\
                    //                 <span class="icon-bar"></span>\
                    //                 <span class="icon-bar"></span>\
                    //                 <span class="icon-bar"></span>\
                    //             </button>\
                    //             <a href="#" class="navbar-brand">Project Name</a>\
                    //         </div>\
                    //         <div class="collapse navbar-collapse bs-example-js-navbar-scrollspy">\
                    //             <ul class="nav navbar-nav">\
                    //                 <li><a href="#fat">@fat</a></li>\
                    //                 <li><a href="#mdo">@mdo</a></li>\
                    //             </ul>\
                    //         </div>\
                    //     </div>\
                    // </nav>\

                    // <ul class="nav nav-pills">\
                    //     <li class="dropdown">\
                    //         <a href="##" data-toggle="dropdown" class="dropdown-toggle" role="button" id="tutorial">查看<b class="caret"></b></a>\
                    //         <ul class="dropdown-menu" role="menu" aria-labelledby="tutorial">\
                    //             <li role="presentation"><a href="##">CSS3</a></li>\
                    //             <li role="presentation"><a href="##">HTML5</a></li>\
                    //             <li role="presentation"><a href="##">Sass</a></li>\
                    //         </ul>\
                    //     </li>\
                    // </ul>\
function showResponse(responseText, statusText)  {
    if(responseText.s == 1){
        var list = responseText.data.list;
        var data_body = $("#data_body");
        var cnt = '<tr>\
                <td>\
                    <input type=\'checkbox\' name=\'dicl_id#icl_id#\' value=\'#icl_id#\'/>\
                </td>\
                <td style="text-align:center">#icl_number#</td>\
                <td style="text-align:center">#tlist#</td>\
                <td style="text-align:center">#status#</td>\
                <td style="text-align:center">\
                    <button type="button" onclick="javascript:edit(\'#icl_id#\')">修改</button>\
                </td>\
               </tr>';


        data_body.empty();
        var status = {1:"在校",2:"毕业"};
        for (key in list)
        {
            var cnt1 = '<li class="dropdown" style="list-style:none;">\
                            <a href="##" data-toggle="dropdown" class="dropdown-toggle" role="button" >查看<b class="caret"></b></a>\
                                <ul id="tlist'+ key +'" class="dropdown-menu" role="menu" aria-labelledby="tutorial">\
                                </ul>\
                        </li>';


            temp = cnt.replace("#icl_number#",list[key].icl_number).replace("#tlist#", cnt1).replace(/#icl_id#/g,list[key].icl_id).replace("#status#",status[list[key].status]);
            data_body.append(temp);

            var cnt2 = $("#tlist"+key);
            cnt2.empty();
            for(i in list[key].tlist){
                var cnt3 = $("<li role='presentation'>教学大纲："+list[key].tlist[i].title + '， 课程：' + list[key].tlist[i].cname + '， 授课教师：' + list[key].tlist[i].tname+"</li>");
                cnt2.append(cnt3);
            }

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
    document.location.href="index.php?r=/education&page=class/edit&id="+id;
}
function add(){
    document.location.href="index.php?r=/education&page=class/add";
}

//删除选中
function delChecked(){

    var options = {
        success:   showResponse,  //处理完成
        url: "index.php?r=/education/info-class/deletes",
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
        var classForm = $('#classForm');
        classForm.ajaxSubmit(options);
        return false;
    });
}