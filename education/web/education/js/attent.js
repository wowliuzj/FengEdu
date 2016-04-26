$(document).ready(function(){
	getClassList("select");
/////////////////////////////
//出勤记录查询表单
/////////////////////////////
	var query = $('#queryform');
	var queryOptions = {
		success: queryShowResponse,
		resetForm: false,
		dataType: 'json'
	};

	function queryShowResponse(responseText, statusTest){
		if(responseText.s == 1){

			// document.location.href='index.php?r=/education&page=index';
			var tbody = $("#student_list_tbody_id");
			var data = responseText.data.list
			tbody.empty();

			if(responseText.data.list.length == 0){
				alert("没有数据");
				return;
			}

			for(var key in data){
				

				var trCnt = $("<tr class='gradeA'>\
									<td style='text-align:center'>"+data[key].is_name+"</td>\
									<td style='text-align:center'>"+data[key].icl_number+"</td>\
									<td style='text-align:center'>"+data[key].time+"</td>\
									<td style='text-align:center; width:520px;'>\
									    <input type='hidden' name='sid"+key+"' value='"+data[key].id+"' />\
                  						<select id='state"+key+"' style='width:200px;' name='status"+key+"'>\
											<option value='0' selected='selected'>正常</option>\
											<option value='1'>迟到</option>\
											<option value='2'>早退</option>\
											<option value='3'>旷课</option>\
											<option value='4'>事假</option>\
											<option value='5'>病假</option>\
										</select>\
									</td>\
							    </tr>");

				tbody.append(trCnt)
				var selected = data[key].status;
				$('#state'+key).val(selected);
			}
			pageSearch(function(){
				var query = $('#queryform');
				query.ajaxSubmit(queryOptions);
			},responseText.data.pageNo);
		}else{
			$("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
		}
	}

	query.submit(function(){
		$("#page").val(1);
        $(this).ajaxSubmit(queryOptions);
        return false; 
	});

/////////////////////////////
//出勤记录更新表单
/////////////////////////////
	var update = $('#alterform');

	var alterOptions = {
		success: alterShowResponse,
		resetForm: false,
		dataType: 'json'
	};

	function alterShowResponse(responseText, statusTest){
		if(responseText.s == 1){
			// document.location.href='index.php?r=/education&page=index';
			alert("修改成功");
		}else{
			$("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
		}
	}
	update.submit(function(){
        $(this).ajaxSubmit(alterOptions);
        return false; 	
	});


/////////////////////////////
//出勤统计查询表单
/////////////////////////////
	var tjqt = $('#tjqtform');
	var tjqtOptions = {
		success: tjqtShowResponse,
		resetForm: false,
		dataType: 'json'
	};

	function tjqtShowResponse(responseText, statusTest){
		if(responseText.s == 1){
			var tbody = $("#student_list_tbody_id");
			var data = responseText.data.list;
			tbody.empty();
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
				tbody.append(trCnt)
			}
			pageSearch(function(){
				var tjqt = $('#tjqtform');
				tjqt.ajaxSubmit(tjqtOptions);
			},responseText.data.pageNo);
		}else{

		}
	}
	tjqt.submit(function(){
		$("#page").val(1);
		$(this).ajaxSubmit(tjqtOptions);
		return false;
	});



	$("#gr").click(function(){ 
		$("#banji").hide();
		$("#geren").show();
	});
	$("#bj").click(function(){
		$("#geren").hide();
		$("#banji").show();
	})

	$("#benzhou").click(function(){ 
		$("#input_start_time").val(getWeekStartDate());
		$("#input_end_time").val(getWeekEndDate());
	});
	$("#benyue").click(function(){
		$("#input_start_time").val(getMonthStartDate());
		$("#input_end_time").val(getMonthEndDate());
	})

/////////////////////////////////
//学生端
/////////////////////////////////
//出勤情况
	var study_cq_form = $("#study-cq-form");
	var study_cq_options = {
		success: studyCqResponse,
		resetForm: false,
		dataType: 'json'
	};

	function studyCqResponse(responseText, statusTest){
		if(responseText.s == 1){
			if(responseText.data.length == 0){
				alert("没有数据");
				return;
			}
			var tbody = $("#student_list_tbody_id");
			var data = responseText.data;
			tbody.empty();
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

		}else{

		}
	}

	study_cq_form.submit(function(){
		$(this).ajaxSubmit(study_cq_options);
		return false;
	});
/////////////////////////////////


});