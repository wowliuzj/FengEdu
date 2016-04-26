$(document).ready(function(){
    var id = $.getUrlVar('id');
    var url1 = "index.php?r=/education/permission/index-id&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        success: function(list) {
            var data_body = $("#data_body");
            var cnt = data_body.html();
            data_body.empty();
            for (key in list)
            {
                temp = cnt.replace("#name#",list[key].r_name).replace("#id#",list[key].r_id).replace("#alias#",list[key].p_alias);
                data_body.append(temp);
            }
        },
        error: function(data) {}
    });

});
function add(){
    var id = $.getUrlVar('id');
    document.location.href="index.php?r=/education&page=access/add_permission&id="+id;
}