<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="/heartwaves/Public/js/echarts.min.js"></script>
    <script src="/heartwaves/Public/js/jquery-2.1.1.js"></script>
</head>
<body>

    <div id='time' style="display:none;"><?php echo ($hrvtime); ?></div>
    <div id='ep' style="display:none;" ><?php echo ($hrvdata); ?></div>
    <div id='ibi' style="display:none;" ><?php echo ($ibidata); ?></div>
    <div id='ibis' style="display:none;" ><?php echo ($ibitime); ?></div>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 400px;height:300px;"></div>
    <!-- <div style="width: 600px;margin-top:-180px;"><img width="100%;" src="/heartwaves/Public/img/powerback.png"></div> -->
    <div id="line" style="width: 400px;height:300px;"></div>
    <script type="text/javascript">
    //  频谱 柱状图
        $(document).ready(function(){
            var time = $("#ibis").text();
            var ep = $("#ibi").text();
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
                xAxis: {
                    data: times,
                    axisLabel: {
                        inside: true,
                        textStyle: {
                            color: '#fff'
                        }
                    }
                },
                yAxis: {
                    axisLine: {
                        show: false
                    },
                    axisTick: {
                        show: false
                    },
                    axisLabel: {
                        textStyle: {
                            color: '#999'
                        }
                    }
                },
                dataZoom: [
                    {
                        type: 'inside'
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



/*$(document).ready(function(){
            var time = $("#time").text();
            var ep = $("#ep").text();
            var times = $.parseJSON( time ); 
            var eps = $.parseJSON( ep ); 
            console.log(times);
            console.log(eps);
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('mains'));
            // 指定图表的配置项和数据
            var option = {
                        xAxis: {
                            data: times,
                            axisLabel: {
                                inside: true,
                                textStyle: {
                                    color: '#fff'
                                }
                            }
                        },
                        yAxis: {
                            axisLine: {
                                show: false
                            },
                            axisTick: {
                                show: false
                            },
                            axisLabel: {
                                textStyle: {
                                    color: '#999'
                                }
                            }
                        },
                        dataZoom: [
                            {
                                type: 'inside'
                            }
                        ],
                        series: [
                            { // For shadow
                                type: 'bar',
                                itemStyle: {
                                    normal: {color: 'rgba(0,0,0,0.05)'}
                                },
                                barGap:'-100%',
                                barCategoryGap:'40%',
                                data: eps,
                                animation: false
                            },
                            {
                                type: 'bar',
                                itemStyle: {
                                    normal: {
                                        color: new echarts.graphic.LinearGradient(
                                            0, 0, 0, 1,
                                            [
                                                {offset: 0, color: '#83bff6'},
                                                {offset: 0.5, color: '#188df0'},
                                                {offset: 1, color: '#188df0'}
                                            ]
                                        )
                                    },
                                    emphasis: {
                                        color: new echarts.graphic.LinearGradient(
                                            0, 0, 0, 1,
                                            [
                                                {offset: 0, color: '#2378f7'},
                                                {offset: 0.7, color: '#2378f7'},
                                                {offset: 1, color: '#83bff6'}
                                            ]
                                        )
                                    }
                                },
                                data: eps
                            }
                        ]
                    };


            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        })
           */ //hrv 曲线 
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
    </script>
</body>
</html>