
<div class="row-fluid">
    <!-- <div class="span12"> -->
    <div class="widget-box" style="margin-left:10px;margin-right:10px;border-bottom:1px solid #cdcdcd;">
        <div class="widget-box" style="margin-left:10px;margin-right:10px;">
            <div class="widget-title" > <span class="icon"> <i class="icon-info-sign"></i> </span>
                <h5>考试通知</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered ">
                    <thead>
                    <tr>

                        <th>科目</th>

                        <th>考试时间</th>

                        <th>备注</th>
                    </tr>
                    </thead>
                    <tbody id = "msg_body">


                    </tbody>
                </table>
            </div>
        </div>



        <script type="text/javascript">

            var tempList = null;

            $(document).ready(function(){

                getTopicMsg()

            });



            function getTopicMsg()
            {

                var url1 = "index.php?r=/education/exam/tz";
                $.ajax({
                    type: "get",
                    url: url1,
                    dataType: "json",

                    success: function(datas) {
                        var msg_body = $("#msg_body");
                        msg_body.empty();
                        var data = datas.data;
                        for (key in data)
                        {

                            var temp = "<tr>\
                    <td style='text-align:center'>"+data[key].title+"</td>\
                     <td style='text-align:center'>"+data[key].time+"</td>\
                      <td style='text-align:center'>"+data[key].desc+"</td>\
                       </tr>";

                            msg_body.append(temp);

                        }
                    },
                    error: function(data) {
                        alert("错误信息"+data.data);
                    }
                })
            }

        </script>

