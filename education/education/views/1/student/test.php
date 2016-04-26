<h1> <?=$hi["data"]["list"][0]["is_name"] ;?> </h1>

<?php 

echo "<table>"; 
echo "<caption>可编辑表格</caption>"; 
echo "<tr>"; 
echo "<th>编号</th><th>姓名</th><th>性别</th><th>年龄</th><th>邮箱</th>"; 
echo "</tr>"; 

 for( $i=0;$i<count($hi["data"]["list"]);$i++)
{
	

echo '<tr>'; 
echo '<td class="id">';echo $hi["data"]["list"][$i]["is_name"]; '</td>'; 
echo '<td>xiexie</td>'; 
echo '<td>13</td>'; 
echo '<td>male</td>'; 
echo '<td>aa@qq.com</td>'; 
echo '</tr>';
 } 
echo "</table>"; 
 ?>
<h1> helloworld</h1>