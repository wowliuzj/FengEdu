app\education\models\Admin
app\education\models\
@app/education/views/
app\education\controllers\Controller

SELECT * from permission where p_id in (SELECT p_id from access where r_id in (1));

需要添加权限的页面，将其录入到permission里，p_name就是页面的路径，页面的位置放在\education\views\default下
写的时候，不需要带html，如学生的student.html,就写student

本功能的js和css分别放到\web\education\js、css下，这两个文件需要在自己的html页面头部导入

框架本身的js和css则放到\web\js、css下，这些公共的js和css需要在\views\layouts\main.php里导入


http://localhost/yii/index.php?r=/education/attent/mod-status&id_status=[{%22id%22:1,%22status%22:1}]



mysql -uroot -p123456 -h192.168.1.105 education < education.sql

分页使用方法（可以参考student/index.html）
1.<input type="hidden" name="page" id="page" value="1"/>
在自己的查询form表单加入这个hidden标签
2.使用以下这个div作为分页显示用
<div class="pagination pagination-right">
	<ul>
		<li id="liPageFirst">
			<a id="pageFirst" href="#">首页</a>
		</li>
		<li id="liPagePrevious">
			<a id="pagePrevious" href="#">上一页</a>
		</li>
		<li>
		   <a id="pageNo" href="#"></a>
		</li>
		<li id="liPageNext">
			<a id="pageNext" href="#">下一页</a>
		</li>
		<li id="liPageLast">
			<a id="pageLast" href="#">末页</a>
		</li>
	</ul>
</div>

3.在查询结果返回的函数里调用 pageSearch(clickSearch,data.data.pageNo);
	clickSearch是你调用查询的那个函数
4.在玩家点击查询按钮的时候，需要调用次方法，重置当前页$("#page").val(1);



 
 select `c`.`it_name` AS `it_name`,`b`.`score` AS `score`,`b`.`hid` AS `hid`,`b`.`id` AS `shid`,`b`.`sid` AS `sid`,`a`.`title` AS `title`,
 `a`.`desc` AS `desc`,`a`.`time` AS `time`,`a`.`img` AS `img`,`b`.`stime` AS `stime`,`b`.`simg` AS `simg`,`b`.`sdesc` AS `sdesc`,
 `b`.`ttime` AS `ttime`,`b`.`tdesc` AS `tdesc`,
 (select count(1) from `eval_work` where (`eval_work`.`shid` = `b`.`id`)) AS `ecount` 
 from ((`homework` `a` join `stu_work` `b`) join `info_teacher` `c`) where ((`a`.`id` = `b`.`hid`) and (`a`.`tid` = `c`.`it_id`))