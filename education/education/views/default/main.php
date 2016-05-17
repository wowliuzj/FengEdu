<script src="js/jquery.ui.custom.js">
</script>
<script src="js/store+json2.min.js">
</script>
<script src="js/jquery.uniform.js">
</script>
<script src="js/select2.min.js">
</script>
<script src="js/jquery.dataTables.min.js">
</script>
<script src="js/matrix.js">
</script>
<script src="js/matrix.tables.js">
</script>
<script src="js/jquery.validate.min.js">
</script>
<script src="js/messages_zh.min.js">
</script>
<script src="js/bootstrap-colorpicker.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/masked.js"></script>
<script src="js/matrix.form_common.js"></script>
<div id="header">
	<h1><a>凤凰教育</a></h1>
</div>
<?php 
    $isActive0 = "";
    $isActive1 = "";
    $isActive2 = "";
    $isActive3 = "";
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        if($page == 'homework/wall'){
            $isActive1 = "active";
        }elseif($page == 'qa/index'){
            $isActive2 = "active";
        }elseif($page == 'tz/index'){
            $isActive3 = "active";
        }else{
            $isActive0 = "active";    
        }
    }else{
        $isActive0 = "active";
    }
    
?>
<!--  nav bar begin-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">

    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text" id="welcomeId">欢迎</span></a></li>
    <li class=""><a title="" href="index.php?r=/education/admin/logout"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
    <li class=""><a title="" href="index.php?r=/education&page=admin/mod_pwd"><i class="icon icon-edit"></i> <span class="text">修改密码</span></a></li>
  </ul>
</div>

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> 主页</a>
    <ul>
        <li class="<?php echo $isActive0?>"><a href="index.php?r=/education&page=index"> <div class="helper-font-24"> <i class="icon icon-home"></i></div> <span>主页</span></a> </li>
        <li class="<?php echo $isActive1?>"> <a href="index.php?r=/education&page=homework/wall"><div class="helper-font-24"> <i class="icofont-dashboard"></i></div> <span>作业墙</span></a> </li>
        <li class="<?php echo $isActive2?>"> <a href="index.php?r=/education&page=qa/index" > <div class="helper-font-24"> <i class="icon icon-inbox"></i></div> <span >互动区</span></a> </li>
       <!-- <li class="<?php /*echo $isActive2*/?>"> <a href="index.php?r=/education&page=qa/index_teach" > <div class="helper-font-24"> <i class="icon icon-inbox"></i></div> <span >互动区</span></a> </li>
       --> <li id="tz_count_li" style="display:none" class="<?php echo $isActive3?>"> <a href="index.php?r=/education&page=tz/index" > <div class="helper-font-24"> <i class="icon icon-camera"></i></div> <span >通知（<span id="tz_count">0</span>）</span></a> </li>
    </ul>
</div>





<div id="content">
    <div class="quick-actions_homepage">
        <ul id="permission_list_ul_id" class="quick-actions" style="background:#ff0000">
        	
        </ul>
    </div>
    <div id="errormsg"></div>
    <?php
    	$page = $_REQUEST["page"];
        if($page === 'index'){
            include $page.'.html';
        }else{
            include $page.'.html';
        }
    	
    ?>
</div>
