$(document).ready(function(){

	getClassList("select");
	getClassList("fbinfoform-select");
	var select = $('#select');
	select.change(function(){
		// alert($(this).val());
		$("#page").val(1);
		getClassInfoList($(this).val());

	});

	var fbinfoform_select = $("#fbinfoform-select");
	fbinfoform_select.change(function(){
		getCourse($(this).val(), "subject");
	});

	function getCourse(classid){
		var url1 = "index.php?r=/education/course/list&cid="+classid;
		$.ajax({
			type:"get",
			url:url1,
			dataType:"json",

			success:function(data){
				var selId = 'subject';
				var subject = $("#"+selId);
				if(data.s == 1){
					var list = data.data;
					subject.append("<option value='0' selected>选择科目</option>");
					for(key in list){
						var id = list[key].id;
						var value = list[key].cnt;
						subject.append("<option value='" + id + "'>" + value + "</option>");
					}
					subject.select2();
				}else
				{
					alert("获取科目列表数据错误"+data);
				}

			},
			error:function(data){
				alert("错误信息"+data);
			},
		});
	}

	function getClassInfoList(classId)
	{
		// var param = "&icl_id=" + classId;
		var param = "&cid=" + classId;
		var page = document.getElementById("page").value;
		if (page != "") {
            param = param + "&page="+page;
        };
		var request_url = "index.php?r=/education/exam/index&pageSize=200" + param;
		$.ajax({
			type: "get",
			url: request_url,
			dataType: "json",

			success: function(response){
				var data = response.data.list;
				var tbody = $("#student_list_tbody_id");
				tbody.empty();

				if(data.length == 0){
					alert("没有数据");
					return;
				}

				for(var key in data){
					var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].desc+"</td>\
									<td style='text-align:center'>"+data[key].time+"</td>\
									<td style='text-align:center'>\
										<span><input style='margin-top:5px;' type='button' value='发布成绩' onclick='jumpCjfbDetail(\""+data[key].id+"\",\""+data[key].cid+"\")'/></span>\
									</td>\
								   </tr>");
					tbody.append(trCnt);
				}

				pageSearch(function(){
					getClassInfoList($('#select').val());
				}, response.data.pageNo);
			},
			error: function(data){

			}
		})
	}

///////////////////////
//成绩发布表单提交
///////////////////////
	var publish = $('#cjfbform');
	var publishOptions = {
		success: publishShowResponse,
		resetForm: false,
		dataType: 'json'
	};

	function publishShowResponse(responseText, statusTest){
		if(responseText.s == 1){
			//document.location.href='index.php?r=/education&page=exam/index_cjfb';
		alert("发布成功");
		}else{

		}
	}

	publish.submit(function(){
		$(this).ajaxSubmit(publishOptions);
		return false;
	});

///////////////////////
//考试通知表单提交
///////////////////////
	var exam_notification = $('#fbinfoform');
	var exam_notification_Options = {
		success: examShowResponse,
		resetForm: false,
		dataType: 'json'
	};

	function examShowResponse(responseText, statusTest){
		if(responseText.s == 1){
			// document.location.href='index.php?r=/education&page=exam/index';
			alert("发布成功");
		}else{
			$("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
		}
	}

	exam_notification.submit(function(){
		$(this).ajaxSubmit(exam_notification_Options);
		return false;
	});


/////////////////////////
//学生端 成绩查询
/////////////////////////
	var home_work_from = $('#home-work-form');
	var homeWokrOptions = {
		success: homeWorkShowResponse,
		resetForm: false,
		dataType: 'json'
	};

	function homeWorkShowResponse(responseText, statusTest){
		if(responseText.s == 1){
			var tbody = $("#student_list_tbody_id");
			var data = responseText.data.list
			tbody.empty();
			for(var key in data){
				var trCnt = $("<tr class='gradeA'>\
								<td style='text-align:center'>"+data[key].is_name+"</td>\
								<td style='text-align:center'>"+data[key].title +"</td>\
								<td style='text-align:center'>"+data[key].score +"</td>\
								<td style='text-align:center'>"+data[key].time +"</td>\
								<td style='text-align:center'>"+data[key].desc +"</td>\
							   </tr>");
				tbody.append(trCnt);
			}
		}else{

		}
	}

	home_work_from.submit(function(){
		$(this).ajaxSubmit(homeWokrOptions);
		return false;
	});
});


function getHomeWorkFindSocre(){
    var url1 = "index.php?r=/education/exam/score";
    $.ajax({
        type: "get",
        url: url1,
        dataType: "json", 
        async:false,
        
        success: function(responseText) {
			if(responseText.s == 1){
				var tbody = $("#student_list_tbody_id");
				var data = responseText.data.list
				tbody.empty();
				for(var key in data){
					var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].is_name+"</td>\
									<td style='text-align:center'>"+data[key].title +"</td>\
									<td style='text-align:center'>"+data[key].score +"</td>\
									<td style='text-align:center'>"+data[key].time +"</td>\
									<td style='text-align:center'>"+data[key].desc +"</td>\
								   </tr>");
					tbody.append(trCnt);
				}
            }else
            {
                alert("数据错误"+data);
            }
        },
        error: function(data) {
            alert("错误信息"+data);
        },
    });
}

//跳到成绩发布详细
function jumpCjfbDetail(id,cid){
	// alert(id);
	var param = "&cid="+cid+"&eid="+id+"&a=1";
	document.location.href='index.php?r=/education&page=exam/index_cjfb_1'+param;
}
//获取成绩发布详细信息 临时
function getCjfbDetail(){
	if(isCheckInputVal() == true){
		publishPerformance();
	}
	var cid = $.getUrlVar("cid");
	var param = "&icl_id=" + cid;
	var eid = $.getUrlVar("eid");
	param =param+ "&eid="+eid;
	$("#eid").val(eid);

	var page = document.getElementById("page").value;
	if (page != "") {
        param = param + "&page="+page;
    }
	var request_url = "index.php?r=/education/student/stu-exam" + param;

    $.ajax({
        type: "get",
        url: request_url,
        dataType: "json", 
        async:false,
        
			success: function(response){
				var data = response.data.list;
				var tbody = $("#student_list_tbody_id");
				tbody.empty();

				if(data.length == 0){
					alert("没有数据");
					return;
				}

				for(var key in data){
					var score = data[key].score;
					if(score == null){
						score = 0;
					}
					var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].is_name+"</td>\
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].desc+"</td>\
									<td style='text-align:center; width:300px;'>\
										<input type='hidden' name='sid"+key+"' value='"+data[key].is_id+"'/>\
										<input type='text' placeholder='0' id='score"+key+"' name='score"+key+"' style='margin-top:0px; margin-left:0px; height:13px; width:85px;'/>\
									</td>\
								   </tr>");
					tbody.append(trCnt);
				}

				pageSearch(getCjfbDetail, response.data.pageNo);

			},
			error: function(data){

			}
    })
}

function isCheckInputVal(){	
	var bHave = false;
	for(var i = 0; i < 10; ++i){
		var id = $("[name='score"+i+"']");
		if(id.length > 0){
			if(id.val() > 0 ){
				bHave = true;
			}
		}
	}

	if(bHave){
		var r = confirm("是否发布当前修改的成绩");
		if (r==true){
			return true;
		}
		else{
			return false;
		}
	}

	return false;
}

//成绩发布表单提交
function publishPerformance(){
///////////////////////
//成绩发布表单提交
///////////////////////
	var publish = $('#cjfbform');
	var publishOptions = {
		success: publishShowResponse,
		resetForm: false,
		dataType: 'json'
	};

	function publishShowResponse(responseText, statusTest){
		if(responseText.s == 1){
			//document.location.href='index.php?r=/education&page=exam/index_cjfb';
		alert("发布成功");
		}else{

		}
	}

	publish.ajaxSubmit(publishOptions);
}

