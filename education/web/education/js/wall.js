/*Javascript代码片段*/
//制作一个JQUERY的图片旋转插件
(function ($) {
    var defaults = {
        width : $(window).width(),  //默认窗口的宽度
        height : $(window).height(), //默认窗口的高度
        //本意为显示一行几张图片,但是由于比例缩放后的宽高无法确定,所以图片就没法确定为几个啦, 除非在第几个上增加样式.
        row : 6,                    //一行显示几个图片,默认显示4个图片
        offset : 20,                //默认宽度和高度的偏移量
        borderColor : 'white',      //图片边框的颜色,默认white
        borderWidth : '10px',       //图片边框的宽度,默认10px
        boxShadow : '2px 2px 2px rgba(255,245,255,.6)',
        borderRadius : '2px',
        margin : '10px',            //图片对象的外边据,默认为10
        padding : '0px',            //图片对象的内边距,默认为1
        scale : '1.2',              //聚焦放大倍数,默认1.2倍
        rotateNum : 60,             //倾斜角度范围,默认从-60~60deg
        transition : '1s'           //默认动画执行时间为1s

    };
    //主方法
    $.fn.createPhoto = function(params){
        
        var opts = $.extend({},defaults,params);
        //获得div对象
        var $this = $(this);
        //reStyle($this);
        var $children = $this.children();
        //获得平均宽度和平均高度
        var pingjunWidth = getPingjunWidth(opts.width,$children.length,opts.row,opts.offset);
        var pingjunHeigth = getPingjunHeight(opts.height,$children.length,opts.row,opts.offset);
        //alert('div宽度:'+opts.width+';<br />div高度:'+opts.height+';<br />平均宽度:'+pingjunWidth+';<br />平均高度:'+pingjunHeigth);
        //每一个图片对象都要循环
        return $children.each(function(i){

            //获得图片对象
            var $img = $(this);
            var imgWidth = $img.width();
            var imgHeight = $img.height();
            //得到当前图片的缩放比例
            var rorate = getRorate(pingjunWidth,pingjunHeigth,imgWidth,imgHeight);
            //根据比例进行缩放图片
            // alert(rorate);
            //resizeImg($img,rorate);
            //对图片对象进行美化
            beautyImg($img,opts);
            if((i+1)%opts.row == 0){
                $img.after('<br />');
            }
        });

    };

    //对div和html以及父级元素进行宽高调整
    var reStyle = function(divObject){
        divObject.css('height','100%');
    };
    //根据图片的数量和每行的数量计算图片的平均宽度,注意小数点
    var getPingjunWidth = function(width,length,rowNum,offset){
        offset = offset ? offset*2 : 0 ;
        return length > rowNum ? parseInt(width/rowNum)-offset: parseInt(width /length)-offset;
    };
    //根据图片的数量和每行的数量计算图片的平均高度,注意小数点
    var getPingjunHeight = function (height,length,rowNum,offset) {
        var row = Math.ceil(length/rowNum),offset = offset ? offset*2 : 0;
        return length > rowNum ? parseInt(height/row)-offset : parseInt(height)-offset;
    };
    //根据平均宽高和图片宽高得到缩放比例,比例为小数点后一位
    var getRorate = function  (pingjunWidth,pingjunHeigth,imgWidth,imgHeight) {
        // body...
        var rorate = 1;//缩放比例默认为 1

        //图片宽度大于平均宽度,图片高度小于平均高度
        if(imgWidth > pingjunWidth && imgHeight < pingjunHeigth){

            rorate = parseInt((pingjunWidth/imgWidth)*100)/100;

        //图片高度大于平均高度,图片宽度小于平均宽度
        }else if(imgWidth < pingjunWidth && imgHeight > pingjunHeigth){

            rorate = parseInt((pingjunHeigth/imgHeight)*100)/100;

        //图片宽高均大于平均宽高
        }else if(imgWidth > pingjunWidth && imgHeight > pingjunHeigth){

            var temp1 = parseInt((pingjunWidth/imgWidth)*100)/100;
            var temp2 = parseInt((pingjunHeigth/imgHeight)*100)/100;
            rorate = temp1 > temp2 ? temp2 : temp1;

        //图片宽高均小于平均宽高,进行放大.
        }else if(imgWidth < pingjunWidth && imgHeight < pingjunHeigth){

            var temp1 = parseInt((pingjunWidth/imgWidth)*100)/100;
            var temp2 = parseInt((pingjunHeigth/imgHeight)*100)/100;
            rorate = temp1 > temp2 ? temp2 : temp1;

        }
        return rorate;
    };
    //对图片进行缩放
    var resizeImg = function(imgObj,rorate){
        var img = new Image();
        img.src = imgObj.attr('src');
        var w = img.width,h = img.height;
        imgObj.css({
            width : w*rorate,
            height : h*rorate
        });

    };
    //得到一个随即的角度,整数,360以内
    var  getRandomDeg = function(num){
        var z = parseInt(Math.round(Math.random()*1));
        return z == 1 ? -parseInt(Math.random()*num) : parseInt(Math.random()*num);
    };
    //对图片进行美化,要兼容各浏览器
    var beautyImg = function(imgObj,opts){
        var transform = ['-webkit-transform','-ms-transform','-moz-transform','transform'];
        var transition = ['-webkit-transition','-ms-transition','-moz-transition','transition'];
        // imgObj.attr('z-index','1');
        //进行对图片元素的普通渲染
        imgObj.css({
            border : opts.borderWidth+' solid '+opts.borderColor,
            //margin : opts.margin,
            'border-radius' : opts.borderRadius,
            padding : opts.padding,
            'box-shadow' : opts.boxShadow,
            

        });
        //获得随即角度
        var rd = getRandomDeg(opts.rotateNum);
        if(isSupportCss(transform) && isSupportCss(transition)){
            //进行css的渲染
            imgObj.css({
                '-webkit-transform' : 'rotate('+rd+'deg)',
                '-moz-transform' : 'rotate('+rd+'deg)',
                'transform' : 'rotate('+rd+'deg)',
                //上次图片无法浮出来，增加定位就能使zIndex起作用啦。
                'position' : 'relative',
                'z-index' : '1',
                '-webkit-transition' : opts.transition,
                '-moz-transition' : opts.transition,
                'transition' : opts.transition
            });
            //绑定图片的鼠标经过和滑出事件
            imgObj.click(function(){
                //saveStorageValue(shid, "shid");
                //alert($(this).attr("shid"));
                sessionStorage.setItem("shid", $(this).attr("shid"));
                document.location.href='index.php?r=/education&page=student/eval_work/index_1_1';
            });
            imgObj.hover(function(){
                // imgObj[0].style.zIndex = 99999;
                imgObj.css({
                    'z-index' : 999,
                    '-webkit-transform' : 'scale('+opts.scale+')',
                    '-moz-trransform' : 'scale('+opts.scale+')',
                    'transform' : 'scale('+opts.scale+')',
                    'box-shadow' : '5px 5px 5px rgba(0,0,0,.6)'

                });
                //alert(imgObj.attr('sname'));
            },function(){
                // imgObj[0].style.zIndex = 1;
                imgObj.css({
                    '-webkit-transform' : 'scale(1.0)',
                    '-moz-trransform' : 'scale(1.0)',
                    'transform' : 'scale(1.0)',
                    'z-index' : 1,
                    'box-shadow' : '1px 1px 1px white',
                    '-webkit-transform' : 'rotate('+rd+'deg)',
                    '-moz-transform' : 'rotate('+rd+'deg)',
                    'transform' : 'rotate('+rd+'deg)'
                });
            });
        }

    };

    //检查是否支持css属性
    var isSupportCss = function(styleNameArr){
        var body = $('body')[0];
        for(var i=0;i<styleNameArr.length;i++){
            if(styleNameArr[i] in body.style){
                return true;
            }
        }
        return false;
    }
})(jQuery);