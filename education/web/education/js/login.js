
$(document).ready(function(){

	var login = $('#loginform');
	 var options = {  
        success:       showResponse,  //处理完成 
        resetForm: false,  
        dataType:  'json' 
    };
    function showResponse(responseText, statusText)  {
    	if(responseText.s == 1){
			document.location.href='index.php?r=/education&page=index';
    	}else{
			$("#errormsg").html(responseText.data).show(300).delay(3000).hide(300); 
    	}
	    //$("#msg").html('提交成功'); 
	    //var sex = responseText.sex==1?"男":"女"; 
	   // $("#output").html("姓名："+responseText.uname+" 性别："+sex+" 年龄："+responseText.age); 
	}
    login.submit(function() {
        $(this).ajaxSubmit(options);
        return false; 
    });

    //找回密码
    var recover = $('#recoverform');
	var speed = 400;

	$('#to-recover').click(function(){
		
		$("#loginform").slideUp();
		$("#recoverform").fadeIn();
	});
	$('#to-login').click(function(){
		
		$("#recoverform").hide();
		$("#loginform").fadeIn();
	});
	
    $('#reecover').click(function(){
		
	});
});