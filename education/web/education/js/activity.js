$(document).ready(function(){
	$("#fileImg").click(function(){
      $('#img').trigger("click");
    });
	getClassList("select-hdzj");
	var select = $("#select-hdzj");

	select.change(function(){
		$("#page").val(1);
		getClassActivityList($(this).val())
	});

	function getClassActivityList(classId){
		var param = "$icl_id=" + classId;
		var page = document.getElementById("page").value;
		if(page != ""){
			param = param + "&page=" + page;
		};

		var request_url = "index.php?r=/education/activity/index&pageSize=200" + param;

		$.ajax({
			type: "get",
			url:request_url,
			dataType: "json",

			success:function(response){
				var data = response.data.list;
				var collapseG3 = $("#collapseG3");
				collapseG3.empty();

				for(var key in data){
					var month = getMonth(data[key].time);
					var day = getDay(data[key].time);
					var cnt = $("<div class='new-update clearfix'> <i class='icon-gift'></i>\
									<span class='update-notice'>\
										<a title='' href='#' onclick='hdtzClick("+key+","+data[key].id+")'>\
											<strong>"+data[key].name+"</strong>\
											<input type='hidden' id='strong"+key+"' value='"+data[key].name+"'/>\
										</a>\
										<span>"+data[key].desc+"</span>\
										<input type='hidden' id='desc"+key+"' value='"+data[key].desc+"'/>\
										<input type='hidden' id='shared_cnt"+key+"' value='"+data[key].shared_cnt+"'/>\
									</span>\
									<span class='update-date'>\
										<span class='update-day'>"+day+"</span>\
									"+month+"\
									</span>\
								 </div>");

					collapseG3.append(cnt);
				}
				pageSearch(function(){
					getClassActivityList($('#select-hdzj').val());
				}, response.data.pageNo);
			},
			error:function(data){

			}
		})
	}

///////////////////////
//考试通知表单提交
///////////////////////
	var fbinfoform = $('#fbinfoform');
	var fbinfoform_options = {
		success: fbShowResponse,
		resetForm: true,
		dataType: 'json',
	};

	function fbShowResponse(responseText, statusTest){
		
		if(responseText.s == 1){
			// document.location.href='index.php?r=/education&page=exam/index';
			alert(responseText.data);
		}else{
			$("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
		}
	}

	fbinfoform.submit(function(){
		$(this).ajaxSubmit(fbinfoform_options);
		return false;
	});

});

function hdtzClick(key , id){
	var title = $("#strong"+key).val();
	var content = $("#desc"+key).val();
	// var shared_cnt = $("#shared_cnt"+key).val();
	// alert(shared_cnt);
	// alert($("#hdzjTitle").html("人妖！"));
	// alert($("#hdzjTitle").html(title));
	// if (shared_cnt != null && shared_cnt != "") {
		// var obj = document.getElementById("shared_cnt");
		// alert(obj);
		// obj.innerText=shared_cnt;
		// obj.innerText(shared_cnt);
		// $("#shared_cnt").append(shared_cnt);
	// };
	$("#hdzjTitle").html(title);
	$("#hdzjContent").html(content);
	$("#id").val(id);
..}


