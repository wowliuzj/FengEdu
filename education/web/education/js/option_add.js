$(document).ready(function(){
    var formObj = $('#formId');
    formObj.validate();
    var options = {
        success:showResponse,
        resetForm: true,
        dataType:  'json'
    };
    function showResponse(responseText, statusText)  {
        if(responseText.s == 1){

            alert("添加成功");
            var id=responseText.data;
            document.location.href="index.php?r=/education&page=questionnaire/add&id="+id;
        }else{
            $("#errormsg").html(responseText.data).show(300).delay(3000).hide(300);
        }
    }

    formObj.submit(function() {
        $(this).ajaxSubmit(options);
        return false;
    });
});
