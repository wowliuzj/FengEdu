<link rel="stylesheet" href="css/colorpicker.css" />
<link rel="stylesheet" href="css/datepicker.css" />
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'> -->

<div class="row-fluid">
  <div class="widget-box">
    <div class="widget-content">
      <div class="widget-box">
        <div class="widget-title">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">记录出勤</a></li>
            <li><a data-toggle="tab" href="#tab2">出勤统计</a></li>
          </ul>
        </div>


        <!-- <div class="widget-box"> -->
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>

<!--             <div  data-date="12-02-2012" class="input-append date datepicker">
              <label class="control-label" style="margin-top:5px;">选择日期</label>
              <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" style="margin-top:-32px; margin-left:60px;">
              <span class="add-on" style="margin-top:-32px;"><i class="icon-th" ></i></span> 
            </div> -->
          </div>

<!--           <div class="control-group" style="margin-top:-29px; margin-left:40px;">
            <label class="control-label" style="">选择日期</label>
            <div  data-date="12-02-2012" class="input-append date datepicker" style="margin-left:60px; margin-top:-42px;">
              <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
              <span class="add-on"><i class="icon-th"></i></span> 
            </div>
          </div> -->

<!--           <div class="control-group" style="margin-top:-28px; margin-left:500px;">
            <label class="control-label">选择班级</label>
            <div class="controls" style="margin-left:65px; margin-top:-30px;">
              <select style="width:200px;">
                <option>1502</option>
                <option>1503</option>
                <option>1504</option>
                <option>1505</option>
                <option>1506</option>
                <option>1507</option>
                <option>1508</option>
                <option>1509</option>
              </select>
            </div>
          </div> -->
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>姓名</th>
                  <th>班级</th>
                  <th>日期</th>
                  <th>出勤状态</th>
                </tr>
              </thead>
              <tbody>
<?php 
              for($i=0; $i < count($hi["data"]["list"]); $i++)
              {
              echo " <tr class=\"gradeA\">
                      <td style=\"text-align:center\">";
                      echo $hi["data"]["list"][$i]["is_name"];
              echo "  </td>
                      <td style=\"text-align:center\">";
                      echo $hi["data"]["list"][$i]["is_grade"];
              echo "  </td>
                      <td style=\"text-align:center\">";
                      echo $hi["data"]["list"][$i]["is_birthday"];
              echo "  </td>
                      <td style=\"text-align:center; width:520px;\">
                        <select style=\"width:200px;\">
                          <option>正常</option>
                          <option>迟到</option>
                          <option>早退</option>
                          <option>旷课</option>
                          <option>事假</option>
                          <option>病假</option>
                        </select>
                      </td>
                    </tr>";
              }
?> 
              </tbody>
            </table>
          </div>
    </div>
  </div>
</div>


<script src="js/jquery.ui.custom.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>


<script src="js/bootstrap-colorpicker.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 
<script src="js/jquery.toggle.buttons.html"></script> 
<script src="js/masked.js"></script> 
<script src="js/matrix.form_common.js"></script> 
<script src="js/wysihtml5-0.3.0.js"></script> 
<script src="js/bootstrap-wysihtml5.js"></script> 
