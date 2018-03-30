<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- 引入 ECharts 文件 -->
    <script src="/heartwaves/Public/js/echarts.min.js"></script>
    <script src="/heartwaves/Public/js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>

<body>
<div> hrv 记录 共<?php echo$test?>共条</div>
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<div id="main" style="width:1000px;height:500px;"></div>
</body>

<script type="text/javascript">


//    // 基于准备好的dom，初始化echarts实例

//    // 指定图表的配置项和数据
//    var option = {
//        title: {
//            text: 'ECharts 入门示例'
//        },
//        tooltip: {},
//        legend: {
//            data:['销量']
//        },
//        xAxis: {
//            data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
//        },
//        yAxis: {},
//        series: [{
//            name: '销量',
//            type: 'bar',
//            data: [5, 20, 36, 10, 10, 20]
//        }]
//    };
//
//    // 使用刚指定的配置项和数据显示图表。
//    myChart.setOption(option);

    var myChart = echarts.init(document.getElementById('main'));
//var name=[];
//    $.ajax({
//        type: "GET",
//        url: "/heartwaves/index.php/Admin/Statistics/ajaxtest",
//        //async : true, //同步执行
//        data:"" ,
//        dataType: "json",
//        success: function(data){
//            for(var i=0;i<data.length;i++){
//
//               name.push(data[i].name);
//                //console.log(data[i].name);
//
////
////
//            }
//
//        },
//        error : function(errorMsg) {
//            alert("图表请求数据失败啦!");
//            myChart.hideLoading();
//        }
//
//    });
////    console.log(person.firstname);
//    console.log(name);


      var option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
//    legend: {
//        data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎','百度','谷歌','必应','其他']
//    },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',

                data: 
                (function (){
                    var arr=[];
                    $.ajax({
                        type : "post",
                        async : false, //同步执行
                        url : "/heartwaves/index.php/Admin/Statistics/ajaxtest",
                        data : {},
                        dataType : "json", //返回数据形式为json
                        success : function(data) {
                            if (data) {
                                //console.log(data);
                                for(var i=0;i<data.length;i++){
                                   // console.log(data[i].name);
                                    arr.push(data[i].name);
                                }
                            }

                        },
                        error : function(errorMsg) {
                            alert("sorry，请求数据失败");
                            myChart.hideLoading();
                        }
                    })
                    return arr;
                })()

            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: '检测记录',
                type: 'bar',
                data: (function (){
                    var arr=[];
                    $.ajax({
                        type : "post",
                        async : false, //同步执行
                        url : "/heartwaves/index.php/Admin/Statistics/ajaxtest",
                        data : {},
                        dataType : "json", //返回数据形式为json
                        success : function(data) {
                            if (data) {
                                //console.log(data);
                                for(var i=0;i<data.length;i++){
                                   // console.log(data[i].jiance);
                                    arr.push(data[i].jiance);
                                }
                            }

                        },
                        error : function(errorMsg) {
                            alert("sorry，请求数据失败");
                            myChart.hideLoading();
                        }
                    })
                    return arr;
                })()
            },
            {
                name: '训练记录',
                type: 'bar',
                stack: '',
                data: (function (){
                    var arr=[];
                    $.ajax({
                        type : "post",
                        async : false, //同步执行
                        url : "/heartwaves/index.php/Admin/Statistics/ajaxtest",
                        data : {},
                        dataType : "json", //返回数据形式为json
                        success : function(data) {
                            if (data) {
                                //console.log(data);
                                for(var i=0;i<data.length;i++){
                                   // console.log(data[i].driall);
                                    arr.push(data[i].driall);
                                }
                            }

                        },
                        error : function(errorMsg) {
                            alert("sorry，请求数据失败");
                            myChart.hideLoading();
                        }
                    })
                    return arr;
                })()
            },

            {
                name: '放松记录',
                type: 'bar',
//            stack: '广告',
                data: (function (){
                    var arr=[];
                    $.ajax({
                        type : "post",
                        async : false, //同步执行
                        url : "/heartwaves/index.php/Admin/Statistics/ajaxtest",
                        data : {},
                        dataType : "json", //返回数据形式为json
                        success : function(data) {
                            if (data) {
                                //console.log(data);
                                for(var i=0;i<data.length;i++){
//                                    console.log(result[i].name);
                                    arr.push(data[i].qita);
                                }
                            }

                        },
                        error : function(errorMsg) {
                            alert("sorry，请求数据失败");
                            myChart.hideLoading();
                        }
                    })
                    return arr;
                })()
            },
//        {
//            name:'视频广告',
//            type:'bar',
//            stack: '广告',
//            data:[150, 232, 201, 154, 190, 330, 410]
//        },
//        {
//            name:'搜索引擎',
//            type:'bar',
//            data:[862, 1018, 964, 1026, 1679, 1600, 1570],
//            markLine : {
//                lineStyle: {
//                    normal: {
//                        type: 'dashed'
//                    }
//                },
//                data : [
//                    [{type : 'min'}, {type : 'max'}]
//                ]
//            }
//        },
//        {
//            name:'百度',
//            type:'bar',
//            barWidth : 5,
//            stack: '搜索引擎',
//            data:[620, 732, 701, 734, 1090, 1130, 1120]
//        },
//        {
//            name:'谷歌',
//            type:'bar',
//            stack: '搜索引擎',
//            data:[120, 132, 101, 134, 290, 230, 220]
//        },
//        {
//            name:'必应',
//            type:'bar',
//            stack: '搜索引擎',
//            data:[60, 72, 71, 74, 190, 130, 110]
//        },
//        {
//            name:'其他',
//            type:'bar',
//            stack: '搜索引擎',
//            data:[62, 82, 91, 84, 109, 110, 120]
//        }
        ]
    };
    myChart.setOption(option);







//    var option = {
//        tooltip: {
//            trigger: 'axis',
//            axisPointer: {            // 坐标轴指示器，坐标轴触发有效
//                type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
//            }
//        },
////    legend: {
////        data:['直接访问','邮件营销','联盟广告','视频广告','搜索引擎','百度','谷歌','必应','其他']
////    },
//        grid: {
//            left: '3%',
//            right: '4%',
//            bottom: '3%',
//            containLabel: true
//        },
//        xAxis: [
//            {
//                type: 'category',
//
//                data:arr1
//
//    }
//        ],
//        yAxis: [
//            {
//                type: 'value'
//            }
//        ],
//        series: [
//            {
//                name: '检测记录',
//                type: 'bar',
//                data: [320, 332, 301]
//            },
//            {
//                name: '训练记录',
//                type: 'bar',
//                stack: '',
//                data: [120, 132, 101]
//            },
//
//            {
//                name: '放松记录',
//                type: 'bar',
////            stack: '广告',
//                data: [220, 182, 191]
//            },
////        {
////            name:'视频广告',
////            type:'bar',
////            stack: '广告',
////            data:[150, 232, 201, 154, 190, 330, 410]
////        },
////        {
////            name:'搜索引擎',
////            type:'bar',
////            data:[862, 1018, 964, 1026, 1679, 1600, 1570],
////            markLine : {
////                lineStyle: {
////                    normal: {
////                        type: 'dashed'
////                    }
////                },
////                data : [
////                    [{type : 'min'}, {type : 'max'}]
////                ]
////            }
////        },
////        {
////            name:'百度',
////            type:'bar',
////            barWidth : 5,
////            stack: '搜索引擎',
////            data:[620, 732, 701, 734, 1090, 1130, 1120]
////        },
////        {
////            name:'谷歌',
////            type:'bar',
////            stack: '搜索引擎',
////            data:[120, 132, 101, 134, 290, 230, 220]
////        },
////        {
////            name:'必应',
////            type:'bar',
////            stack: '搜索引擎',
////            data:[60, 72, 71, 74, 190, 130, 110]
////        },
////        {
////            name:'其他',
////            type:'bar',
////            stack: '搜索引擎',
////            data:[62, 82, 91, 84, 109, 110, 120]
////        }
//        ]
//    };
//    myChart.setOption(option);


</script>


</html>