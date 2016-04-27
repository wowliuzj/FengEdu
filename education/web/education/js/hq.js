$(document).ready(function(){
/////////////////////////////////
//总部管理端
/////////////////////////////////
//教学情况
	var admin_hq_tongji_form = $("#admin-hq-tongji-form");
	var admin_hq_tongji_options = {
		success:adminHqTongjiResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminHqTongjiResponse(responseText, statusTest){
		if(responseText.s == 1){
			var data = responseText.data.list;
			var tbody = $("#student_list_tbody_id");
			tbody.empty();

			if(data.length == 0){
				alert("没有数据");
				return;
			}

			for(var key in data){
				var teachRate = data[key].teachRate + "%";
				var compRate = data[key].compRate + "%";
				var excRate = data[key].excRate + "%";


				var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].it_name+"</td>\
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].name+"</td>\
									<td style='text-align:center'>"+teachRate+"</td>\
									<td style='text-align:center'>"+compRate+"</td>\
									<td style='text-align:center'>"+excRate+"</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_hq_tongji_form = $("#admin-hq-tongji-form");
				admin_hq_tongji_form.ajaxSubmit(admin_hq_tongji_options);
			}, responseText.data.pageNo);
		}else{

		}
	}

	admin_hq_tongji_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_hq_tongji_options);
		return false;
	});

//作业情况
//作业布置情况
	var admin_hq_homework_query_form = $("#admin-hq-homework-query-form");
	var admin_hq_homework_query_options = {
		success:adminHqHomeworkQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminHqHomeworkQueryResponse(responseText, statusTest){
		if(responseText.s == 1){
			var data = responseText.data.list;
			var tbody = $("#student_list_tbody_id");
			tbody.empty();
			for(var key in data){
				var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].it_name+"</td>\
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].name+"</td>\
									<td style='text-align:center'>"+data[key].title+"</td>\
									<td style='text-align:center'>\
										<input type='hidden' name='id' id='course_id"+key+"' value='"+data[key].course_id+"'/>\
										<span><input style='margin-top:5px;' type='button' value='详情' onclick='jumpAdminHqHomeworkQuery("+data[key].id+")'/></span>\
									</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_hq_homework_query_form = $("#admin-hq-homework-query-form");
				admin_hq_homework_query_form.ajaxSubmit(admin_hq_homework_query_options);
			}, responseText.data.pageNo);
		}else{

		}
	}

	admin_hq_homework_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_hq_homework_query_options);
		return false;
	});
//作业查看
	var admin_hq_stu_work_query_form = $("#admin-hq-stu-work-query-form");
	var admin_hq_stu_work_query_options = {
		success:adminHqStuWorkQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminHqStuWorkQueryResponse(responseText, statusTest){
		if(responseText.s == 1){
			var data = responseText.data.list;
			var tbody = $("#student_list_tbody_id");
			tbody.empty();
			for(var key in data){
				var score = data[key].score;
				if(score < 0){
					score = "未评分";
				}

				// <td style='text-align:center'>"+data[key].title+"</td>\
				var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].is_name+"</td>\
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].name+"</td>\
									<td style='text-align:center'>"+score+"</td>\
									<td style='text-align:center'>\
										<input type='hidden' name='id' id='course_id"+key+"' value='"+data[key].course_id+"'/>\
										<span><input style='margin-top:5px;' type='button' value='详情' onclick='jumpAdminHqStuWorkQuery("+data[key].id+")'/></span>\
									</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_hq_stu_work_query_form = $("#admin-hq-stu-work-query-form");
				admin_hq_stu_work_query_form.ajaxSubmit(admin_hq_stu_work_query_options);
			}, responseText.data.pageNo);
		}else{

		}		
	}

	admin_hq_stu_work_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_hq_stu_work_query_options);
		return false;
	});
//考试情况
	var admin_hq_exam_query_form = $("#admin-hq-exam-query-form");
	var admin_hq_exam_query_options = {
		success:adminHqExamQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminHqExamQueryResponse(responseText, statusTest){
		if(responseText.s == 1){
			var data = responseText.data.list;
			var tbody = $("#student_list_tbody_id");
			tbody.empty();

			if(data.length == 0){
				alert("没有数据");
				return;
			}

			for(var key in data){
				var score = data[key].score;
				if(score < 0){
					score = "未评分";
				}
				var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].is_name+"</td>\
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].name+"</td>\
									<td style='text-align:center'>"+data[key].title+"</td>\
									<td style='text-align:center'>"+score+"</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_hq_exam_query_form = $("#admin-hq-exam-query-form");
				admin_hq_exam_query_form.ajaxSubmit(admin_hq_exam_query_options);
			}, responseText.data.pageNo);
		}else{

		}	
	}

	admin_hq_exam_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_hq_exam_query_options);
		return false;
	});
//出勤情况
	var admin_hq_attent_query_form = $("#admin-hq-attent-query-form");
	var admin_hq_attent_query_options = {
		success:adminHqAttentQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminHqAttentQueryResponse(responseText, statusTest){
		if(responseText.s == 1){
			var data = responseText.data.list;
			var tbody = $("#student_list_tbody_id");
			tbody.empty();
			
			if(data.length == 0){
				alert("没有数据");
				return;
			}

			for(var key in data){

				var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].is_name+"</td>\
									<td style='text-align:center'>"+data[key].s0+"</td>\
									<td style='text-align:center'>"+data[key].s1+"</td>\
									<td style='text-align:center'>"+data[key].s2+"</td>\
									<td style='text-align:center'>"+data[key].s3+"</td>\
									<td style='text-align:center'>"+data[key].s4+"</td>\
									<td style='text-align:center'>"+data[key].s5+"</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_hq_attent_query_form = $("#admin-hq-attent-query-form");
				admin_hq_attent_query_form.ajaxSubmit(admin_hq_attent_query_options);
			}, responseText.data.pageNo);
		}else{

		}	
	}

	admin_hq_attent_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_hq_attent_query_options);
		return false;
	});

//活动情况
	var admin_hq_activity_query_form = $("#admin-hq-activity-query-form");
	var admin_hq_activity_query_options = {
		success:adminHqActivityQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminHqActivityQueryResponse(responseText, statusTest){
		if(responseText.s == 1){
			var data = responseText.data.list;
			var tbody = $("#student_list_tbody_id");
			tbody.empty();
			for(var key in data){

				var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].name+"</td>\
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].desc+"</td>\
									<td style='text-align:center'>"+data[key].time+"</td>\
									<td style='text-align:center'>\
										<input type='hidden' desc='id' id='course_id"+key+"' value='"+data[key].course_id+"'/>\
										<span><input style='margin-top:5px;' type='button' value='详情' onclick='jumpAdminHqActivityQuery("+data[key].id+")'/></span>\
									</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_hq_activity_query_form = $("#admin-hq-activity-query-form");
				admin_hq_activity_query_form.ajaxSubmit(admin_hq_activity_query_options);
			}, responseText.data.pageNo);
		}else{

		}	
	}

	admin_hq_activity_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_hq_activity_query_options);
		return false;
	});

//添加校区
    var admin_hq_campus_query_form = $("#admin-hq-campus-query-form");
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

//作业情况
//作业布置情况
//跳转到详细
function jumpAdminHqHomeworkQuery(id){
	var param = "&id="+id;
	document.location.href='index.php?r=/education&page=admin/hq/homework/index_1_1'+param;
}

//获取详细信息
function getAdminHqHomeworkQuery(){
	var id = $.getUrlVar("id");
	
    var url1 = "index.php?r=/education/homework/view&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        async:false,
        
        success: function(response) {
            if (response.s == 1) {
            	var data = response.data;
            	var a = $("#a-admin-hq-homework-1-1");
            	a.text(data.title+"     "+data.time);

			  	var div = $("#div-admin-hq-homework-1-1");
				div.empty();

				var divCnt = $("<img src='"+data.img+"' alt=''/>\
								<h5>"+data.desc+"</h5>\
								<hr/>\
					    		");        			

				div.append(divCnt);
				
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

//作业情况
//作业查看
//跳转到详细
function jumpAdminHqStuWorkQuery(id){
	var param = "&id="+id;
	document.location.href='index.php?r=/education&page=admin/hq/homework/index_2_1'+param;
}

//获取详细信息
function getAdminHqStuWorkQuery(){
	var id = $.getUrlVar("id");
	
    var url1 = "index.php?r=/education/stu-work/view&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        async:false,
        
        success: function(response) {
            if (response.s == 1) {
            	var data = response.data;
            	var a = $("#a-admin-hq-homework-2-1");
            	a.text(data.title+"     "+data.time);

			  	var div = $("#div-admin-hq-homework-2-1");
				div.empty();

				var divCnt = $("<img src='"+data.img+"' alt=''/>\
								<h5>"+data.desc+"</h5>\
								<hr/>\
					    		");        			

				div.append(divCnt);
				
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

//活动情况
//跳转到详细
function jumpAdminHqActivityQuery(id){
	var param = "&id="+id;
	document.location.href='index.php?r=/education&page=admin/hq/Activity/index_1_1'+param;
}

//获取详细信息
function getAdminHqActivityQuery(){

	var id = $.getUrlVar("id");	
    var url1 = "index.php?r=/education/activity/view&id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        async:false,
        
        success: function(response) {
            if (response.s == 1) {
            	var data = response.data;
    //         	var a = $("#a-admin-campus-homework-2-1");
    //         	a.text(data.title+"     "+data.time);

			  	var div = $("#div-admin-hq-activity-1");
				div.empty();

				var divCnt = $("<h5>"+data.name+"</h5>\
								<h7>"+data.desc+"</h5>\
								<hr/>\
								<h7>"+data.shared_cnt+"</h5>\
								<hr/>\
					    		");        			

				div.append(divCnt);

				
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

//添加校区
function jumpAdminHqAddCampus(){		
	document.location.href='index.php?r=/education&page=admin/hq/campus/index_1_1';
}

//获取校区列表
function getInfoCampusList(){
    var url1 = "index.php?r=/education/info-campus/index";
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
										<td style='text-align:center'>"+data[key].ic_name+"</td>\
										<td style='text-align:center'>"+data[key].ic_address+"</td>\
										<td style='text-align:center'>"+data[key].ic_tel+"</td>\
										<td style='text-align:center'>\
											<input type='hidden' desc='id' id='course_id"+key+"' value='"+data[key].course_id+"'/>\
											<span><input style='margin-top:5px;' type='button' value='修改详情' onclick='jumpAdminHqModifyCampus("+data[key].ic_id+")'/></span>\
										</td>\
									</tr>");
					tbody.append(trCnt);									
				}

				pageSearch(getInfoCampusList, response.data.pageNo);

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
//跳转添加校区修改
function jumpAdminHqModifyCampus(id){
	var param = "";
	if(id != null){
		param = "&ic_id="+id;
	}
	document.location.href='index.php?r=/education&page=admin/hq/campus/index_1_2'+param;


}
//获取校区修改信息
function getInfoCampusData(){
	var id = $.getUrlVar("ic_id");	
    var url1 = "index.php?r=/education/info-campus/index&ic_id="+id;
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        async:false,
        
        success: function(response) {
            if (response.s == 1) {
            	var data = response.data.list;
            	var ic_name = $("#ic_name");
            	var ic_tel = $("#ic_tel");

            	ic_name.val(data[0].ic_name);
            	ic_tel.val(data[0].ic_tel);
				$("#ic_id").val(id);
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

