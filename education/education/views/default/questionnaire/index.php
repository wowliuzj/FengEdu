

<div id="divNotRun" style="height:100px; text-align:center; display:none;"></div>
<div id="jqContent" class="" style="text-align: left; ">
    <div id="headerCss" style="overflow-x: hidden; overflow-y: hidden; ">
        <div id="ctl00_header"><div style="display:none;"></div></div>
    </div>
    <div id="mainCss">
        <div id="mainInner">
            <div id="box">
                <script type="text/javascript" src="/js/zhezhao.js?v=1"></script>

                <style>

                </style>
                <div class="survey" style="margin:0px auto;">

                    <div id="ctl00_ContentPlaceHolder1_JQ1_divHead" class="surveyhead" style="border: 0px;">
                        <h1 id="ctl00_ContentPlaceHolder1_JQ1_h1Name" style="position:relative;">
                            <span id="ctl00_ContentPlaceHolder1_JQ1_lblQuestionnaireName">企业员工满意度调查问卷</span><span id="ctl00_ContentPlaceHolder1_JQ1_lblMobile" style="position:absolute; right:-10px; top:6px;"><a href="javascript:;" onclick="showData(event,this,&quot;https://www.sojump.com/m/3048945.aspx&quot;,0);" style="display:inline-block;width:50px;height:50px;background:url(&quot;//down.sojump.com/handler/qrcode.ashx?chs=50x50&amp;chl=https%3a%2f%2fwww.sojump.com%2fm%2f3048945.aspx&quot;) no-repeat;"></a></span>

                        </h1>
                        <div id="ctl00_ContentPlaceHolder1_JQ1_divMob">
                            <div id="divMa" style="display:none; position:absolute; z-index:100;border:1px solid #DBDBDB;width:200px; height:220px; background:white;" onclick="showData(event);">
                                <div style="text-align:center;">
                                    <a href="javascript:" style="border:none;"><img src="" alt="" width="200" height="200"></a>
                                    <div>手机扫描二维码答题</div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function showData(event, obj, src,needClick) {
                                    var d = document.getElementById("divMa");
                                    var img = d.getElementsByTagName("img")[0];
                                    if (!img.hasset) {
                                        img.src = "//down.sojump.com/handler/qrcode.ashx?chs=200x200&chl=" + encodeURIComponent(src);
                                        img.hasset = true;
                                        if(needClick){
                                            img.parentNode.href=src;
                                            img.parentNode.target="_blank";
                                        }
                                    }
                                    PDF_launch("divMa",260,260);
                                    return false;
                                }
                            </script>
                        </div>





                        <div style="clear: both;">
                        </div>
                        <script type="text/javascript">
                            var hasQJump =1;
                        </script>

                        <div id="ctl00_ContentPlaceHolder1_JQ1_divJump">
                            <div id="divS" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; position: absolute; z-index: 30000; width: 1423px; height: 3000px; left: 0px; top: 0px; opacity: 0.61; display: none;">
                            </div>
                            <div id="loadbox" style="border: 2px solid rgb(31, 73, 125); position: absolute; top: 300px; left: 546.5px; font-size: 12px; width: 400px; height: 100px; background-color: rgb(79, 129, 189); text-align: center; color: rgb(255, 255, 255); z-index: 50000; display: none;">
                                <div style="height: 30px; padding: 2px; text-align: left;">问卷正在加载中，请稍候...</div>
                                <img src="/GreyBox/ajax-loading.gif" width="160" height="20">
                                <div style="color: Red; margin: 5px 0; font-size:14px;">如果由于网络原因导致此框一直不消失，请重新刷新页面！</div>
                            </div>
                            <script type="text/javascript">
                                function jumpNotLoaded(){
                                    var bodyWidth = document.documentElement.clientWidth || document.body.clientWidth;
                                    var midX = (bodyWidth - 330) / 2;
                                    document.getElementById("loadbox").style.left = midX + "px";
                                    document.getElementById("divS").style.width=bodyWidth+"px";
                                }
                                jumpNotLoaded();
                                function jqLoaded() {
                                    var ele_a = document.getElementById("loadbox");
                                    var divS = document.getElementById("divS");
                                    ele_a.style.display = "none";
                                    divS.style.display = "none";
                                }
                            </script>
                        </div>


                        <div id="ctl00_ContentPlaceHolder1_JQ1_divDec" class="surveydescription">
        <span id="ctl00_ContentPlaceHolder1_JQ1_lblQuestionnaireDescription" style="vertical-align: middle;">尊敬的女士/先生：<br>
    您好！感谢您在百忙之中填写问卷，请您根据自己的实际感受和看法如实填写，本问卷采用匿名形式，所有数据仅供学术研究分析使用。<br>
    敬祝身体健康，万事如意！</span>
                        </div>
                        <div style="clear: both;">
                        </div>






                    </div>

                    <div id="ctl00_ContentPlaceHolder1_JQ1_question" class="surveycontent">
                        <div id="divMaxTime" style="text-align: center; display: none; width:80px; background:white; position:fixed;top:135px;border:1px solid #dbdbdb; padding:8px;z-index:10;">
                            <div id="spanTimeTip" style="border-bottom:1px solid #dbdbdb;height:30px; line-height:30px;">本页时间剩余</div><div style="color: Red;font-size:16px; height:30px; line-height:30px;" id="spanMaxTime"></div></div>
                        <div id="ctl00_ContentPlaceHolder1_JQ1_surveyContent"><fieldset class="fieldset" id="fieldset1"><div id="divCut1" qtopic="1" topic="c1"><div class="div_title_cut_question"><b>一、您的基本情况</b></div></div><div class="div_question" id="div1"><div class="div_title_question_all"><div id="divTitle1" class="div_title_question">1、	您的性别：<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion1"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width: 49%;"><a href="javascript:" class="jqRadio" rel="q1_1"></a><input style="display:none;" name="q1" id="q1_1" value="1" type="radio"><label for="q1_1">A 男</label></li><li style="width:49%;"><a href="javascript:" class="jqRadio" rel="q1_2"></a><input style="display:none;" name="q1" id="q1_2" value="2" type="radio"><label for="q1_2">B 女</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div2"><div class="div_title_question_all"><div id="divTitle2" class="div_title_question">2、	您的年龄：<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion2"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width: 24%;"><a href="javascript:" class="jqRadio" rel="q2_1"></a><input style="display:none;" name="q2" id="q2_1" value="1" type="radio"><label for="q2_1">A 25岁以下</label></li><li style="width: 24%;"><a href="javascript:" class="jqRadio" rel="q2_2"></a><input style="display:none;" name="q2" id="q2_2" value="2" type="radio"><label for="q2_2">B 26-35岁</label></li><li style="width:24%;"><a href="javascript:" class="jqRadio" rel="q2_3"></a><input style="display:none;" name="q2" id="q2_3" value="3" type="radio"><label for="q2_3">C 36-45岁</label></li><li style="width:24%;"><a href="javascript:" class="jqRadio" rel="q2_4"></a><input style="display:none;" name="q2" id="q2_4" value="4" type="radio"><label for="q2_4">D 45岁以上</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div3"><div class="div_title_question_all"><div id="divTitle3" class="div_title_question">3、	您的最高学历：<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion3"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width: 24%;"><a href="javascript:" class="jqRadio" rel="q3_1"></a><input style="display:none;" name="q3" id="q3_1" value="1" type="radio"><label for="q3_1">A高中/中专及以下</label></li><li style="width:24%;"><a href="javascript:" class="jqRadio" rel="q3_2"></a><input style="display:none;" name="q3" id="q3_2" value="2" type="radio"><label for="q3_2">B大专</label></li><li style="width:24%;"><a href="javascript:" class="jqRadio" rel="q3_3"></a><input style="display:none;" name="q3" id="q3_3" value="3" type="radio"><label for="q3_3">C本科</label></li><li style="width:24%;"><a href="javascript:" class="jqRadio" rel="q3_4"></a><input style="display:none;" name="q3" id="q3_4" value="4" type="radio"><label for="q3_4">D硕士及以上</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div4"><div class="div_title_question_all"><div id="divTitle4" class="div_title_question">4、	您的工作年限：<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion4"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q4_1"></a><input style="display:none;" name="q4" id="q4_1" value="1" type="radio"><label for="q4_1">A 0-3个月</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q4_2"></a><input style="display:none;" name="q4" id="q4_2" value="2" type="radio"><label for="q4_2">B 3-6个月</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q4_3"></a><input style="display:none;" name="q4" id="q4_3" value="3" type="radio"><label for="q4_3">C6个月-1年</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q4_4"></a><input style="display:none;" name="q4" id="q4_4" value="4" type="radio"><label for="q4_4">D1-2年</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q4_5"></a><input style="display:none;" name="q4" id="q4_5" value="5" type="radio"><label for="q4_5">E 2年以上</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div5"><div class="div_title_question_all"><div id="divTitle5" class="div_title_question">5、您的工作类型： <span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion5"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:32.333%;"><a href="javascript:" class="jqRadio" rel="q5_1"></a><input style="display:none;" name="q5" id="q5_1" value="1" type="radio"><label for="q5_1">A．销售类</label></li><li style="width:32.333%;"><a href="javascript:" class="jqRadio" rel="q5_2"></a><input style="display:none;" name="q5" id="q5_2" value="2" type="radio"><label for="q5_2">B．支持辅助类</label></li><li style="width:32.333%;"><a href="javascript:" class="jqRadio" rel="q5_3"></a><input style="display:none;" name="q5" id="q5_3" value="3" type="radio"><label for="q5_3">C. 管理类</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div id="divCut2" qtopic="6" topic="c2"><div class="div_title_cut_question">二、对工作本身的满意度</div></div><div class="div_question" id="div6"><div class="div_title_question_all"><div id="divTitle6" class="div_title_question">1、您对本人的工作岗位是否感到满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion6"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q6_1"></a><input style="display:none;" name="q6" id="q6_1" value="1" type="radio"><label for="q6_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q6_2"></a><input style="display:none;" name="q6" id="q6_2" value="2" type="radio"><label for="q6_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q6_3"></a><input style="display:none;" name="q6" id="q6_3" value="3" type="radio"><label for="q6_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q6_4"></a><input style="display:none;" name="q6" id="q6_4" value="4" type="radio"><label for="q6_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q6_5"></a><input style="display:none;" name="q6" id="q6_5" value="5" type="radio"><label for="q6_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div7"><div class="div_title_question_all"><div id="divTitle7" class="div_title_question">2、您对您与工作的匹配程度是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion7"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q7_1"></a><input style="display:none;" name="q7" id="q7_1" value="1" type="radio"><label for="q7_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q7_2"></a><input style="display:none;" name="q7" id="q7_2" value="2" type="radio"><label for="q7_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q7_3"></a><input style="display:none;" name="q7" id="q7_3" value="3" type="radio"><label for="q7_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q7_4"></a><input style="display:none;" name="q7" id="q7_4" value="4" type="radio"><label for="q7_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q7_5"></a><input style="display:none;" name="q7" id="q7_5" value="5" type="radio"><label for="q7_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div8"><div class="div_title_question_all"><div id="divTitle8" class="div_title_question">3、您的工作是否符合个人志趣？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion8"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q8_1"></a><input style="display:none;" name="q8" id="q8_1" value="1" type="radio"><label for="q8_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q8_2"></a><input style="display:none;" name="q8" id="q8_2" value="2" type="radio"><label for="q8_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q8_3"></a><input style="display:none;" name="q8" id="q8_3" value="3" type="radio"><label for="q8_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q8_4"></a><input style="display:none;" name="q8" id="q8_4" value="4" type="radio"><label for="q8_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q8_5"></a><input style="display:none;" name="q8" id="q8_5" value="5" type="radio"><label for="q8_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div9"><div class="div_title_question_all"><div id="divTitle9" class="div_title_question">4、您对您岗位职责与权力的划分是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion9"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q9_1"></a><input style="display:none;" name="q9" id="q9_1" value="1" type="radio"><label for="q9_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q9_2"></a><input style="display:none;" name="q9" id="q9_2" value="2" type="radio"><label for="q9_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q9_3"></a><input style="display:none;" name="q9" id="q9_3" value="3" type="radio"><label for="q9_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q9_4"></a><input style="display:none;" name="q9" id="q9_4" value="4" type="radio"><label for="q9_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q9_5"></a><input style="display:none;" name="q9" id="q9_5" value="5" type="radio"><label for="q9_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div id="divCut3" qtopic="10" topic="c3"><div class="div_title_cut_question">三、对工作回报与发展的满意度</div></div><div class="div_question" id="div10"><div class="div_title_question_all"><div id="divTitle10" class="div_title_question">1、您对您的目前的薪资水平是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion10"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q10_1"></a><input style="display:none;" name="q10" id="q10_1" value="1" type="radio"><label for="q10_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q10_2"></a><input style="display:none;" name="q10" id="q10_2" value="2" type="radio"><label for="q10_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q10_3"></a><input style="display:none;" name="q10" id="q10_3" value="3" type="radio"><label for="q10_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q10_4"></a><input style="display:none;" name="q10" id="q10_4" value="4" type="radio"><label for="q10_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q10_5"></a><input style="display:none;" name="q10" id="q10_5" value="5" type="radio"><label for="q10_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div11"><div class="div_title_question_all"><div id="divTitle11" class="div_title_question">2、您对公司报酬、奖励的公平性是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion11"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q11_1"></a><input style="display:none;" name="q11" id="q11_1" value="1" type="radio"><label for="q11_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q11_2"></a><input style="display:none;" name="q11" id="q11_2" value="2" type="radio"><label for="q11_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q11_3"></a><input style="display:none;" name="q11" id="q11_3" value="3" type="radio"><label for="q11_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q11_4"></a><input style="display:none;" name="q11" id="q11_4" value="4" type="radio"><label for="q11_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q11_5"></a><input style="display:none;" name="q11" id="q11_5" value="5" type="radio"><label for="q11_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div12"><div class="div_title_question_all"><div id="divTitle12" class="div_title_question">3、你认为公司的激励奖励制度完善吗？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion12"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q12_1"></a><input style="display:none;" name="q12" id="q12_1" value="1" type="radio"><label for="q12_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q12_2"></a><input style="display:none;" name="q12" id="q12_2" value="2" type="radio"><label for="q12_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q12_3"></a><input style="display:none;" name="q12" id="q12_3" value="3" type="radio"><label for="q12_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q12_4"></a><input style="display:none;" name="q12" id="q12_4" value="4" type="radio"><label for="q12_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q12_5"></a><input style="display:none;" name="q12" id="q12_5" value="5" type="radio"><label for="q12_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div13"><div class="div_title_question_all"><div id="divTitle13" class="div_title_question">4、您对当前员工的福利政策是否感到满意?<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion13"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q13_1"></a><input style="display:none;" name="q13" id="q13_1" value="1" type="radio"><label for="q13_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q13_2"></a><input style="display:none;" name="q13" id="q13_2" value="2" type="radio"><label for="q13_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q13_3"></a><input style="display:none;" name="q13" id="q13_3" value="3" type="radio"><label for="q13_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q13_4"></a><input style="display:none;" name="q13" id="q13_4" value="4" type="radio"><label for="q13_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q13_5"></a><input style="display:none;" name="q13" id="q13_5" value="5" type="radio"><label for="q13_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div14"><div class="div_title_question_all"><div id="divTitle14" class="div_title_question">5、您对个人的职场发展情况是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion14"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width: 19%;"><a href="javascript:" class="jqRadio" rel="q14_1"></a><input style="display:none;" name="q14" id="q14_1" value="1" type="radio"><label for="q14_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q14_2"></a><input style="display:none;" name="q14" id="q14_2" value="2" type="radio"><label for="q14_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q14_3"></a><input style="display:none;" name="q14" id="q14_3" value="3" type="radio"><label for="q14_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q14_4"></a><input style="display:none;" name="q14" id="q14_4" value="4" type="radio"><label for="q14_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q14_5"></a><input style="display:none;" name="q14" id="q14_5" value="5" type="radio"><label for="q14_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div id="divCut4" qtopic="15" topic="c4"><div class="div_title_cut_question">四、对领导管理的满意度</div></div><div class="div_question" id="div15"><div class="div_title_question_all"><div id="divTitle15" class="div_title_question">1、您对公司高层领导管理者的管理能力与水平是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion15"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q15_1"></a><input style="display:none;" name="q15" id="q15_1" value="1" type="radio"><label for="q15_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q15_2"></a><input style="display:none;" name="q15" id="q15_2" value="2" type="radio"><label for="q15_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q15_3"></a><input style="display:none;" name="q15" id="q15_3" value="3" type="radio"><label for="q15_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q15_4"></a><input style="display:none;" name="q15" id="q15_4" value="4" type="radio"><label for="q15_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q15_5"></a><input style="display:none;" name="q15" id="q15_5" value="5" type="radio"><label for="q15_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div16"><div class="div_title_question_all"><div id="divTitle16" class="div_title_question">2、您对直接上级的管理能力与业务水平是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion16"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q16_1"></a><input style="display:none;" name="q16" id="q16_1" value="1" type="radio"><label for="q16_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q16_2"></a><input style="display:none;" name="q16" id="q16_2" value="2" type="radio"><label for="q16_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q16_3"></a><input style="display:none;" name="q16" id="q16_3" value="3" type="radio"><label for="q16_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q16_4"></a><input style="display:none;" name="q16" id="q16_4" value="4" type="radio"><label for="q16_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q16_5"></a><input style="display:none;" name="q16" id="q16_5" value="5" type="radio"><label for="q16_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div17"><div class="div_title_question_all"><div id="divTitle17" class="div_title_question">3、您对领导的亲和力和决策力是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion17"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q17_1"></a><input style="display:none;" name="q17" id="q17_1" value="1" type="radio"><label for="q17_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q17_2"></a><input style="display:none;" name="q17" id="q17_2" value="2" type="radio"><label for="q17_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q17_3"></a><input style="display:none;" name="q17" id="q17_3" value="3" type="radio"><label for="q17_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q17_4"></a><input style="display:none;" name="q17" id="q17_4" value="4" type="radio"><label for="q17_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q17_5"></a><input style="display:none;" name="q17" id="q17_5" value="5" type="radio"><label for="q17_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div18"><div class="div_title_question_all"><div id="divTitle18" class="div_title_question">4、您对管理阶层对员工执行工作提供的支持满意程度如何？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion18"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q18_1"></a><input style="display:none;" name="q18" id="q18_1" value="1" type="radio"><label for="q18_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q18_2"></a><input style="display:none;" name="q18" id="q18_2" value="2" type="radio"><label for="q18_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q18_3"></a><input style="display:none;" name="q18" id="q18_3" value="3" type="radio"><label for="q18_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q18_4"></a><input style="display:none;" name="q18" id="q18_4" value="4" type="radio"><label for="q18_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q18_5"></a><input style="display:none;" name="q18" id="q18_5" value="5" type="radio"><label for="q18_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div19"><div class="div_title_question_all"><div id="divTitle19" class="div_title_question">5、您对公司的职位晋升机制是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion19"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q19_1"></a><input style="display:none;" name="q19" id="q19_1" value="1" type="radio"><label for="q19_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q19_2"></a><input style="display:none;" name="q19" id="q19_2" value="2" type="radio"><label for="q19_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q19_3"></a><input style="display:none;" name="q19" id="q19_3" value="3" type="radio"><label for="q19_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q19_4"></a><input style="display:none;" name="q19" id="q19_4" value="4" type="radio"><label for="q19_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q19_5"></a><input style="display:none;" name="q19" id="q19_5" value="5" type="radio"><label for="q19_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div20"><div class="div_title_question_all"><div id="divTitle20" class="div_title_question">6、您对领导和员工之间的沟通交流情况满意吗？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion20"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q20_1"></a><input style="display:none;" name="q20" id="q20_1" value="1" type="radio"><label for="q20_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q20_2"></a><input style="display:none;" name="q20" id="q20_2" value="2" type="radio"><label for="q20_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q20_3"></a><input style="display:none;" name="q20" id="q20_3" value="3" type="radio"><label for="q20_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q20_4"></a><input style="display:none;" name="q20" id="q20_4" value="4" type="radio"><label for="q20_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q20_5"></a><input style="display:none;" name="q20" id="q20_5" value="5" type="radio"><label for="q20_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div id="divCut5" qtopic="21" topic="c5"><div class="div_title_cut_question">五、对工作环境与背景的满意度</div></div><div class="div_question" id="div21"><div class="div_title_question_all"><div id="divTitle21" class="div_title_question">1、您认为工作环境、设施设备的健康和安全预防措施是否足够且让人满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion21"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q21_1"></a><input style="display:none;" name="q21" id="q21_1" value="1" type="radio"><label for="q21_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q21_2"></a><input style="display:none;" name="q21" id="q21_2" value="2" type="radio"><label for="q21_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q21_3"></a><input style="display:none;" name="q21" id="q21_3" value="3" type="radio"><label for="q21_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q21_4"></a><input style="display:none;" name="q21" id="q21_4" value="4" type="radio"><label for="q21_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q21_5"></a><input style="display:none;" name="q21" id="q21_5" value="5" type="radio"><label for="q21_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div22"><div class="div_title_question_all"><div id="divTitle22" class="div_title_question">2、您对公司提供的工作中需要的资源(材料、设施、工具)是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion22"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q22_1"></a><input style="display:none;" name="q22" id="q22_1" value="1" type="radio"><label for="q22_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q22_2"></a><input style="display:none;" name="q22" id="q22_2" value="2" type="radio"><label for="q22_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q22_3"></a><input style="display:none;" name="q22" id="q22_3" value="3" type="radio"><label for="q22_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q22_4"></a><input style="display:none;" name="q22" id="q22_4" value="4" type="radio"><label for="q22_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q22_5"></a><input style="display:none;" name="q22" id="q22_5" value="5" type="radio"><label for="q22_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div23"><div class="div_title_question_all"><div id="divTitle23" class="div_title_question">3、您对公司的作息时间(上下班时间、加班制度等)是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion23"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q23_1"></a><input style="display:none;" name="q23" id="q23_1" value="1" type="radio"><label for="q23_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q23_2"></a><input style="display:none;" name="q23" id="q23_2" value="2" type="radio"><label for="q23_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q23_3"></a><input style="display:none;" name="q23" id="q23_3" value="3" type="radio"><label for="q23_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q23_4"></a><input style="display:none;" name="q23" id="q23_4" value="4" type="radio"><label for="q23_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q23_5"></a><input style="display:none;" name="q23" id="q23_5" value="5" type="radio"><label for="q23_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div24"><div class="div_title_question_all"><div id="divTitle24" class="div_title_question">4、您是否能及时了解公司各种管理制度和文件？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion24"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q24_1"></a><input style="display:none;" name="q24" id="q24_1" value="1" type="radio"><label for="q24_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q24_2"></a><input style="display:none;" name="q24" id="q24_2" value="2" type="radio"><label for="q24_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q24_3"></a><input style="display:none;" name="q24" id="q24_3" value="3" type="radio"><label for="q24_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q24_4"></a><input style="display:none;" name="q24" id="q24_4" value="4" type="radio"><label for="q24_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q24_5"></a><input style="display:none;" name="q24" id="q24_5" value="5" type="radio"><label for="q24_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div25"><div class="div_title_question_all"><div id="divTitle25" class="div_title_question">5、您对公司文体、娱乐活动的安排感到满意吗？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion25"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q25_1"></a><input style="display:none;" name="q25" id="q25_1" value="1" type="radio"><label for="q25_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q25_2"></a><input style="display:none;" name="q25" id="q25_2" value="2" type="radio"><label for="q25_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q25_3"></a><input style="display:none;" name="q25" id="q25_3" value="3" type="radio"><label for="q25_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q25_4"></a><input style="display:none;" name="q25" id="q25_4" value="4" type="radio"><label for="q25_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q25_5"></a><input style="display:none;" name="q25" id="q25_5" value="5" type="radio"><label for="q25_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div26"><div class="div_title_question_all"><div id="divTitle26" class="div_title_question">6、您提出合理化建议，公司对合理化建议的处理和态度您感到满意吗？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion26"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q26_1"></a><input style="display:none;" name="q26" id="q26_1" value="1" type="radio"><label for="q26_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q26_2"></a><input style="display:none;" name="q26" id="q26_2" value="2" type="radio"><label for="q26_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q26_3"></a><input style="display:none;" name="q26" id="q26_3" value="3" type="radio"><label for="q26_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q26_4"></a><input style="display:none;" name="q26" id="q26_4" value="4" type="radio"><label for="q26_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q26_5"></a><input style="display:none;" name="q26" id="q26_5" value="5" type="radio"><label for="q26_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div id="divCut6" qtopic="27" topic="c6"><div class="div_title_cut_question">六、对工作关系的满意度</div></div><div class="div_question" id="div27"><div class="div_title_question_all"><div id="divTitle27" class="div_title_question">1、您对同事之间的沟通与配合是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion27"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q27_1"></a><input style="display:none;" name="q27" id="q27_1" value="1" type="radio"><label for="q27_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q27_2"></a><input style="display:none;" name="q27" id="q27_2" value="2" type="radio"><label for="q27_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q27_3"></a><input style="display:none;" name="q27" id="q27_3" value="3" type="radio"><label for="q27_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q27_4"></a><input style="display:none;" name="q27" id="q27_4" value="4" type="radio"><label for="q27_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q27_5"></a><input style="display:none;" name="q27" id="q27_5" value="5" type="radio"><label for="q27_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div28"><div class="div_title_question_all"><div id="divTitle28" class="div_title_question">2、您对您和周围同事的工作责任感及主动性满意吗？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion28"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q28_1"></a><input style="display:none;" name="q28" id="q28_1" value="1" type="radio"><label for="q28_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q28_2"></a><input style="display:none;" name="q28" id="q28_2" value="2" type="radio"><label for="q28_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q28_3"></a><input style="display:none;" name="q28" id="q28_3" value="3" type="radio"><label for="q28_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q28_4"></a><input style="display:none;" name="q28" id="q28_4" value="4" type="radio"><label for="q28_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q28_5"></a><input style="display:none;" name="q28" id="q28_5" value="5" type="radio"><label for="q28_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div29"><div class="div_title_question_all"><div id="divTitle29" class="div_title_question">3、你认为公司员工是否得到公正对待？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion29"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q29_1"></a><input style="display:none;" name="q29" id="q29_1" value="1" type="radio"><label for="q29_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q29_2"></a><input style="display:none;" name="q29" id="q29_2" value="2" type="radio"><label for="q29_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q29_3"></a><input style="display:none;" name="q29" id="q29_3" value="3" type="radio"><label for="q29_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q29_4"></a><input style="display:none;" name="q29" id="q29_4" value="4" type="radio"><label for="q29_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q29_5"></a><input style="display:none;" name="q29" id="q29_5" value="5" type="radio"><label for="q29_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div30"><div class="div_title_question_all"><div id="divTitle30" class="div_title_question">4、您认为公司团队协作是否默契？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion30"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q30_1"></a><input style="display:none;" name="q30" id="q30_1" value="1" type="radio"><label for="q30_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q30_2"></a><input style="display:none;" name="q30" id="q30_2" value="2" type="radio"><label for="q30_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q30_3"></a><input style="display:none;" name="q30" id="q30_3" value="3" type="radio"><label for="q30_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q30_4"></a><input style="display:none;" name="q30" id="q30_4" value="4" type="radio"><label for="q30_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q30_5"></a><input style="display:none;" name="q30" id="q30_5" value="5" type="radio"><label for="q30_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div31"><div class="div_title_question_all"><div id="divTitle31" class="div_title_question">5、你对公司人员分工是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion31"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q31_1"></a><input style="display:none;" name="q31" id="q31_1" value="1" type="radio"><label for="q31_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q31_2"></a><input style="display:none;" name="q31" id="q31_2" value="2" type="radio"><label for="q31_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q31_3"></a><input style="display:none;" name="q31" id="q31_3" value="3" type="radio"><label for="q31_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q31_4"></a><input style="display:none;" name="q31" id="q31_4" value="4" type="radio"><label for="q31_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q31_5"></a><input style="display:none;" name="q31" id="q31_5" value="5" type="radio"><label for="q31_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div id="divCut7" qtopic="32" topic="c7"><div class="div_title_cut_question">七、对企业整体的满意度</div></div><div class="div_question" id="div32"><div class="div_title_question_all"><div id="divTitle32" class="div_title_question">1、您对公司的历史、公司文化是否满意<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion32"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q32_1"></a><input style="display:none;" name="q32" id="q32_1" value="1" type="radio"><label for="q32_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q32_2"></a><input style="display:none;" name="q32" id="q32_2" value="2" type="radio"><label for="q32_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q32_3"></a><input style="display:none;" name="q32" id="q32_3" value="3" type="radio"><label for="q32_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q32_4"></a><input style="display:none;" name="q32" id="q32_4" value="4" type="radio"><label for="q32_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q32_5"></a><input style="display:none;" name="q32" id="q32_5" value="5" type="radio"><label for="q32_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div33"><div class="div_title_question_all"><div id="divTitle33" class="div_title_question">2、您对公司组织机构的设置是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion33"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q33_1"></a><input style="display:none;" name="q33" id="q33_1" value="1" type="radio"><label for="q33_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q33_2"></a><input style="display:none;" name="q33" id="q33_2" value="2" type="radio"><label for="q33_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q33_3"></a><input style="display:none;" name="q33" id="q33_3" value="3" type="radio"><label for="q33_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q33_4"></a><input style="display:none;" name="q33" id="q33_4" value="4" type="radio"><label for="q33_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q33_5"></a><input style="display:none;" name="q33" id="q33_5" value="5" type="radio"><label for="q33_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div34"><div class="div_title_question_all"><div id="divTitle34" class="div_title_question">3、您对公司各项规章制度的实施效果感到满意吗？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion34"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q34_1"></a><input style="display:none;" name="q34" id="q34_1" value="1" type="radio"><label for="q34_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q34_2"></a><input style="display:none;" name="q34" id="q34_2" value="2" type="radio"><label for="q34_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q34_3"></a><input style="display:none;" name="q34" id="q34_3" value="3" type="radio"><label for="q34_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q34_4"></a><input style="display:none;" name="q34" id="q34_4" value="4" type="radio"><label for="q34_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q34_5"></a><input style="display:none;" name="q34" id="q34_5" value="5" type="radio"><label for="q34_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div35"><div class="div_title_question_all"><div id="divTitle35" class="div_title_question">4、对您来说，您对公司有认同感及归属感吗？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion35"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q35_1"></a><input style="display:none;" name="q35" id="q35_1" value="1" type="radio"><label for="q35_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q35_2"></a><input style="display:none;" name="q35" id="q35_2" value="2" type="radio"><label for="q35_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q35_3"></a><input style="display:none;" name="q35" id="q35_3" value="3" type="radio"><label for="q35_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q35_4"></a><input style="display:none;" name="q35" id="q35_4" value="4" type="radio"><label for="q35_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q35_5"></a><input style="display:none;" name="q35" id="q35_5" value="5" type="radio"><label for="q35_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div36"><div class="div_title_question_all"><div id="divTitle36" class="div_title_question">5、你对公司以及行业的发展前景是否满意？<span class="req">&nbsp;*</span></div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion36"><div class="div_table_clear_top"></div><ul class="ulradiocheck"><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q36_1"></a><input style="display:none;" name="q36" id="q36_1" value="1" type="radio"><label for="q36_1">A 很满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q36_2"></a><input style="display:none;" name="q36" id="q36_2" value="2" type="radio"><label for="q36_2">B 满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q36_3"></a><input style="display:none;" name="q36" id="q36_3" value="3" type="radio"><label for="q36_3">C 一般</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q36_4"></a><input style="display:none;" name="q36" id="q36_4" value="4" type="radio"><label for="q36_4">D 不满意</label></li><li style="width:19%;"><a href="javascript:" class="jqRadio" rel="q36_5"></a><input style="display:none;" name="q36" id="q36_5" value="5" type="radio"><label for="q36_5">E 极不满意</label></li><div style="clear:both;"></div></ul><ul class="ulradiocheck"><div style="clear:both;"></div></ul><div style="clear:both;"></div><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div37"><div class="div_title_question_all"><div id="divTitle37" class="div_title_question">1、您对公司目前实施的工资方案的建议和意见：</div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion37"><div class="div_table_clear_top"></div><textarea title="" style="overflow: auto;width:62%;height:88px;" class="inputtext" value="" id="q37" name="q37"></textarea><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div38"><div class="div_title_question_all"><div id="divTitle38" class="div_title_question">2、你认为公司目前的福利政策还需进行哪方面的改善？</div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion38"><div class="div_table_clear_top"></div><textarea title="" style="overflow: auto;width:62%;height:110px;" class="inputtext" value="" id="q38" name="q38"></textarea><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div class="div_question" id="div39"><div class="div_title_question_all"><div id="divTitle39" class="div_title_question">3、	您希望公司未来做哪些方面的工作？(如公司战略规划、企业文化建设、员工职业规划、沟通渠道的建设等等)：</div><div style="clear:both;"></div></div><div class="div_table_radio_question" id="divquestion39"><div class="div_table_clear_top"></div><textarea title="" style="overflow: auto;width:62%;height:88px;" class="inputtext" value="" id="q39" name="q39"></textarea><div class="div_table_clear_bottom"></div></div><div class="errorMessage"></div></div><div id="divCut8" qtopic="40" topic="c8"><div class="div_title_cut_question">再次感谢您对本次调查活动的参与</div></div></fieldset></div>
                        <div class="shopcart" id="shopcart" style="display:none;">
                        </div>
                        <div style="padding-top: 6px;clear:both; padding-bottom:10px;" id="submit_div">

                            <table id="submit_table" style="margin: 20px auto;">

                                <tbody><tr>
                                    <td id="ctl00_ContentPlaceHolder1_JQ1_tdCode" style="display:;">
                                        <input id="yucinput" size="14" maxlength="10" onkeydown="enter_clicksub(event);" name="yucinput" class="inputtext" style="height:24px;line-height:24px;" type="text">&nbsp;&nbsp;<img id="imgCode" alt="验证码" title="看不清吗？点击可以刷新" style="vertical-align: bottom; cursor:pointer; display:none;">
                                    </td>

                                    <td>
                                        <div id="divCaptcha" style="display: none;">
                                            <img alt="验证码" title="看不清吗？点击可以刷新" captchaid="DesignerInitializedCaptcha" instanceid="73b78fd73e6643d9a563db8e28e98a8e">
                                        </div>
                                    </td>
                                    <td>

                                        <input class="submitbutton" value="提交答卷" onmouseout="this.className='submitbutton';" id="submit_button" style="padding: 0 24px; height: 32px;" type="button">


                                    </td>

                                    <td>


                                    </td>

                                    <td style="position: relative;" align="right">
        <span id="spanTest" style="display: none; position: absolute; width: 120px; top: 5px;">
            <input class="finish cancle" value="试填问卷" id="submittest_button" title="只有发布者才能看到试填按钮，试填的答卷不会参与结果统计！" type="button"><a title="只有发布者才能看到试填按钮，试填的答卷不会参与结果统计！" onclick="alert(this.title);" style="color: green" href="javascript:void(0);"><b>(?)</b></a></span>
                                    </td>



                                    <td valign="bottom" align="right"></td>

                                </tr>
                                </tbody></table>
                            <div style="clear: both;"></div>

                        </div>
                        <div id="submit_tip" style="display: none; background-color: #f04810; color: White; margin-bottom: 20px; padding: 10px">
                        </div>
                        <div id="divMatrixRel" style="position: absolute; display: none; width: 300px; margin: 0 10%;">
                            <input id="matrixinput" style="width: 100%; height: 24px; line-height: 24px; color: #8c8c8c;" class="inputtext" type="text">
                        </div>
                        <div style="display: none;" id="divNA">
                            <input value="1" name="divNA" id="divNA_1" type="radio"><label for="divNA_1">A.男</label><input value="2" name="divNA" id="divNA_2" type="radio"><label for="divNA_1">B.女</label>
                        </div>
                    </div>

                    <div id="ctl00_ContentPlaceHolder1_JQ1_divLeftBar" style="text-align: center; position: absolute; width: 50px; padding: 8px 0px; left: 1172px; top: 204.5px;" class="leftbar">
                        <div id="divProgressBar">
                            <div style="text-align: left;">
                                <span id="loadprogress" style="font-weight: bold; visibility: hidden;">&nbsp;&nbsp;0%</span>
                            </div>
                            <div id="ctl00_ContentPlaceHolder1_JQ1_divProgressImg" style="float: left; padding-left: 15px; visibility: hidden;">
                                <div id="loading">
                                    <span id="loadcss" style="height: 0%; line-height: 0; font-size: 0; overflow: hidden;"></span>
                                </div>
                            </div>
                            <div style="float: left; width: 14px; line-height: 0;" id="divSaveText">
                            </div>
                            <div class="divclear"></div>
                        </div>
                        <div style="float: left; padding-left: 2px; visibility: hidden;">

                        </div>
                        <script type="text/javascript">
                            var timerq;
                            var surveycontent=document.getElementById("ctl00_ContentPlaceHolder1_JQ1_question");
                            var container=document.getElementById("container");
                            var progressBarType=1;
                            var divLeftBar=document.getElementById("ctl00_ContentPlaceHolder1_JQ1_divLeftBar");
                            var divProgressBar=document.getElementById("divProgressBar");
                            var loading=document.getElementById("loading");
                            var divSave=document.getElementById("ctl00_ContentPlaceHolder1_JQ1_divSave");
                            var issimple = '';
                            var isSolid=1;
                            var divSaveText=document.getElementById("divSaveText");
                            var divProgressImg=document.getElementById("ctl00_ContentPlaceHolder1_JQ1_divProgressImg");
                            var xTop=0;var solidmainCss=document.getElementById("mainCss");
                            function addEventSimple(obj, evt, fn) {
                                if (obj.addEventListener)
                                    obj.addEventListener(evt, fn, false);
                                else if (obj.attachEvent)
                                    obj.attachEvent('on' + evt, fn);
                            }
                            function gotop(){
                                window.scroll(0,0);
                            }
                            function gobottom(){
                                window.scroll(0,99999);
                            }
                            function resizeLeftBar()
                            {
                                if(!divLeftBar||!surveycontent)return;
                                var xy2=null;var clientWidth=0;
                                if(solidmainCss){
                                    xy2=getTop(solidmainCss);
                                    clientWidth=solidmainCss.offsetWidth||solidmainCss.clientWidth;

                                }
                                else if(issimple && surveycontent){
                                    xy2=getTop(surveycontent);
                                    clientWidth=surveycontent.clientWidth;
                                }
                                else if(container){
                                    xy2=getTop(container);
                                    clientWidth=container.clientWidth;
                                }
                                if(!xy2)return;
                                var lWidth=0; if(issimple)lWidth=22;
                                var leftQ=xy2.x+clientWidth-lWidth;
                                divLeftBar.style.left=leftQ+"px";
                                xTop=getTop(surveycontent).y;
                                var docHeight=document.documentElement.clientHeight||document.body.clientHeight;
                                if(xTop>docHeight/2)
                                    xTop=docHeight/2;
                            }
                            addEventSimple(window,"resize",resizeLeftBar);
                            resizeLeftBar();
                            addEventSimple(window,"scroll",mmq);
                            mmq();
                            var hasDisplayed=false;
                            function mmq()
                            {
                                var posY=document.documentElement.scrollTop||document.body.scrollTop;
                                if(divLeftBar){
                                    divLeftBar.style.top=posY+xTop+"px";
                                }
                            }
                            function getTop(e)
                            {
                                if(!e)return;
                                var x = e.offsetLeft;
                                var y = e.offsetTop;
                                while(e = e.offsetParent)
                                {
                                    x += e.offsetLeft;
                                    y += e.offsetTop;
                                }
                                return {"x": x, "y": y};
                            }
                        </script>
                        <div style="clear: both;">
                        </div>
                    </div>


                    <div style="clear: both;">
                    </div>

                    <div id="divDescPop" style="display:none;">
                        <div style="padding:10px;  overflow:auto;line-height:20px;font-size:14px;" id="divDescPopData"></div>
                    </div>
                    <div id="rbbox" style="display:none; height:70px;">


                    </div>
                    <script type="text/javascript">
                        var needAvoidCrack=1;
                        try{
                            HTMLElement.prototype.click = function() {
                                var evt = this.ownerDocument.createEvent('MouseEvents');
                                evt.initMouseEvent('click', true, true, this.ownerDocument.defaultView, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
                                this.dispatchEvent(evt);
                            }
                        }catch(ex){};
                    </script>
                    <script type="text/javascript">
                        //总页数，问卷相关
                        var totalPage=1;
                        var totalCut=8;
                        var qstr = 'false§true¤page§1§§§¤cut¤radio§1§2§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0¤radio§2§4§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§3§4§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§4§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§5§3§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0¤cut¤radio§6§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§7§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§8§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§9§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤cut¤radio§10§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§11§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§12§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§13§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§14§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤cut¤radio§15§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§16§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§17§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§18§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§19§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§20§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤cut¤radio§21§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§22§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§23§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§24§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§25§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§26§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤cut¤radio§27§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§28§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§29§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§30§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§31§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤cut¤radio§32§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§33§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§34§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§35§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤radio§36§5§false§false§0§true§§0§0§§§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0§false〒0〒0¤question§37§4§§false§false§false§0§§§false§-1§¤question§38§5§§false§false§false§0§§§false§-1§¤question§39§4§§false§false§false§0§§§false§-1§¤cut';//所有问题，与服务器端交互
                        var maxSurveyTime=0;var leftSeconds=0-10;
                        var hasSurveyTime=false;
                        if(leftSeconds>0){
                            if(maxSurveyTime) maxSurveyTime=Math.min(leftSeconds,maxSurveyTime);
                            else if(leftSeconds<3600) maxSurveyTime=leftSeconds;
                        }
                        if(maxSurveyTime)hasSurveyTime=true;
                        //其它交互
                        var starttime="2017/5/24 15:47:27";
                        langVer=0;
                        var sjUser='';
                        var outuser='';
                        var outsign='';
                        var tdCode="ctl00_ContentPlaceHolder1_JQ1_tdCode";var eproguid='';
                        var guid = "";var mobileRnum="";var onlyMailSms="";
                        var saveGuid="";
                        var sourceDetail = "未知";
                        if(document.referrer)
                            sourceDetail=document.referrer;
                        var sourcename="";
                        var nv=0;
                        var source = '';
                        var udsid=0;
                        var isKaoShi=0;
                        var activityId = '3048945';
                        var rndnum="1960078883.42663285";
                        var simple = '';
                        var qwidth=0;
                        var qinvited="";
                        var parterid = '';
                        if(!window.isRunning)
                            window.isRunning="true";
                        var displayPrevPage="none";
                        var isPub="";var isSuper="";
                        var hasJoin='';
                        var nfjoinid='';
                        var promoteSource="";
                        var lastSavePage=0;
                        var lastSaveQ=0;
                        var jiFen="0";
                        var hrefPreview = document.getElementById("hrefPreview");
                        var afterDigitPublish = 1;
                        var inviteid='';
                        var SJBack='';
                        var survey = document.getElementById("ctl00_ContentPlaceHolder1_JQ1_surveyContent");
                        var refu='';
                        var isTest=0;
                        var isPreview='';
                        var Password = "";
                        var isProduction="true";
                        var cAlipayAccount="";
                        var wbid='';
                        var needJQJiang=0;
                        var IsSampleService=0;
                        var divDec="ctl00_ContentPlaceHolder1_JQ1_divDec";
                        var refer=document.referrer;
                        if(!refer)refer="";
                        else refer=refer.toLowerCase();
                        var isFromSojiang=0;
                        var isLogin=true;
                        var CurrentDomain=1;
                        var jiFenBao=0;var HasJiFenBao=0;
                        var sojumpParm='';
                        var divWeiXin="ctl00_ContentPlaceHolder1_JQ1_divWeiXin";
                        var divQQ="ctl00_ContentPlaceHolder1_JQ1_divQQ";
                        var access_token="";
                        var openid="";
                        var allowWeiXin=0;
                        if(allowWeiXin==1 && !window.WeixinJSBridge){
                            //window.onload=function(){
                            PDF_launch(divWeiXin,320,340, function () {
                                window.location.href=window.location.href;
                            },"no");
                            //   }
                        }
                        if(allowWeiXin==2){
                            //window.onload=function(){
                            PDF_launch(divQQ,420,100, function () {
                                window.location.href=window.location.href;
                            },"no");
                            //}
                        }
                        document.onclick=function(e){
                            if(window.calendar)
                                calendar.hide();
                            if(window.setMatrixFill)
                                setMatrixFill();
                        }
                        function gotoReg(){
                            PDF_launch(url,640,480, function () {
                                if(!isLogin)gotoReg();
                                else window.location.href=window.location.href;
                            });
                        }
                        if(jiFenBao>0){
                            window.onload=function(){
                                PDF_launch("/wjx/design/setalipay.aspx?activity=3048945",340,220, function () {
                                    var spanaliAccount=document.getElementById("spanaliAccount");
                                    if(spanaliAccount && window.alipayAccount)
                                        spanaliAccount.innerHTML="集分宝会赠送到<b style='font-size:13px;color:red;'>"+window.alipayAccount+"</b>，";
                                });
                            }
                        }
                        else if(!isTest && window.location.href.toLowerCase().indexOf("/jq/")>-1 && window.PDF_launch){//&& isRunning!="true"
                            var tMsg=document.getElementById("spanNotSubmit");var val='';
                            if(tMsg) val=tMsg.getAttribute("value");
                            var divNotRun=document.getElementById("divNotRun");
                            if(tMsg&&tMsg.innerHTML && (!getCookie("noJQPromote")||val=="1") && CurrentDomain &&divNotRun){
                                divNotRun.innerHTML="<div style=' margin-top:30px;font-size:14px;'>"+tMsg.parentNode.innerHTML+"<div style='margin-top:10px;'><input type='button' value='确定' class='finish' onclick='window.parent.PDF_close();' /></div></div>";
                                //window.onload=function(){
                                PDF_launch("divNotRun",520,120);
                                setCookie("noJQPromote","1",null,"/jq","",null);
                                //};
                            }
                        }
                        function getCookieVal(offset) {
                            var endstr = document.cookie.indexOf(";", offset);
                            if (endstr == -1) {
                                endstr = document.cookie.length;
                            }
                            return unescape(document.cookie.substring(offset, endstr));
                        }
                        function getCookie(name) {
                            var arg = name + "=";
                            var alen = arg.length;
                            var clen = document.cookie.length;
                            var i = 0;
                            while (i < clen) {
                                var j = i + alen;
                                if (document.cookie.substring(i, j) == arg) {
                                    return getCookieVal(j);
                                }
                                i = document.cookie.indexOf(" ", i) + 1;
                                if (i == 0) break;
                            }
                            return "";
                        }
                        function setCookie(name, value, expires, path, domain, secure) {
                            document.cookie = name + "=" + escape(value) +
                                ((expires) ? "; expires=" + expires : "") +
                                ((path) ? "; path=" + path : "") +
                                ((domain) ? "; domain=" + domain : "") +
                                ((secure) ? "; secure" : "");
                        }
                        var cProvince="";
                        var cCity="";
                        var cIp="";
                        var NeedSearchKeyword=1;
                        var allowSaveJoin='';
                        if(isPub && onlyMailSms){
                            if(!guid&&!mobileRnum){
                                alert("提示：此问卷只允许从问卷星系统发送的邮件和短信中包含的问卷链接访问。\r\n您是问卷发布者，可以从普通链接访问！");
                            }
                        }
                        var cepingCandidate="";
                        var cpid="";
                    </script>

                    <script type="text/javascript" src="/js/hintinfo.js?v=2"></script>
                    <script type="text/javascript" src="/js/jqnew2.js?v=101"></script>

                    <script type="text/javascript">
                        try{document.execCommand("BackgroundImageCache", false, true);}
                        catch(ex){}
                    </script>
                    <script type="text/javascript">
                        try {
                            sourceDetail = '';
                        }
                        catch (ex) { }
                    </script>
                    <div id="ctl00_ContentPlaceHolder1_JQ1_divVisitLog" style="display:none;"><img src="http://sojump.cn-hangzhou.log.aliyuncs.com/logstores/activityvisit/track.gif?APIVersion=0.6.0&amp;activity=3048945&amp;visittime=2017-05-24 15:47:27&amp;source=%e9%93%be%e6%8e%a5&amp;detail=%e7%9b%b4%e6%8e%a5%e8%ae%bf%e9%97%ae&amp;province=%e4%b8%8a%e6%b5%b7&amp;city=%e4%b8%8a%e6%b5%b7&amp;ip=116.226.138.118"></div>



                    <div style="clear: both;">
                    </div>
                </div>


                <div style="margin:30px auto 0; padding-top:30px; overflow: hidden; width:100%;">
                    <div style="border-top: 1px solid #bbbbbb; font-size: 0; height: 1px; line-height: 1px;
                            width: 98%; margin: 0 auto;">
                    </div>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td height="10px">
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" align="center">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr id="ctl00_trCopy">
                                        <td style="font-size: 12px; font-family: Tahoma, 宋体; color: #666666;" align="center">

                                        </td>
                                    </tr>

                                    <tr id="ctl00_trPoweredBy">
                                        <td style="color: #666666; font-family: Tahoma, 宋体;" align="center">
                                            <div style="height: 10px;">
                                            </div>
                                            <div id="divBannerLogo"><span id="ctl00_lblPowerby"><a href="http://www.sojump.com/" target="_blank" class="link-444" title="问卷星-专业的在线问卷调查、测评、投票平台">问卷星</a>&nbsp;提供技术支持</span></div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>

                                        </td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>

                        </tbody></table>
                </div>
            </div>
        </div>
        <div style="clear: both;">
        </div>
    </div>
    <div id="footercss">
        <div id="footerLeft">
        </div>
        <div id="footerCenter">
        </div>
        <div id="footerRight">
        </div>
    </div>
    <div style="clear: both; height: 10px;">
    </div>
    <div style="height: 20px;">
        &nbsp;</div>
</div>

<div style="clear:both;"></div>

<div style="display:none;"><script src="https://s13.cnzz.com/z_stat.php?id=4478442&amp;web_id=4478442" language="JavaScript"></script><script src="https://c.cnzz.com/core.php?web_id=4478442&amp;t=z" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=4478442" target="_blank" title="站长统计">站长统计</a></div>
<script>
    if (window._czc) {
        var jqloc = window.location.href.toLowerCase();
        var isVip=1;var cqType=1;
        var evvtype="免费版";if(isVip)evvtype="企业版";
        if (jqloc.indexOf("/jq/") > -1)
            _czc.push(["_trackEvent", "PC端JQ",evvtype, cqType]);
        else if(jqloc.indexOf("/complete.aspx")>-1)
            _czc.push(["_trackEvent", "PC端完成", evvtype, cqType]);
    }
</script>


