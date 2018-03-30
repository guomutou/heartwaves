<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>记录报告</title>
    <!-- 引入 echarts.js -->
    <script src="/heartwaves/Public/js/echarts.min.js"></script>
    <script src="/heartwaves/Public/js/jquery-2.1.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<style type="text/css">
body{background-color: rgb(239,239,244);}
    *{padding:0px;margin:0px;}
    h4{padding-left: 2%;text-align: center;padding-top: 10px;margin-bottom: 5px;}
    hr{margin-left: 2%;margin-right: 2%;margin-bottom: 10px;}
    input{width:10%;border-radius: 5px;height: 16px;line-height: 16px;padding-left: 3px;}
    table{width: 94%;margin-top: 20px;border-radius: 10px;border:2px solid #fff;margin-left: 3%;padding-top: 10px;padding-bottom: 10px;}
    td{text-align: center;font-size: 13px;padding-top: 3px;}
    .base{width: 100%;font-size: 12px;margin-left: 1%;text-align: center;margin-top: 20px;}
    .base li{display:inline;margin-left: 2%;}
    .base ul{margin-top: 10px;}
    .base span{border-radius: 5px;padding:1%;background-color: rgba(58,179,181,0.6);}
    .curve{font-size: 14px;text-align: center;margin-top: 30px;width: 100%;}
    .curve1{font-size: 14px;text-align: center;margin-bottom: 20px;width: 100%;}
    .record{font-size: 13px;color: rgb(97,139,154);padding-left: 3%;}
    .evaluation{font-size: 12px;padding-left: 3%;padding-right: 3%;}
    .records{width: 94%;border-radius: 10px;border:2px solid #fff;margin-left: 3%;padding-bottom: 10px;margin-top: 20px;padding-top: 10px;margin-bottom: 20px;}
/*     #img1{  
        transform:rotate(70deg);
            -ms-transform:rotate(70deg);     IE 9
            -moz-transform:rotate(70deg);     Firefox
            -webkit-transform:rotate(70deg); Safari 和 Chrome
            -o-transform:rotate(70deg); 
         }  */
</style>
<body>  
<div class="body">
<input type="hidden" id="nb" value="<?php echo ($nb); ?>">
    <h4>HRV记录详情</h4>
    <hr>
    <div class="base">
        <ul>
            <li>用户姓名：<span><?php echo ($datas['nickname']); ?></span></li>
            <li>记录类型：<span><?php  if ($datas["timetype"] == 1){ echo "基线测试"; } else if ($datas["timetype"] == 2){ echo "5分钟测试"; } else if ($datas["timetype"] == 3){ echo "10分钟测试"; } else if ($datas["timetype"] == 61){ echo "荷韵"; } else if ($datas["timetype"] == 62){ echo "梅花"; } else if ($datas["timetype"] == 63){ echo "丝绸之路"; } else if ($datas["timetype"] == 64){ echo "菩提树"; } else if ($datas["timetype"] == 65){ echo "生命之泉"; } else if ($datas["timetype"] == 66){ echo "星空"; } else if ($datas["timetype"] == 41){ echo "挪来移去"; } else if ($datas["timetype"] == 42){ echo "看图绘画"; } else if ($datas["timetype"] == 43){ echo "边缘视力"; } else if ($datas["timetype"] == 44){ echo "多彩球"; } else if ($datas["timetype"] == 45){ echo "方向瞬记"; } else if ($datas["timetype"] == 46){ echo "以此类推"; } else if ($datas["timetype"] == 70){ echo "神笔马良"; } else if ($datas["timetype"] == 71){ echo "冒险岛"; } else if ($datas["timetype"] == 72){ echo "射箭"; } else if ($datas["timetype"] == 20){ echo "情境仿真"; } else{ echo "放松训练"; }?>
            </span></li>
        </ul>
        <ul>
            <li>记录时间：<span><?php echo ($datas['s_time']); ?></span></li>
            <li>记录时长：<span><?php echo ($datas['time_length']); ?></span></li>
        </ul>
    </div>
    <h5 class="curve">记录曲线</h5>
    <div style="margin-bottom:20px;"><div id="line" style="width: 100%;height:200px;"></div></div>
    <div style="margin-top:-40px;background-color:rgba(124,210,251,0.6);width:25.7%;height:70px;margin-bottom:-128px;margin-left:14%;">&nbsp;</div><div id="main" style="width: 100%;height:150px;"></div><div style="margin-top:-40px;background-color:rgba(153,134,239,0.6);width:50%;height:70px;margin-top:-93px;margin-left:39.5%;">&nbsp;</div>
    <table>
        <tr >
            <th colspan="3" style="padding-bottom:20px;">生理数据</th>
        </tr>
        <tr>
            <!-- <td>M-HRT(bpm):{round($datas['fmean']}</td> -->
            <td>M-HRT(bpm):<?php echo round($datas['fmean'],1)?></td>
            <td>SD-HRT(bpm):<?php echo round($datas['fstddev'],1)?></td>
            <td>SDNN(ms):<?php echo round($datas['fsdnn'],1)?></td>
        </tr>
        <tr>
            <td>RMMSD(ms):<?php echo round($datas['frmssd'],1)?></td>
            <td>SD(ms):<?php echo round($datas['fsd'],1)?></td>
            <td>SDSD(ms):<?php echo round($datas['fsdsd'],1)?></td>
        </tr>
        <tr>
            <td>PNN50(%):<?php echo round($datas['fpnn'],1)?></td>
        </tr>
        <tr>
            <td>TP(ms2):<?php echo round($datas['tp'],1)?></td>
            <td>VLF(ms2):<?php echo round($datas['vlf'],1)?></td>
            <td>LF(ms2):<?php echo round($datas['lf'],1)?></td>
        </tr>
        <tr>
            <td>HF(ms2):<?php echo round($datas['hf'],1)?></td>
            <td>LF/HF:<?php echo round($datas['lhr'],1)?></td>
            <td>LFnorm:<?php echo round($datas['lfnorm'],1)?></td>
        </tr>
        <tr>
            <td>HFnorm:<?php echo round($datas['hfnorm'],1)?></td>
        </tr>
    </table>
    <table>
        <tr >
            <th colspan="3" style="padding-bottom:20px;">心理数据</th>
        </tr>
        <tr>
            <td>调节指数:<?php echo round($datas['deflatingindex'],1)?></td>
            <td>HRV得分:<?php echo round($datas['hrvscore'],1)?></td>
            <td rowspan="3">
                <div  style="background-image: url(/heartwaves/Public/img/111.png);position: relative;height:92px;background-repeat: no-repeat;width:100%;background-size:100% auto;">
                    <img id="img" src="/heartwaves/Public/img/aa.png" width="4%;" style="position: absolute;top:26px;left:48%;">
				</div>

                <div>自主神经系统平衡状态</div>
            </td>
        </tr>
        <tr>
            <td>稳定指数:<?php echo $datas['stabilityindex']?></td>
            <td>综合得分:<?php echo $datas['synthesisscore']?></td>
        </tr>
        <tr>
            <td>压力指数:<?php echo $datas['pressureindex']?></td>
            <td>平均心率:<?php echo round($datas['fmean'])?></td>
        </tr>
    </table>
    <div class="records">
        <h5 class="curve1">评价报告</h5>
        <div class="evaluation"><?php echo ($datas['report']); ?></div>
    </div>
</div>
    <div id='time' style="display:none;"><?php echo ($hrvtime); ?></div>
    <div id='ep' style="display:none;" ><?php echo ($hrvdata); ?></div>
    <div id='ibi' style="display:none;" ><?php echo ($ibidata); ?></div>
    <div id='ibis' style="display:none;" ><?php echo ($ibitime); ?></div>
    <script type="text/javascript">
    $(document).ready(function(){
        var nb = $("#nb").val();

    })
    //  频谱 柱状图
        $(document).ready(function(){
            var time = $("#ibis").text();
            var ep = $("#ibi").text();
            var times = $.parseJSON( time ); 
            var eps = $.parseJSON( ep ); 
            var data = [];
            var datas = [];
            console.log(times);
            console.log(eps);
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('main'));
            // 指定图表的配置项和数据
            var option = {
                color: ['#3398DB'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: {
                    data : data
                   /* data: times,
                    axisLabel: {
                        inside: true,
                        textStyle: {
                            color: 'rgb(239,239,244)'
                        }
                    }*/
                },
                yAxis: {
                    axisLine: {
                        show: true
                    },
                    axisTick: {
                        show: true
                    },
                    axisLabel: {
                        textStyle: {
                            color: '#999'
                        }
                    }
                },
                series : [
                    {
                        name:'Ep',
                        type:'bar',
                        barWidth: '100%',
                        data:eps
                    },
                    
                ],
                itemStyle: {
                            normal: {
                             
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                    offset: 0,
                                    color: 'rgba(17, 168,171, 1)'
                                }, {
                                    offset: 1,
                                    color: 'rgba(17, 168,171, 0.1)'
                                }]),
                                shadowColor: 'rgba(0, 0, 0, 0.1)',
                                shadowBlur: 10
                            }
                        }
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        })
     //hrv 曲线 
        $(document).ready(function(){
            var time = $("#time").text();
            var ep = $("#ep").text();
            var times = $.parseJSON( time ); 
            var eps = $.parseJSON( ep ); 
            console.log(times);
            console.log(eps);
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('line'));
            // 指定图表的配置项和数据
            var option = {
                tooltip: {
                    trigger: 'axis'
                },
                xAxis:  {
                    type: 'category',
                    boundaryGap: true,
                    data: times,
                    axisLabel: {
                        inside: true,
                        textStyle: {
                            color: 'rgb(239,239,244)'
                        }
                    }
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}'
                    },
                },
                series: [
                    {
                        name:'HRV',
                        type:'line',
                        smooth: true,
                        showSymbol: false,
                        symbol: false,
                        lineStyle: {
                            normal: {
                                color: new echarts.graphic.LinearGradient(0, 0, 1, 0, [{
                                    offset: 0.7, color: '#993CED' // 0% 处的颜色
                                }, {
                                    offset: 1, color: '#56D9FC' // 100% 处的颜色
                                }], false),
                                width: 5,
                            },
                        },
                        markPoint: {
                            data: [{
                             name: '最大值',
                             type: 'max',
                             valueIndex: 0
                            }],
                        },
                        data: eps,
                    }
                ]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        })
    </script>
</body>
</html><script type="text/javascript">
(function(k){for(var d,f,l=document.getElementsByTagName("head")[0].style,h=["transformProperty","WebkitTransform","OTransform","msTransform","MozTransform"],g=0;g<h.length;g++)void 0!==l[h[g]]&&(d=h[g]);d&&(f=d.replace(/[tT]ransform/,"TransformOrigin"),"T"==f[0]&&(f[0]="t"));eval('IE = "v"=="\v"');jQuery.fn.extend({rotate:function(a){if(0!==this.length&&"undefined"!=typeof a){"number"==typeof a&&(a={angle:a});for(var b=[],c=0,d=this.length;c<d;c++){var e=this.get(c);if(e.Wilq32&&e.Wilq32.PhotoEffect)e.Wilq32.PhotoEffect._handleRotation(a);
else{var f=k.extend(!0,{},a),e=(new Wilq32.PhotoEffect(e,f))._rootObj;b.push(k(e))}}return b}},getRotateAngle:function(){for(var a=[],b=0,c=this.length;b<c;b++){var d=this.get(b);d.Wilq32&&d.Wilq32.PhotoEffect&&(a[b]=d.Wilq32.PhotoEffect._angle)}return a},stopRotate:function(){for(var a=0,b=this.length;a<b;a++){var c=this.get(a);c.Wilq32&&c.Wilq32.PhotoEffect&&clearTimeout(c.Wilq32.PhotoEffect._timer)}}});Wilq32=window.Wilq32||{};Wilq32.PhotoEffect=function(){return d?function(a,b){a.Wilq32={PhotoEffect:this};
this._img=this._rootObj=this._eventObj=a;this._handleRotation(b)}:function(a,b){this._img=a;this._onLoadDelegate=[b];this._rootObj=document.createElement("span");this._rootObj.style.display="inline-block";this._rootObj.Wilq32={PhotoEffect:this};a.parentNode.insertBefore(this._rootObj,a);if(a.complete)this._Loader();else{var c=this;jQuery(this._img).bind("load",function(){c._Loader()})}}}();Wilq32.PhotoEffect.prototype={_setupParameters:function(a){this._parameters=this._parameters||{};"number"!==
typeof this._angle&&(this._angle=0);"number"===typeof a.angle&&(this._angle=a.angle);this._parameters.animateTo="number"===typeof a.animateTo?a.animateTo:this._angle;this._parameters.step=a.step||this._parameters.step||null;this._parameters.easing=a.easing||this._parameters.easing||this._defaultEasing;this._parameters.duration=a.duration||this._parameters.duration||1E3;this._parameters.callback=a.callback||this._parameters.callback||this._emptyFunction;this._parameters.center=a.center||this._parameters.center||
["50%","50%"];this._rotationCenterX="string"==typeof this._parameters.center[0]?parseInt(this._parameters.center[0],10)/100*this._imgWidth*this._aspectW:this._parameters.center[0];this._rotationCenterY="string"==typeof this._parameters.center[1]?parseInt(this._parameters.center[1],10)/100*this._imgHeight*this._aspectH:this._parameters.center[1];a.bind&&a.bind!=this._parameters.bind&&this._BindEvents(a.bind)},_emptyFunction:function(){},_defaultEasing:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-
1)+c},_handleRotation:function(a,b){d||this._img.complete||b?(this._setupParameters(a),this._angle==this._parameters.animateTo?this._rotate(this._angle):this._animateStart()):this._onLoadDelegate.push(a)},_BindEvents:function(a){if(a&&this._eventObj){if(this._parameters.bind){var b=this._parameters.bind,c;for(c in b)b.hasOwnProperty(c)&&jQuery(this._eventObj).unbind(c,b[c])}this._parameters.bind=a;for(c in a)a.hasOwnProperty(c)&&jQuery(this._eventObj).bind(c,a[c])}},_Loader:function(){return IE?function(){var a=
this._img.width,b=this._img.height;this._imgWidth=a;this._imgHeight=b;this._img.parentNode.removeChild(this._img);this._vimage=this.createVMLNode("image");this._vimage.src=this._img.src;this._vimage.style.height=b+"px";this._vimage.style.width=a+"px";this._vimage.style.position="absolute";this._vimage.style.top="0px";this._vimage.style.left="0px";this._aspectW=this._aspectH=1;this._container=this.createVMLNode("group");this._container.style.width=a;this._container.style.height=b;this._container.style.position=
"absolute";this._container.style.top="0px";this._container.style.left="0px";this._container.setAttribute("coordsize",a-1+","+(b-1));this._container.appendChild(this._vimage);this._rootObj.appendChild(this._container);this._rootObj.style.position="relative";this._rootObj.style.width=a+"px";this._rootObj.style.height=b+"px";this._rootObj.setAttribute("id",this._img.getAttribute("id"));this._rootObj.className=this._img.className;for(this._eventObj=this._rootObj;a=this._onLoadDelegate.shift();)this._handleRotation(a,
!0)}:function(){this._rootObj.setAttribute("id",this._img.getAttribute("id"));this._rootObj.className=this._img.className;this._imgWidth=this._img.naturalWidth;this._imgHeight=this._img.naturalHeight;var a=Math.sqrt(this._imgHeight*this._imgHeight+this._imgWidth*this._imgWidth);this._width=3*a;this._height=3*a;this._aspectW=this._img.offsetWidth/this._img.naturalWidth;this._aspectH=this._img.offsetHeight/this._img.naturalHeight;this._img.parentNode.removeChild(this._img);this._canvas=document.createElement("canvas");
this._canvas.setAttribute("width",this._width);this._canvas.style.position="relative";this._canvas.style.left=-this._img.height*this._aspectW+"px";this._canvas.style.top=-this._img.width*this._aspectH+"px";this._canvas.Wilq32=this._rootObj.Wilq32;this._rootObj.appendChild(this._canvas);this._rootObj.style.width=this._img.width*this._aspectW+"px";this._rootObj.style.height=this._img.height*this._aspectH+"px";this._eventObj=this._canvas;for(this._cnv=this._canvas.getContext("2d");a=this._onLoadDelegate.shift();)this._handleRotation(a,
!0)}}(),_animateStart:function(){this._timer&&clearTimeout(this._timer);this._animateStartTime=+new Date;this._animateStartAngle=this._angle;this._animate()},_animate:function(){var a=+new Date,b=a-this._animateStartTime>this._parameters.duration;if(b&&!this._parameters.animatedGif)clearTimeout(this._timer);else{if(this._canvas||this._vimage||this._img)a=this._parameters.easing(0,a-this._animateStartTime,this._animateStartAngle,this._parameters.animateTo-this._animateStartAngle,this._parameters.duration),
this._rotate(~~(10*a)/10);this._parameters.step&&this._parameters.step(this._angle);var c=this;this._timer=setTimeout(function(){c._animate.call(c)},10)}this._parameters.callback&&b&&(this._angle=this._parameters.animateTo,this._rotate(this._angle),this._parameters.callback.call(this._rootObj))},_rotate:function(){var a=Math.PI/180;return IE?function(a){this._angle=a;this._container.style.rotation=a%360+"deg";this._vimage.style.top=-(this._rotationCenterY-this._imgHeight/2)+"px";this._vimage.style.left=
-(this._rotationCenterX-this._imgWidth/2)+"px";this._container.style.top=this._rotationCenterY-this._imgHeight/2+"px";this._container.style.left=this._rotationCenterX-this._imgWidth/2+"px"}:d?function(a){this._angle=a;this._img.style[d]="rotate("+a%360+"deg)";this._img.style[f]=this._parameters.center.join(" ")}:function(b){this._angle=b;b=b%360*a;this._canvas.width=this._width;this._canvas.height=this._height;this._cnv.translate(this._imgWidth*this._aspectW,this._imgHeight*this._aspectH);this._cnv.translate(this._rotationCenterX,
this._rotationCenterY);this._cnv.rotate(b);this._cnv.translate(-this._rotationCenterX,-this._rotationCenterY);this._cnv.scale(this._aspectW,this._aspectH);this._cnv.drawImage(this._img,0,0)}}()};IE&&(Wilq32.PhotoEffect.prototype.createVMLNode=function(){document.createStyleSheet().addRule(".rvml","behavior:url(#default#VML)");try{return!document.namespaces.rvml&&document.namespaces.add("rvml","urn:schemas-microsoft-com:vml"),function(a){return document.createElement("<rvml:"+a+' class="rvml">')}}catch(a){return function(a){return document.createElement("<"+
a+' xmlns="urn:schemas-microsoft.com:vml" class="rvml">')}}}())})(jQuery);
  //$('#img').rotate(145);
</script>
<script type="text/javascript">
   var roate = $("#nb").val();
    var to = parseInt(roate);
  $('#img').rotate({angle:to});
</script>