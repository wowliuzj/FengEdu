$(document).ready(function(){
    var url1 = "index.php?r=/education/role/index";
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        success: function(data) {
            var list = data.data;
            var data_body = $("#data_body");
            var cnt = data_body.html();
            data_body.empty();
            for (key in list)
            {
                temp = cnt.replace("#name#",list[key].r_name).replace("#id#",list[key].r_id);
                data_body.append(temp);
            }
        },
        error: function(data) {}
    });


});
function mod(id){
    document.location.href="index.php?r=/education&page=access/permission&id="+id;
}