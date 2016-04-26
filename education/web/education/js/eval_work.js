$(document).ready(function(){

});

/////////////////////////////////
//学生端
/////////////////////////////////
//评价作业
	function getEvalWorkList(){
		//学生端 请求评价作业
	    var url1 = "index.php?r=/education/eval-work/index";
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
					var trCnt = $("<tr class='gradeA'>\
										<td style='text-align:center'>"+data[key].desc+"</td>\
										<td style='text-align:center'>"+data[key].it_name+"</td>\
										<td style='text-align:center'>"+data[key].time+"</td>\
										<td style='text-align:center'>"+data[key].score+"</td>\
										<td style='text-align:center'>\
											<span ><input style='margin-top:5px;' type='submit' value='查看'/></span>\
										</td>\
								    </tr>");

					tbody.append(trCnt);
					}

					pageSearch(getHomeWorkList, data.data.pageNo);
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