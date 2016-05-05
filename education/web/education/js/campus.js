$(document).ready(function(){
/////////////////////////////////
//企业端 校区管理端
/////////////////////////////////
//教学情况
	var admin_campus_teach_tongji_form = $("#admin-campus-teach-tongji-form");
	var admin_campus_teach_tongji_options = {
		success:adminCampusTeachTongjiResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminCampusTeachTongjiResponse(responseText, statusTest){
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
				var admin_campus_teach_tongji_form = $("#admin-campus-teach-tongji-form");
				admin_campus_teach_tongji_form.ajaxSubmit(admin_campus_teach_tongji_options);
			}, responseText.data.pageNo);
		}else{

		}
	}

	admin_campus_teach_tongji_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_campus_teach_tongji_options);
		return false;
	});

//作业情况
//作业布置情况
	var admin_campus_teach_homework_query_form = $("#admin-campus-teach-homework-query-form");
	var admin_campus_teach_homework_query_options = {
		success:adminCampusTeachHomeworkQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminCampusTeachHomeworkQueryResponse(responseText, statusTest){
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
										<span><input style='margin-top:5px;' type='button' value='详情' onclick='jumpAdminCampusTeachHomeworkQuery("+data[key].id+")'/></span>\
									</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_campus_teach_homework_query_form = $("#admin-campus-teach-homework-query-form");
				admin_campus_teach_homework_query_form.ajaxSubmit(admin_campus_teach_homework_query_options);
			}, responseText.data.pageNo);
		}else{

		}
	}

	admin_campus_teach_homework_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_campus_teach_homework_query_options);
		return false;
	});
//作业查看
	var admin_campus_stu_work_query_form = $("#admin-campus-stu-work-query-form");
	var admin_campus_stu_work_query_options = {
		success:adminCampusStuWorkQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminCampusStuWorkQueryResponse(responseText, statusTest){
		if(responseText.s == 1){
			var data = responseText.data.list;
			var tbody = $("#student_list_tbody_id");
			tbody.empty();
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
									<td style='text-align:center'>\
										<input type='hidden' name='id' id='course_id"+key+"' value='"+data[key].course_id+"'/>\
										<span><input style='margin-top:5px;' type='button' value='详情' onclick='jumpAdminCampusStuWorkQuery("+data[key].id+")'/></span>\
									</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_campus_stu_work_query_form = $("#admin-campus-teach-stu-work-query-form");
				admin_campus_stu_work_query_form.ajaxSubmit(admin_campus_stu_work_query_options);
			}, responseText.data.pageNo);
		}else{

		}		
	}

	admin_campus_stu_work_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_campus_stu_work_query_options);
		return false;
	});
//考试情况
	var admin_campus_exam_query_form = $("#admin-campus-exam-query-form");
	var admin_campus_exam_query_options = {
		success:adminCampusExamQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminCampusExamQueryResponse(responseText, statusTest){
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
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].is_name+"</td>\
									<td style='text-align:center'>"+data[key].title+"</td>\
									<td style='text-align:center'>"+score+"</td>\
									<td style='text-align:center'>"+data[key].time+"</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				// alert("111111111111");
				var admin_campus_exam_query_form = $("#admin-campus-exam-query-form");
				admin_campus_exam_query_form.ajaxSubmit(admin_campus_exam_query_options);
			}, responseText.data.pageNo);
		}else{

		}	
	}

	admin_campus_exam_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_campus_exam_query_options);
		return false;
	});
//出勤情况
	var admin_campus_attent_query_form = $("#admin-campus-attent-query-form");
	var admin_campus_attent_query_options = {
		success:adminCampusAttentQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminCampusAttentQueryResponse(responseText, statusTest){
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
				var admin_campus_attent_query_form = $("#admin-campus-attent-query-form");
				admin_campus_attent_query_form.ajaxSubmit(admin_campus_attent_query_options);
			}, responseText.data.pageNo);
		}else{

		}	
	}

	admin_campus_attent_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_campus_attent_query_options);
		return false;
	});

//活动情况
	var admin_campus_activity_query_form = $("#admin-campus-activity-query-form");
	var admin_campus_activity_query_options = {
		success:adminCampusActivityQueryResponse,
		resetForm:false,
		dataType:'json'
	};

	function adminCampusActivityQueryResponse(responseText, statusTest){
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
										<span><input style='margin-top:5px;' type='button' value='详情' onclick='jumpAdminCampusActivityQuery("+data[key].id+")'/></span>\
									</td>\
								</tr>");
				tbody.append(trCnt);
			}

			pageSearch(function(){
				var admin_campus_activity_query_form = $("#admin-campus-activity-query-form");
				admin_campus_activity_query_form.ajaxSubmit(admin_campus_activity_query_options);
			}, responseText.data.pageNo);
		}else{

		}	
	}

	admin_campus_activity_query_form.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(admin_campus_activity_query_options);
		return false;
	});
});

//作业情况
//作业布置情况
//跳转到详细
function jumpAdminCampusTeachHomeworkQuery(id){
	var param = "&id="+id;
	document.location.href='index.php?r=/education&page=admin/campus/homework/index_1_1'+param;
}

//获取详细信息
function getAdminCampusTeachHomeworkQuery(){
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
            	var a = $("#a-admin-campus-homework-1-1");
            	a.text(data.title+"     "+data.time);

			  	var div = $("#div-admin-campus-homework-1-1");
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
function jumpAdminCampusStuWorkQuery(id){
	var param = "&id="+id;
	document.location.href='index.php?r=/education&page=admin/campus/homework/index_2_1'+param;
}

//获取详细信息
function getAdminCampusStuWorkQuery(){
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
            	var a = $("#a-admin-campus-homework-2-1");
            	a.text(data.model.title+"     "+data.model.time);

			  	var div = $("#div-admin-campus-homework-2-1");
				div.empty();

				var imgList = "";
				if(data.uploadList.length>0) {
					for(var i=0;i<data.uploadList.length;i++) {
						imgList += "<img width='10%' height='10%' src='/uploads/"+data.uploadList[i].file+"' alt='' style='padding: 5px 10px 15px 0;'/>";
					}
				}
				var divCnt = $(imgList + "<h5>"+data.model.desc+"</h5>\
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
function jumpAdminCampusActivityQuery(id){
	var param = "&id="+id;
	document.location.href='index.php?r=/education&page=admin/campus/Activity/index_1_1'+param;
}

//获取详细信息
function getAdminCampusActivityQuery(){

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

			  	var div = $("#div-admin-campus-activity-1");
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