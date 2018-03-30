<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>详情</title>
	<script type='text/javascript' src='http://120.27.98.52/heartwaves/Public/js/jquery-2.1.1.js'></script>
</head>
<style type="text/css">
	.body{border:1px solid rgba(200,200,200,0.5);background-color: rgb(42,162,249);border-radius: 10px;}
	h4{color: #fff;padding-left: 2%;}
	hr{margin-left: 2%;margin-right: 2%;margin-bottom: 20px;}
	span{color:#fff;font-size: 13px;margin-left: 6%;margin-right: 1%;}
	input{width:10%;border-radius: 5px;height: 16px;line-height: 16px;padding-left: 3px;}
	table{width: 100%;margin-top: 30px;}
	td{text-align: center;color: #fff;font-size: 13px;}
</style>
<body>
<?php print_r($data);?>
<div class="body">
	<h4>HRV记录详情</h4>
	<hr>
	<span>用户姓名</span><input type="text" disabled="block" value="<?php echo ($data['nickname']); ?>">
	<span>记录类型</span><input type="text" disabled="block" value="<?php echo ($data['rkind']); ?>">
	<span>记录时间</span><input type="text" disabled="block" value="<?php echo ($data['s_time']); ?>">
	<span>记录时长</span><input type="text" disabled="block" value="<?php echo ($data['time_length']); ?>">
	<table>
		<tr>
			<td>记录曲线</td>
			<td>记录报告</td>
		</tr>
	</table>
	<!-- <div id='time' style="display:none;"><?php echo ($times); ?></div>
	    <div id='ep' style="display:none;" ><?php echo ($Eps); ?></div> -->
	<div id="main" style="width: 35%;height:100px;background-color:red;margin-left:6%;margin-top:20px;"></div>
    <div id="line" style="width: 35%;height:100px;margin-top:40px;background-color:red;margin-left:6%;"></div>
    <div style="width: 35%;height:100px;background-color:red;margin-left:6%;margin-top:20px;"></div>
</div>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            var time = $("#time").text();
            var ep = $("#ep").text();
            var times = $.parseJSON( time ); 
            var eps = $.parseJSON( ep ); 
            console.log(times);
            console.log(eps);
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('main'));
            // 指定图表的配置项和数据
            var option = {
                title: {
                    text: '频谱',
                    subtext: '单位： Hz'
                },
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
                xAxis : [
                    {
                        type : 'category',
                        data : times,
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        // type : 'category',
                        // data : ['10','20','30','40'],
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                series : [
                    {
                        name:'Ep',
                        type:'bar',
                        barWidth: '40%',
                        data:eps
                    },
                    
                ],
                label: {
                        normal: {
                            show: true,
                            position: 'top',
                            formatter: '{c}'
                        }
                    },
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
                title: {
                    text: 'HRV'
                },
                tooltip: {
                    trigger: 'axis'
                },
                /*toolbox: {
                    show: true,
                    feature: {
                        saveAsImage: {}
                    }
                },*/
                xAxis:  {
                    type: 'category',
                    boundaryGap: true,
                    data: times
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
    </script> -->

</body>
</html>