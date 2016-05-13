var eval_total = 0;
$(document).ready(function(){
/////////////////////////////////
//学生端
/////////////////////////////////
//历史作业详细评论发布
	var study_lszy_form = $("#study-lszy-form");
	var study_lszy_options = {
		success: studyLszyResponse,
		resetForm: false,
		dataType: 'json'
	};

	function studyLszyResponse(responseText, statusTest){
		if(responseText.s == 1){
			var ul = $("#ul-homework-his-desc");
			var desc = $("#desc").val();
			// alert(desc);
			// ul.empty();
			if(eval_total < 10){
				var ulCnt = $(	"<li>\
									<label style='cursor:default; margin-left:0px; margin-top:0px; font-size:16px;'>"+myName+":"+desc+"</label>\
									<hr style='margin-left:-18px;'/>\
								</li>\
							");
				ul.append(ulCnt);
			}

			$("#desc").val("");

			var shid = loadStorageValue("shid");
			getHomeWorkHisEvalPage(shid);
		}else{

		}

	}

	study_lszy_form.submit(function(){
		$(this).ajaxSubmit(study_lszy_options);
		return false;
	});


});
// <form id='study-his-ck-form' method='get' class='form-vertical' action='index.php?r=/education/stu-work/view'>\
// <span ><input style='margin-top:5px;' type='button' value='查看' onclick='saveStorage('shid')'/></span>\
// <span ><input style='margin-top:5px;' type='submit' value='查看' /></span>\
// <input type='hidden' name='id' id='shid"+key+"' value='"+data[key].shid+"'/>\
// <span><input style='margin-top:5px;' type='button' value='查看' onclick='jumplszyDetail(\"shid"+key+"\")'/></span>\
	//历史作业 his-index	
	function getHomeWorkHisList(){
		//学生端 请求历史作业

		var page = document.getElementById("page").value;
		if (page != "") {
            param = "&page="+page;
        };

	    var url1 = "index.php?r=/education/homework/his-index"+param;
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(response) {
                if (response.s == 1) {
                	var data = response.data.list;
				  	var tbody = $("#student_list_tbody_id");
					tbody.empty();
					for(var key in data){
					var shid = "";
					if(data[key].shid != null){
						shid = data[key].shid;
					}
					var trCnt = $("<tr class='gradeA'>\
										<td style='text-align:center'>"+data[key].desc+"</td>\
										<td style='text-align:center'>"+data[key].it_name+"</td>\
										<td style='text-align:center'>"+data[key].time+"</td>\
										<td style='text-align:center'>"+data[key].score+"</td>\
										<td style='text-align:center'>\
											<input type='hidden' name='id' id='hid"+key+"' value='"+data[key].hid+"'/>\
											<input type='hidden' name='id' id='shid"+key+"' value='"+shid+"'/>\
											<span><input style='margin-top:5px;' type='button' value='查看' onclick='jumplszyDetail(\"shid"+key+"\", \"hid"+key+"\")'/></span>\
										</td>\
								    </tr>");

					tbody.append(trCnt);
					}

					pageSearch(getHomeWorkHisList, response.data.pageNo);
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
	//作业查询 index
	function getHomeWorkList(){
		//学生端 作业查询
	    var url1 = "index.php?r=/education/homework/index";
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                if (data.s == 1) {
                	var data = data.data.list;
				  	var tbody = $("#student_list_tbody_id");
					tbody.empty();
					for(var key in data){
					var shid = "";
					if(data[key].shid !=null){
						shid = data[key].shid;
					}
					var status = getHomeWorKStatusDes(data[key].status, data[key].score);
					var trCnt = $("<tr class='gradeA'>\
										<td style='text-align:center'>"+data[key].desc+"</td>\
										<td style='text-align:center'>"+data[key].it_name+"</td>\
										<td style='text-align:center'>"+data[key].time+"</td>\
										<td style='text-align:center'>"+status+"</td>\
										<td style='text-align:center'>\
											<input type='hidden' name='id' id='shid"+key+"' value='"+shid+"'/>\
											<input type='hidden' name='id' id='hid"+key+"' value='"+data[key].hid+"'/>\
											<span><input style='margin-top:5px;' type='button' value='查看' onclick='jumpZygnDetail(\"hid"+key+"\",\"shid"+key+"\")'/></span>\
										</td>\
								    </tr>");

					tbody.append(trCnt);
					}

					// pageSearch(getHomeWorkList, data.data.pageNo);
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

	//所有已经提交的作业(评价作业) all-index
	function getHomeWorkAllList(){

		var page = document.getElementById("page").value;
		if (page != "") {
            param = "&page="+page;
        };

		//学生端 评价作业
	    var url1 = "index.php?r=/education/homework/all-index"+param;
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(response) {
                if (response.s == 1) {
                	var data = response.data.list;
				  	var tbody = $("#student_list_tbody_id");
					tbody.empty();
					for(var key in data){
					var trCnt = $("<tr class='gradeA'>\
										<td style='text-align:center'>"+data[key].desc+"</td>\
										<td style='text-align:center'>"+data[key].it_name+"</td>\
										<td style='text-align:center'>"+data[key].time+"</td>\
										<td style='text-align:center'>"+data[key].ecount+"</td>\
										<td style='text-align:center'>\
											<input type='hidden' name='id' id='shid"+key+"' value='"+data[key].shid+"'/>\
											<input type='hidden' name='id' id='hid"+key+"' value='"+data[key].hid+"'/>\
											<span><input style='margin-top:5px;' type='button' value='查看' onclick='jumpPjzyDetail(\"shid"+key+"\", \"hid"+key+"\")'/></span>\
										</td>\
								    </tr>");

					tbody.append(trCnt);
					}

					pageSearch(getHomeWorkAllList, response.data.pageNo);
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

	//跳到历史作业详细页面
	function jumplszyDetail(shid, hid){
		saveStorageValue(shid, "shid");
		saveStorageValue(hid, "hid");
		document.location.href='index.php?r=/education&page=student/study/index_3_1';

	}

	//获取历史作业详细页面
	function getHomeWorkHis(shid){
		//学生端 
	    var url1 = "index.php?r=/education/stu-work/view&id="+shid;
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                if (data.s == 1) {
                	var data = data.data;
				  	var div = $("#homework-his");
					div.empty();
					// for(var key in data){
					// var divCnt = $("<tr class='gradeA'>\
					// 					<td style='text-align:center'>"+data[key].desc+"</td>\
					// 					<td style='text-align:center'>"+data[key].it_name+"</td>\
					// 					<td style='text-align:center'>"+data[key].time+"</td>\
					// 					<td style='text-align:center'>"+data[key].score+"</td>\
					// 					<td style='text-align:center'>\
					// 						<span ><input style='margin-top:5px;' type='submit' value='查看'/></span>\
					// 					</td>\
					// 			    </tr>");

					var divCnt = $("<img style='width:240px; height:240px;' src='"+data.model.img+"' alt=''/>\
									<h3>"+data.model.title+"</h3>\
									<h5>"+data.model.desc+"</h5>\
									<hr style='border:1px dashed; height:0px;'/>\
									<h7>"+data.model.it_name+" "+data.time+"</h7>\
									<hr/>\
						    	");        			

					div.append(divCnt);

					var score = data.model.score;
					if(score < 0 ){
						score = "未评分";
					}
					var div_1 = $("#homework-his-1");
					var div_1_cnt = "";
					if(data.uploadList.length>0) {
						for(var i=0;i<data.uploadList.length;i++) {
							div_1_cnt += "<img width='10%' height='10%' src='/uploads/"+data.uploadList[i].file+"' alt='' style='padding: 5px 10px 15px 0;'/>";
						}
					}
					div_1_cnt += "<h5>"+data.model.sdesc+"</h5>\
									   <hr style='border:1px dashed; height:0px;'/>\
									   <h7>"+data.model.stime+"</h7>\
									   <label style='cursor:default; margin-left:0px; margin-top:0px; font-size:13px; color:red'>已评分："+score+"</label>\
									   <hr/>\
								";

					div_1.append(div_1_cnt);
					

					// pageSearch(getHomeWorkList, data.data.pageNo);
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

	//获取历史作业详细页面评论 逐条显示 只显示一条
	function getHomeWorkHisEval(shid, hid){
		var url1 = "index.php?r=/education/eval-work/index&id="+shid;
		$.ajax({
			type:"get",
			url:url1,
			dataType:"json",
			async:false,

			success: function(data){
				if(data.s == 1){
					var data = data.data.list;
					var div = $("#homework-his-2");
					div.empty();

					if(data.length > 0 ){
						// <label style="cursor:default; margin-left:10px; margin-top:0px; font-size:23px;"><a href="#">评论区</a></label>
						//style='position:absolute;'
						var divCnt = $("<label style='margin-left:0px; margin-top:0px; font-size:16px;'>\
											<a id='homework-his-2-label' href='index.php?r=/education&page=student/study/index_3_1_1&hid="+data[0].hid+"&shid="+data[0].shid+"&temp=a'>"+data[0].sname+":"+data[0].desc+"</a>\
										</label>\
										");
						div.append(divCnt)

						var homework_his_2_label = $("#homework-his-2-label");

						var index = 1;
						var size = data.length;


						setInterval(function(){

							if(index >= size){
								index = 0;
							}
							
							homework_his_2_label.text(data[index].sname+":"+data[index].desc);
						    homework_his_2_label.removeClass().addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
						      	$(this).removeClass();
						    });
							
							index = index + 1;
						}, '2000');
					}

					var form_div = $("#study-lszy-form-div");
					form_div.empty();
					// var hid = $.getUrlVar("hid");
					// var shid = $.getUrlVar("shid");
					// alert(hid);
					// alert(shid);

					var form_div_cnt = $("<input type='hidden' name='hid' value='"+hid+"' />\
										  <input type='hidden' name='shid' value='"+shid+"' />\
										  <input type='text' placeholder='评论'' name='desc' id='desc' style='margin-top:10px; margin-left:0px; width:70%;'/>\
		  								  <input type='submit' value='发表' class='btn btn-success' style='margin-top:-1px; '>\
		  								  ");

					form_div.append(form_div_cnt);
				}else
				{
					alert("数据错误"+data);
				}
			},
			error: function(data){
				alert("错误信息"+data);
			}
		})
	}

	function loadHomeWorkHis(){
		var shid = loadStorageValue("shid");
		var hid = loadStorageValue("hid");
		getHomeWorkHis(shid);
		getHomeWorkHisEval(shid, hid);
	}



/////////////////////////
//学生端 作业功能
/////////////////////////
	//跳转到作业功能详细页面
	function jumpZygnDetail(hid,shid){
		if($("#"+shid).val() == ""){
			 $.ajax({
	            type: "get",
	            url: "index.php?r=/education/stu-work/create&hid="+$("#"+hid).val(),
	            dataType: "json", 
	            async:false,
	            success: function(data) {
	                if (data.s == 1) {
	                	var data = data.data;
	                	$("#"+shid).val(data);
	                }
	            },
	            error: function(data) {
	            },
	        });
		}
		saveStorageValue(shid, "hid");
		saveStorageValue(shid, "shid");
		document.location.href='index.php?r=/education&page=student/homework/index_1_1';
	}

	//获取作业详细页面
	function getHomeWorkHisDesc(shid){
		//学生端 
	    var url1 = "index.php?r=/education/stu-work/view&id="+shid;
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                if (data.s == 1) {
                	var data = data.data;
				  	var div = $("#homework");
					div.empty();
					// for(var key in data){
					// var divCnt = $("<tr class='gradeA'>\
					// 					<td style='text-align:center'>"+data[key].desc+"</td>\
					// 					<td style='text-align:center'>"+data[key].it_name+"</td>\
					// 					<td style='text-align:center'>"+data[key].time+"</td>\
					// 					<td style='text-align:center'>"+data[key].score+"</td>\
					// 					<td style='text-align:center'>\
					// 						<span ><input style='margin-top:5px;' type='submit' value='查看'/></span>\
					// 					</td>\
					// 			    </tr>");

        			var title = $("#title");
        			title.text(data.model.title);

        			var name_time = $("#name-time");
        			var name_time_str = data.model.it_name+":"+data.time;
        			name_time.text(name_time_str);

        			var temp = "";
        			var temp_1 = "<h3>"+data.model.desc+"</h3>";
        			var temp_2 = "<img width='10%' height='10%' src='"+data.model.img+"' alt=''/>";
        			if(data.model.img == null){
        				temp = temp_1;
        			}else{
        				temp = temp_2 + temp_1;
        			}
        			
					div.append(temp);
					var sdesc = $("#sdesc");
					if(data.model.sdesc != null){
						sdesc.val(data.model.sdesc);
					}
					sdesc.attr("class","textarea_editor span12");
					$("#imgHeadPhoto").attr("src",data.model.simg);
					$("#divPreview").attr("style","");
					// pageSearch(getHomeWorkList, data.data.pageNo);
					
					if(data.uploadList.length>0) {
						$("#uploadListPanel").empty();
						for(var i=0;i<data.uploadList.length;i++) {
							var img = "<img width='10%' height='10%' src='/uploads/"+data.uploadList[i].file+"' alt='' style='padding: 5px 10px 15px 0;'/>";
							$("#uploadListPanel").html($("#uploadListPanel").html() + img);
						}
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

	function loadHomeWork(){
		var shid = loadStorageValue("shid");
		$("#id").val(shid);
		$(document).ready(function(){
			$("#fileImg").click(function(){
				$('#simg').trigger("click");
			});

			$("#simg").click(function(){
				$("#divPreview").show();
			});
		});


		getHomeWorkHisDesc(shid);

		var formObj = $('#formId');
	    var options = {
	        success:showResponse,  //处理完成 
	        resetForm: false,  
	        dataType:  'json' 
	    };
	    function showResponse(responseText, statusText)  {
	        if(responseText.s == 1){
	            alert("提交成功");
	        }else{
	            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
	        }
	    }
	    formObj.submit(function() {
			if(!$("#uploadList").val())
			{
				alert("请至少上传一个文件！");
				return false;
			}
	        $(this).ajaxSubmit(options);
	        return false; 
	    });
	}

	//获取历史作业详细页面评论 展示
	function getHomeWorkHisEvalPage(shid){

		var page = document.getElementById("page").value;
		if (page != "") {
            param = "&page="+page;
        };

		//学生端 
		var url1 = "index.php?r=/education/eval-work/index&id="+shid+param;
		$.ajax({
			type:"get",
			url:url1,
			dataType:"json",
			async:false,

			//<img id='img-star' src='img/star_1.png' style='filter:FlipV;' alt=''/>\

			success: function(response){
				if(response.s == 1){
					var data = response.data.list;
					var ul = $("#ul-homework-his-desc");
					ul.empty();
					for(var key in data){
						var ulCnt = $(	"<li>\
											<label style='cursor:default; margin-left:0px; margin-top:0px; font-size:16px;'>"+data[key].sname+":"+data[key].desc+"</label>\
											<div id='star"+key+"' class='target-demo'></div>\
											<div id='hint"+key+"' class='hint'></div>\
											<label style='cursor:default; float:right; margin-top:-10px; font-size:10px;'>"+data[key].time+"</label>\
											<hr style='margin-left:-18px;'/>\
										</li>\
									");
						ul.append(ulCnt);
						
						var name1 = "star"+key;
						var name2 = "hint"+key;
						setStar(name1, name2, data[key].star, true);
					}

					pageSearch(function(){
						var shid = loadStorageValue("shid");
						getHomeWorkHisEvalPage(shid);
					}, response.data.pageNo);

					eval_total = data.length;

					// var form_div = $("#study-lszy-form-div");
					// form_div.empty();
					// var hid = $.getUrlVar("hid");
					// var shid = $.getUrlVar("shid");
					// // alert(hid);
					// // alert(shid);

					// var form_div_cnt = $("<input type='hidden' name='hid' value='"+hid+"' />\
					// 					  <input type='hidden' name='shid' value='"+shid+"' />\
					// 					  <input type='text' placeholder='评论'' name='desc' id='desc' style='margin-top:-10px; margin-left:10px; width:70%;'/>\
		  	// 							  <input type='submit' value='发表' class='btn btn-success' style='margin-top:-21px; '>\
		  	// 							  ");

					// form_div.append(form_div_cnt);

				}else
				{
					alert("数据错误"+data);
				}
			},
			error: function(data){
				alert("错误信息"+data);
			}
		})

	}

	function loadHomeWorkHisEvalPage(){
		var shid = loadStorageValue("shid");
		getHomeWorkHisEvalPage(shid);
	}

/////////////////////////
//学生端 评价作业
/////////////////////////
	//跳转到评价作业详细页面
	function jumpPjzyDetail(shid, hid){
		// alert(shid1);
		// alert(hid);
		saveStorageValue(shid, "shid");
		saveStorageValue(hid, "hid");
		document.location.href='index.php?r=/education&page=student/eval_work/index_1_1';
	}

	//获取评价作业详细页面
	function getEvalWork(shid){
		//学生端 
	    var url1 = "index.php?r=/education/stu-work/view&id="+shid;
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                if (data.s == 1) {
                	var data = data.data;
				  	var div = $("#homework-his");
					div.empty();
					// for(var key in data){
					// var divCnt = $("<tr class='gradeA'>\
					// 					<td style='text-align:center'>"+data[key].desc+"</td>\
					// 					<td style='text-align:center'>"+data[key].it_name+"</td>\
					// 					<td style='text-align:center'>"+data[key].time+"</td>\
					// 					<td style='text-align:center'>"+data[key].score+"</td>\
					// 					<td style='text-align:center'>\
					// 						<span ><input style='margin-top:5px;' type='submit' value='查看'/></span>\
					// 					</td>\
					// 			    </tr>");

					var divCnt = $("<img style='width:240px; height:240px;' src='"+data.model.img+"' alt=''/>\
									<h3>"+data.model.title+"</h3>\
									<h5>"+data.model.desc+"</h5>\
									<hr style='border:1px dashed; height:0px;'/>\
									<h7>"+data.model.is_name+" "+data.model.time+"</h7>\
									<hr/>\
						    	");        			

					div.append(divCnt);

					var score = data.model.score;
					if(score < 0 ){
						score = "未评分";
					}
					var div_1 = $("#homework-his-1");
					var div_1_cnt = "";
					if(data.uploadList.length>0) {
						for(var i=0;i<data.uploadList.length;i++) {
							div_1_cnt += "<img width='10%' height='10%' src='/uploads/"+data.uploadList[i].file+"' alt='' style='padding: 5px 10px 15px 0;'/>";
						}
					}
					div_1_cnt += "<h5>"+data.model.sdesc+"</h5>\
									   <hr style='border:1px dashed; height:0px;'/>\
									   <h7>"+data.model.stime+"</h7>\
									   <label style='cursor:default; margin-left:0px; margin-top:0px; font-size:13px; color:red'>已评分："+score+"</label>\
									   <hr/>\
								";

					div_1.append(div_1_cnt);
					

					// pageSearch(getHomeWorkList, data.data.pageNo);
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

	//获取评价作业详细页面评论 逐条显示 只显示一条
	function getEvalWorkEval(shid, hid){
		// alert(shid);
		// alert(hid);
		var url1 = "index.php?r=/education/eval-work/index&id="+shid;
		$.ajax({
			type:"get",
			url:url1,
			dataType:"json",
			async:false,

			success: function(data){
				if(data.s == 1){
					var data = data.data.list;
					var div = $("#homework-his-2");
					div.empty();

					if(data.length > 0){
						// <label style="cursor:default; margin-left:10px; margin-top:0px; font-size:23px;"><a href="#">评论区</a></label>
						var divCnt = $("<label style='cursor:default; margin-left:0px; margin-top:0px; font-size:16px;'>\
											<a href='index.php?r=/education&page=student/eval_work/index_1_1_1&hid="+hid+"&shid="+shid+"&temp=a'>"+data[0].sname+":"+data[0].desc+"</a>\
										</label>\
										");
						div.append(divCnt)
					}


					var form_div = $("#study-lszy-form-div");
					form_div.empty();
					// var hid = $.getUrlVar("hid");
					// var shid = $.getUrlVar("shid");


					var form_div_cnt = $("<input type='hidden' name='hid' value='"+hid+"' />\
										  <input type='hidden' name='shid' value='"+shid+"' />\
										  <input type='text' placeholder='评论'' name='desc' id='desc' style='margin-top:-10px; margin-left:0px; width:70%;'/>\
		  								  <input type='submit' value='发表' class='btn btn-success' style='margin-top:-21px;'>\
		  								  </hr>\
		  								  ");

					form_div.append(form_div_cnt);
				}else
				{
					alert("数据错误"+data);
				}
			},
			error: function(data){
				alert("错误信息"+data);
			}
		})
	}

	function loadEvalWork(){
		var shid = loadStorageValue("shid");
		var hid = loadStorageValue("hid");
		getEvalWork(shid);
		getEvalWorkEval(shid, hid);
	}

	//获取评价作业详细页面评论 展示
	function getEvalWorkEvalPage(shid){

		var page = document.getElementById("page").value;
		if (page != "") {
            param = "&page="+page;
        };

		//学生端 
		var url1 = "index.php?r=/education/eval-work/index&id="+shid+param;
		$.ajax({
			type:"get",
			url:url1,
			dataType:"json",
			async:false,

			success: function(response){
				if(response.s == 1){
					var data = response.data.list;
					var ul = $("#ul-homework-his-desc");
					ul.empty();
					for(var key in data){
						var ulCnt = $(	"<li>\
											<label style='cursor:default; margin-left:0px; margin-top:0px; font-size:16px;'>"+data[key].sname+":"+data[key].desc+"</label>\
											<div id='star"+key+"' class='target-demo'></div>\
											<div id='hint"+key+"' class='hint'></div>\
											<label style='cursor:default; float:right; margin-top:-10px; font-size:10px;'>"+data[key].time+"</label>\
											<hr style='margin-left:-18px;'/>\
										</li>\
									");
						ul.append(ulCnt);
						var name1 = "star"+key;
						var name2 = "hint"+key;
						setStar(name1, name2, data[key].star, true);
					}

					pageSearch(function(){
						var shid = loadStorageValue("shid");
						getEvalWorkEvalPage(shid);
					}, response.data.pageNo);

					eval_total = data.length;

					// var form_div = $("#study-lszy-form-div");
					// form_div.empty();
					// var hid = $.getUrlVar("hid");
					// var shid = $.getUrlVar("shid");
					// // alert(hid);
					// // alert(shid);

					// var form_div_cnt = $("<input type='hidden' name='hid' value='"+hid+"' />\
					// 					  <input type='hidden' name='shid' value='"+shid+"' />\
					// 					  <input type='text' placeholder='评论'' name='desc' id='desc' style='margin-top:-10px; margin-left:10px; width:70%;'/>\
		  	// 							  <input type='submit' value='发表' class='btn btn-success' style='margin-top:-21px; '>\
		  	// 							  ");

					// form_div.append(form_div_cnt);

				}else
				{
					alert("数据错误"+data);
				}
			},
			error: function(data){
				alert("错误信息"+data);
			}
		})

	}

	function loadEvalWorkEvalPage(){
		var shid = loadStorageValue("shid");
		getEvalWorkEvalPage(shid);
	}