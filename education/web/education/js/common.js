var myName = "";
$(document).ready(function(){

	$.ajax({
	  	type: "get",
		url: "index.php?r=/education/permission/list",
		dataType: "json", 
		//data:{"mid":1},
		success: function (data) {
			var ul = $("#permission_list_ul_id");
			ul.empty();
		    for(var key in data){
				var liCnt = $('<li class="'+data[key].p_style+'"><a href="index.php?r=/education&page='+data[key].p_name+'"> <i class="icon-tag"></i>'+data[key].p_alias+'</a></li>');
				ul.append(liCnt);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) { 
		    //alert(errorThrown); 
		}
	});

  $.ajax({
    type: "get",
    url: "index.php?r=/education/admin/welcome-info",
    dataType: "json",
    success: function (data) {
      var welcomeId = $("#welcomeId");
      myName = data.data['viewName'];
      welcomeId.text("欢迎你，"+myName);
      var type = data.data['type'];
      if(type == 5 || type == 6){
        //alert(data.data['count']);
        $("#tz_count").text(""+data.data['count']);
        $("#tz_count_li").attr("style","");
      }
        if(type ==3){
            //alert(data.data['count']);
            $("#tz_teacher_li").attr("style","");
        }
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
        //alert(errorThrown); 
    }
  });
});



function getClassList(selId){
	//请求教师班级列表
    var url1 = "index.php?r=/education/info-class/classes1";
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                // var classNums = document.getElementById("icl_id");
                var classNums = $("#"+selId);
                var s = data.s;
                if (s == 1) {
                  var list = data.data;
				          classNums.append("<option value='0' selected>选择班级</option>");
                  for(key in list)
                  {
                    var id = list[key].icl_id;
                    var value = list[key].icl_number;

                    // alert("获取班主任班级数据成功"+id + value + "<option value='" + id + "' selected>" + value + "</option>");
                    // classNums.append("<option value='1508'>1508</option>");
                    classNums.append("<option value='" + id + "'>" + value + "</option>");
                  }

                  classNums.select2();
                 }else
                  {
                    alert("获取班主任班级数据错误"+data);
                  };
                  //classes info == " + data + "length == " + data.length);
             },
            error: function(data) {
                alert("错误信息"+data);
            }
        });

}

//得到教师对应的班级
function getTeacherClassList(selId,tid){
    //请求教师班级列表
    var param = "";
    if(tid != null){
      param = "&tid="+tid;
    }
    var url1 = "index.php?r=/education/info-class/all-classes"+param;
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                // var classNums = document.getElementById("icl_id");
                var classNums = $("#"+selId);
                var s = data.s;
                if (s == 1) {
                  var list = data.data;
                  classNums.empty();
                  classNums.append("<option value='0' selected>选择班级</option>");
                  for(key in list)
                  {
                    var id = list[key].icl_id;
                    var value = list[key].icl_number;

                    // alert("获取班主任班级数据成功"+id + value + "<option value='" + id + "' selected>" + value + "</option>");
                    // classNums.append("<option value='1508'>1508</option>");
                    classNums.append("<option value='" + id + "'>" + value + "</option>");
                  }

                  classNums.select2();
                 }else
                  {
                    alert("获取班主任班级数据错误"+data);
                  };
                  //classes info == " + data + "length == " + data.length);
             },
            error: function(data) {
                alert("错误信息"+data);
            }
        });
}

//得到校区的所有的老师的列表
function getAllClassList(selId,campusId){
    //请求教师班级列表
    var param = "";
    if(campusId != null){
      param = "&campus_id="+campusId;
    }
    var url1 = "index.php?r=/education/info-class/all-classes"+param;
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                // var classNums = document.getElementById("icl_id");
                var classNums = $("#"+selId);
                var s = data.s;
                if (s == 1) {
                  var list = data.data;
                  classNums.empty();
                  classNums.append("<option value='0' selected>选择班级</option>");
                  for(key in list)
                  {
                    var id = list[key].icl_id;
                    var value = list[key].icl_number;

                    // alert("获取班主任班级数据成功"+id + value + "<option value='" + id + "' selected>" + value + "</option>");
                    // classNums.append("<option value='1508'>1508</option>");
                    classNums.append("<option value='" + id + "'>" + value + "</option>");
                  }

                  classNums.select2();
                 }else
                  {
                    alert("获取班主任班级数据错误"+data);
                  };
                  //classes info == " + data + "length == " + data.length);
             },
            error: function(data) {
                alert("错误信息"+data);
            }
        });
}
//请求教师列表
function getTeacherList(selId, campusId){
    var param = "";
    if(campusId != null){
      param = "&campus_id="+campusId;
    }

    var url1 = "index.php?r=/education/teacher/list"+param;
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                var teacherNums = $("#"+selId);
                teacherNums.empty();
                var s = data.s;
                if (s == 1) {
                  var list = data.data;
                  teacherNums.append("<option value='0' selected>选择教师</option>");
                  for(key in list)
                  {
                    var id = list[key].it_id;
                    var value = list[key].it_name;

                    teacherNums.append("<option value='" + id + "'>" + value + "</option>");
                  }

                  teacherNums.select2();
                 }else
                  {
                    alert("获取班主任班级数据错误"+data);
                  };
             },
            error: function(data) {
                alert("错误信息"+data);
            }
        });
}
  //请求校区列表
function getSchoolList(selId){
    var url1 = "index.php?r=/education/info-campus/campus";
        $.ajax({
            type: "get",
            url: url1,
            dataType: "json", 
            async:false,
            
            success: function(data) {
                var schools = $("#"+selId);
                var s = data.s;
                if (s == 1) {
                  var list = data.data;
                  schools.append("<option value='0' selected>选择校区</option>");
                  for(key in list)
                  {
                    var id = list[key].ic_id;
                    var value = list[key].ic_name;


                    schools.append("<option value='" + id + "'>" + value + "</option>");
                  }

                  schools.select2();
                 }else
                  {
                    alert("获取校区列表数据错误"+data);
                  };
                  //classes info == " + data + "length == " + data.length);
             },
            error: function(data) {
                alert("错误信息"+data);
            }
        });
}

//根据班级获取科目
function getClassSubject(classid, selId){
  var url1 = "index.php?r=/education/outline/list&cid="+classid;
  $.ajax({
    type:"get",
    url:url1,
    dataType:"json",

    success:function(data){
      var subject = $("#"+selId);
        subject.empty();
      if(data.s == 1){
        var list = data.data;
        subject.append("<option value='0' selected>选择科目</option>");
        for(key in list){
          var id = list[key].id;
          var value = list[key].title;
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
    }
  });
}



function pageSearch(search,pageNo){
    var page = $("#page").val();
    $('#pageNo').text(page+"/"+pageNo);
    if(page == 1){
      $("#liPageFirst").attr("class","disabled");
      $("#liPagePrevious").attr("class","disabled");
    }else{
      $("#liPageFirst").attr("class","");
      $("#liPagePrevious").attr("class","");
    }
    if(page == pageNo){
      $("#liPageNext").attr("class","disabled");
      $("#liPageLast").attr("class","disabled");
    }else{
      $("#liPageNext").attr("class","");
      $("#liPageLast").attr("class","");
    }

   $('#pageFirst').unbind();
   $('#pagePrevious').unbind(); 
   $('#pageLast').unbind(); 
   $('#pageNext').unbind(); 

    $("#pageFirst").click(function(){
        var page = $("#page").val();
        page = parseInt(page);
        if(page == 1){
          return;
        }
        $("#page").val("1");
        search();
    });
    $("#pagePrevious").click(function(){
        var page = $("#page").val();
        page = parseInt(page);
        if(page == 1){
          return;
        }
        $("#page").val(page - 1);
        search();
    });
    $("#pageLast").click(function(){
        var page = $("#page").val();
        page = parseInt(page);
        if(page == pageNo){
          return;
        }
        $("#page").val(pageNo);
        search();
    });
    $("#pageNext").click(function(){
        var page = $("#page").val();
        page = parseInt(page);
        if(page == pageNo){
          return;
        }
        $("#page").val(page + 1);
        search();
    });
   
}

$.extend({
  getUrlVars: function(){
    var vars = new Array();
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      var hash = hashes[i].split('=');
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    var vars = $.getUrlVars();
    return vars[name];
  }
});

function fillFormData(data){
    for(k in data){
      var obj = $("[name='"+k+"']");
      if(obj.length <= 0){
        continue;
      }
      var type = obj.attr('type');
      if(type == 'radio'){
        $("input:radio[value='"+data[k]+"']").attr('checked','true');
      }else{
        obj.val(data[k]);
      }
    }

    $("form select").each(function(){
      $(this).select2();
    });
    $("form textarea").each(function(){
      $(this).attr("class","textarea_editor span12");
      $(this).wysihtml5();
    });
    $.uniform.update();
}

//////////////////////
//日期函数
//////////////////////
var now = new Date(); //当前日期 
var nowDayOfWeek = now.getDay(); //今天本周的第几天 
var nowDay = now.getDate(); //当前日 
var nowMonth = now.getMonth(); //当前月 
var nowYear = now.getYear(); //当前年 
nowYear += (nowYear < 2000) ? 1900 : 0; //

//格局化日期：yyyy-MM-dd 
function formatDate(date) { 
var myyear = date.getFullYear(); 
var mymonth = date.getMonth()+1; 
var myweekday = date.getDate(); 

if(mymonth < 10){ 
mymonth = "0" + mymonth; 
} 
if(myweekday < 10){ 
myweekday = "0" + myweekday; 
} 
return (myyear+"-"+mymonth + "-" + myweekday); 
} 



//获得某月的天数 
function getMonthDays(myMonth){ 
var monthStartDate = new Date(nowYear, myMonth, 1); 
var monthEndDate = new Date(nowYear, myMonth + 1, 1); 
var days = (monthEndDate - monthStartDate)/(1000 * 60 * 60 * 24); 
return days; 
} 


//获得本周的开端日期 
function getWeekStartDate() { 
	var weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek + 1); 
	return formatDate(weekStartDate); 
} 

//获得本周的停止日期 
function getWeekEndDate() { 
	var weekEndDate = new Date(nowYear, nowMonth, nowDay + (7 - nowDayOfWeek)); 
	return formatDate(weekEndDate); 
} 

//获得本月的开端日期 
function getMonthStartDate(){ 
	var monthStartDate = new Date(nowYear, nowMonth, 1); 
	return formatDate(monthStartDate); 
} 

//获得本月的停止日期 
function getMonthEndDate(){ 
	var monthEndDate = new Date(nowYear, nowMonth, getMonthDays(nowMonth)); 
	return formatDate(monthEndDate); 
} 
//获取当天
function getCurDay(){
    var now = new Date(); //当前日期 
    var nowDay = now.getDate(); //当前日 
    var nowMonth = now.getMonth()+1;//当前月 
    var nowYear = now.getYear(); //当前年 
    nowYear += (nowYear < 2000) ? 1900 : 0; //

    var curDate = new Date(nowYear, nowMonth, nowDay); 
    // return formatDate(curDate); 
    return curDate;
}

//字符串转日期格式，strDate要转为日期格式的字符串
//测试  alert(getDate("2012-9-20 19:46:18")); 
function getDate(strDate){
  // alert(strDate);
  if(strDate == "" || strDate == "null" || strDate == null){
    // alert(strDate);
    return getCurDay();
    
  }
  var st = strDate;
  var a = st.split(" ");
  var b = a[0].split("-");
  var c = a[1].split(":");
  var date = new Date(b[0], b[1], b[2], c[0], c[1], c[2]);
  return date;
}
function getMonth(strDate){
  var date = getDate(strDate);
  var mymonth = date.getMonth(); 
  if(mymonth < 10){ 
    mymonth = "0" + mymonth; 
  } 
  return mymonth;
}
function getDay(strDate){
  var date = getDate(strDate);
  var myweekday = date.getDate();
  if(myweekday < 10){ 
    myweekday = "0" + myweekday; 
  } 
  return myweekday;
}

//贾长端切换查询的页面
function find(index){
  switch(index){
    case 0:
      document.location.href='index.php?r=/education&page=parent/find';
    break;
    default:
      document.location.href="index.php?r=/education&page=parent/find_" + index;
    break;
  }
}
// status（1新作业，2尚未完成，3待评分，4已完成）
function getHomeWorKStatusDes(status , score){
	switch(status){
		case 1:
		return "新作业";
		case 2:
		return "尚未完成";
		case 3:
		return "待评分";
		case 4:
		return "已完成："+score;
	}
}

//js本地图片预览，兼容ie[6-9]、火狐、Chrome17+、Opera11+、Maxthon3
function PreviewImage(fileObj, imgPreviewId, divPreviewId) {
  var allowExtention = ".jpg,.bmp,.gif,.png"; //允许上传文件的后缀名document.getElementById("hfAllowPicSuffix").value;
  var extention = fileObj.value.substring(fileObj.value.lastIndexOf(".") + 1).toLowerCase();
  var browserVersion = window.navigator.userAgent.toUpperCase();
  if (allowExtention.indexOf(extention) > -1) {
    if (fileObj.files) {//HTML5实现预览，兼容chrome、火狐7+等
        if (window.FileReader) {
            var reader = new FileReader();
            reader.onload = function (e) {
                              document.getElementById(imgPreviewId).setAttribute("src", e.target.result);
                            } 
            reader.readAsDataURL(fileObj.files[0]);
        } else if (browserVersion.indexOf("SAFARI") > -1) {
            alert("不支持Safari6.0以下浏览器的图片预览!");
        }
        } else if (browserVersion.indexOf("MSIE") > -1) {
            if (browserVersion.indexOf("MSIE 6") > -1) {//ie6
                document.getElementById(imgPreviewId).setAttribute("src", fileObj.value);
            } else {//ie[7-9]
                fileObj.select();
                if (browserVersion.indexOf("MSIE 9") > -1)
                      fileObj.blur(); //不加上document.selection.createRange().text在ie9会拒绝访问
                      var newPreview = document.getElementById(divPreviewId + "New");
                      if (newPreview == null) {
                            newPreview = document.createElement("div");
                            newPreview.setAttribute("id", divPreviewId + "New");
                            newPreview.style.width = document.getElementById(imgPreviewId).width + "px";
                            newPreview.style.height = document.getElementById(imgPreviewId).height + "px";
                            newPreview.style.border = "solid 1px #d2e2e2";
                      }
                      newPreview.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";
                      var tempDivPreview = document.getElementById(divPreviewId);
                      tempDivPreview.parentNode.insertBefore(newPreview, tempDivPreview);
                      tempDivPreview.style.display = "none";
                }
                } else if (browserVersion.indexOf("FIREFOX") > -1) {//firefox
                            var firefoxVersion = parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
                            if (firefoxVersion < 7) {//firefox7以下版本
                                  document.getElementById(imgPreviewId).setAttribute("src", fileObj.files[0].getAsDataURL());
                            } else {//firefox7.0+                    
                                document.getElementById(imgPreviewId).setAttribute("src", window.URL.createObjectURL(fileObj.files[0]));
                            }
                } else {
                    document.getElementById(imgPreviewId).setAttribute("src", fileObj.value);
                }
        } else {
              alert("仅支持" + allowExtention + "为后缀名的文件!");
              fileObj.value = ""; //清空选中文件
              if (browserVersion.indexOf("MSIE") > -1) {
                    fileObj.select();
                    document.selection.clear();
              }
              fileObj.outerHTML = fileObj.outerHTML;
  }
  return fileObj.value;    //返回路径
}

//得到源字符串长度小于maxlen的子串
function getSubStr(srcStr , maxLen){
	if (srcStr != null) {
		if (srcStr.length > maxLen) {
			return srcStr.substr(0,maxLen) + "……";
		};
	} 
	return srcStr;
}

function setStar(nameid, nameid2, star_score, read_only){
    if(star_score == null){
      star_score = 0;
    }
    $.fn.raty.defaults.path = 'img';

    $("#"+nameid).raty({
      number: 10,//多少个星星设置
    score: star_score,//初始值是设置
    targetType: 'number',//类型选择，number是数字值，hint，是设置的数组值
        path      : 'img',
        cancelOff : 'cancel-off-big.png',
        cancelOn  : 'cancel-on-big.png',
        size      : 32,
        starHalf  : 'star-half-big.png',
        starOff   : 'star-off-big.png',
        starOn    : 'star-on-big.png',
        target    : '#'+nameid2,
        cancel    : false,
        targetKeep: false,
        precision : true,//是否包含小数
        readOnly: read_only,

        click: function(score, evt) {
          // alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);

          // alert(Math.round(score));

          $("#star").val(score);
        }
      });   
}

//根据id得到对象的value是否有内容
function hasTextById(id){
  var obj = document.getElementById(id);
  var value = obj.value;
  if (value==null || value=="") {return false} else{return true};
}