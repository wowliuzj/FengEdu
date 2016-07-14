$(document).ready(function(){
/////////////////////////////////
//总部管理端
///////////////////////////////////作业情况
    getInfoSchoolList();

//添加校区
    var admin_hq_campus_query_form = $("#admin-school-query-form");
    admin_hq_campus_query_form.validate();
    var admin_hq_campus_query_options = {
        success:adminHqCampusQueryShowResponse,
        resetForm: true,
        dataType:  'json'
    };
    function adminHqCampusQueryShowResponse(responseText, statusText)  {
        if(responseText.s == 1){
            alert("操作成功");
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
        }
    }

    admin_hq_campus_query_form.submit(function() {
        $(this).ajaxSubmit(admin_hq_campus_query_options);
        return false;
    });

});
function changeSchool(){

}
//作业情况
//作业布置情况
//跳转到详细

//活动情况
//跳转到详细


//添加校区
function jumpAdminAddSchool(){		
	document.location.href='index.php?r=/education&page=admin/school/index_1_1';
}

//获取校区列表
function getInfoSchoolList(){
    var url1 = "index.php?r=/education/info-school/index";
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        async:false,
        
        success: function(response) {
            if (response.s == 1) {
            	var data = response.data.list;

			  	var tbody = $("#data_body");
				tbody.empty();

				for(var key in data){
					var trCnt = $("<tr class='gradeA'>\
										<td style='text-align:center'>"+data[key].is_name+"</td>\
										<td style='text-align:center'>"+data[key].is_address+"</td>\
										<td style='text-align:center'>"+data[key].is_tel+"</td>\
										<td style='text-align:center'>\
											<input type='hidden' desc='id' id='course_id"+key+"' value='"+data[key].is_id+"'/>\
											<span><input style='margin-top:5px;' type='button' value='修改详情' onclick='jumpAdminModifySchool("+data[key].is_id+")'/></span>\
										</td>\
									</tr>");
					tbody.append(trCnt);									
				}

				pageSearch(getInfoSchoolList, response.data.pageNo);

            }else
            {
                alert("数据错误"+data);
            }
        },
        error: function(data) {
            alert("错误信息"+data);
        }
    })
}
//跳转添加校区修改
function jumpAdminModifySchool(id){
	var param = "";
	if(id != null){
		param = "&is_id="+id;
	}
	document.location.href='index.php?r=/education&page=admin/school/index_1_2'+param;


}
//获取校区修改信息
function getInfoschoolData(){
	var id = $.getUrlVar("is_id");
    var url1 = "index.php?r=/education/info-school/index&is_id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        async:false,
        
        success: function(response) {
            if (response.s == 1) {
            	var data = response.data.list;
            	var is_name = $("#is_name");
            	var is_tel = $("#is_tel");
                var is_address = $("#is_address");
            	is_name.val(data[0].is_name);
            	is_tel.val(data[0].is_tel);
                is_address.val(data[0].is_address);
				$("#is_id").val(id);
            }else
            {
                alert("数据错误"+data);
            }
        },
        error: function(data) {
            alert("错误信息"+data);
        }
    })
}

