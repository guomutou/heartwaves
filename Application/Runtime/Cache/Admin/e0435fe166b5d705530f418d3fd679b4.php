<?php if (!defined('THINK_PATH')) exit();?>
  <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>用户管理</title>
    <link href="/heartwaves/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/heartwaves/Public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/heartwaves/Public/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/heartwaves/Public/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="/heartwaves/Public/css/animate.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/style.css" rel="stylesheet">

</head>
<style>
    th{
        text-align: center;
    }
    td{
        text-align: center;
    }
</style>
<body>
    <div id="wrapper">

        <!-- start left -->

      <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">心脑电波</strong>
                             </span> <span class="text-muted text-xs block">我是管理员<b class="caret"></b></span> </span> </a>
                        </div>
                        <div class="logo-element">
                            心脑电波
                        </div>
                    </li>
                    <li class="active">
                <a href="<?php echo U('Index/index');?>"><i class="fa fa-diamond"></i> <span class="nav-label">后台首页</span> <span class="label label-primary pull-right">NEW</span></a>
            </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">组织结构</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li ><a href="<?php echo U('Organizeconstruct/usermanager');?>">用户管理</a></li>
                            <li ><a href="<?php echo U('Organizeconstruct/jsmanager');?>">角色管理</a></li>
                            <li ><a href="<?php echo U('Organizeconstruct/authormanager');?>">权限管理</a></li>
                           <!--  <li ><a href="<?php echo U('Adminer/index');?>">资源管理</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">游戏大厅</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <!--<li><a href="<?php echo U('Fenlei/index');?>">查看分类</a></li>
                            <li ><a href="<?php echo U('Fenlei/add');?>">添加分类</a></li>-->
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">记录管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo U('Recordmanager/record');?>">记录</a></li>
                           <!--<li ><a href="<?php echo U('Slides/add');?>">添加幻灯片</a></li>-->
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">日志管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo U('Logmanager/log');?>">日志</a></li>
                            <!--<li ><a href="<?php echo U('View/add');?>">添加信息</a></li>-->
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">网站邀请码管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a  href="<?php echo U('Yaoqing/index');?>">查看邀请码</a></li>
                            <li ><a href="<?php echo U('Yaoqing/add');?>">添加邀请码</a></li>
                            <li ><a href="<?php echo U('Yaoqing/production');?>">生成邀请码</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">网站公告</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a  href="<?php echo U('Gonggao/index');?>">查看公告</a></li>
                            <li ><a href="<?php echo U('Gonggao/add');?>">添加公告</a></li>
                        </ul>
                    </li>
                        <!--    <li>
                                                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">会员管理</span> <span class="fa arrow"></span></a>
                                                <ul class="nav nav-second-level">
                                    <li><a href = "<?php echo U('User/search');?>">会员查找</a></li>
                         <li><a href="<?php echo U('User/index');?>">会员查看</a></li>
                         <li><a href="<?php echo U('User/recovery');?>">会员回收站</a></li>
                                    
                                                </ul>
                                            </li> -->
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">留言管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo U('Liuyan/index');?>">留言查看</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">网站维护</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo U('Maintain/index');?>">缓存清理</a></li>
                            <li><a href="<?php echo U('Maintain/dataBackups');?>">备份还原数据库</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">友情链接</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo U('Friendlink/index');?>">查看友链</a></li>
                            <li><a href="<?php echo U('Friendlink/add');?>">添加友链</a></li>
                        </ul>
                    </li>
                <li>
                    <a href="<?php echo U('Login/logout');?>">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>
        </nav>
        </div>
        <div class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        </div>
                    </nav>
                </div>
            </div>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- start top -->
        
  <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>[title]</title>
    <link href="/heartwaves/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/heartwaves/Public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/heartwaves/Public/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/heartwaves/Public/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="/heartwaves/Public/css/animate.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/style.css" rel="stylesheet">

</head>
<style>
    th{
        text-align: center;
    }
    td{
        text-align: center;
    }
</style>
<body>
    <div id="wrapper">

        <!-- end top -->
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>用户管理</h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>欢迎来到心脑电波后台！</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
						<script type = "text/javascript">
			function search(){
			
			var x = document.getElementById("sear");			
			window.location = "http://120.27.98.52/heartbrain/index.php?m=Admin&c=Logmanager&a=logSearch&str="+x.value;
		}
		</script>

                    <div class="ibox-content">

                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
			<!--<a href = "#"><button type = "button"> 新增用户</button></a>&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "search" placeholder = "搜索">-->
			<div style = "width:250px;display:inline-block;float:right;margin:20px auto;"><input type = "text" name = "search" placeholder = "请输入关键字" id = "sear">&nbsp;&nbsp;&nbsp;&nbsp;<input type = "button" name = "butt" value = "查询" onclick = "search();"></div>
			<form name = "form1" action = "/heartwaves/index.php/Admin/Logmanager/deleteMany" method = "post">
			<div style = "width:100px;display:inline-block;float:left;margin:20px auto;"><input type = "submit" name = "submit" value = "删除"></div>
			
			<br>
                    <tr>
							<th>选择</th>
                        	<th>序号</th>
                        	<th>详细信息</th>
							<th>操作IP地址</th>
                        	<th>开始时间</th>
							<th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr class="gradeU">
						<td><input type = "checkbox" name = "m[]" value = "<?php echo ($vo["id"]); ?>"></td>
                       	<td><?php echo ($vo["id"]); ?></td>
                       	<td><?php echo ($vo["detail"]); ?></td>
                       	<td><?php echo ($vo["ip"]); ?></td>
			<td><?php echo (date('Y-m-d',$vo["start_time"])); ?></td>
                       <!--<td><?php if($vo["state"] == 1): ?><span style = "color:red;">正常</span><?php else: ?><span style = "color:red;">冻结</span><?php endif; ?></td>
                       <td><?php if($vo["status"] == 2): ?><span style = "color:red;">回收</span><?php else: ?><span class="label label-info">正常</span><?php endif; ?></td>
                        <td><?php if($vo["status"] == 2): ?><span style = "color:red;">回收</span><?php else: ?><span class="label label-info">正常</span><?php endif; ?></td>-->
                        <td style = "width:500px;">
                        	<a href="/heartwaves/index.php/Admin/Logmanager/deleteLog/id/<?php echo ($vo["id"]); ?>" onclick = "return shifou();"><button type="button" class="btn btn-w-m btn-danger">删除</button></a>

			</td>
                    </tr><?php endforeach; endif; ?>
			<?php echo ($page); ?>
                    </tbody>
						</form>
						
                    </table>
                    
                    </div>
                </div>
            </div>
            </div>

    <!-- start footer -->
                    
<div class="footer">
    <div class="pull-right">
    </div>
    <div>
        <strong>请保持版权</strong>谢谢合作 &copy; 2014-2016
    </div>
</div>
</div>
<script type="text/javascript">
    function shifou(){
        if(confirm("你真的想好了吗？")){
            return true;
        }else{
            return false;
        }
    }
</script>
</body>
</html>
           <!-- Mainly scripts -->
    <script src="/heartwaves/Public/js/jquery-2.1.1.js"></script>
    <script src="/heartwaves/Public/js/inspinia.js"></script>
    <script src="/heartwaves/Public/js/bootstrap.min.js"></script>
    <script src="/heartwaves/Public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/heartwaves/Public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="/heartwaves/Public/js/plugins/flot/jquery.flot.js"></script>
    <script src="/heartwaves/Public/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/heartwaves/Public/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/heartwaves/Public/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/heartwaves/Public/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="/heartwaves/Public/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/heartwaves/Public/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->

    <script src="/heartwaves/Public/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="/heartwaves/Public/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="/heartwaves/Public/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="/heartwaves/Public/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="/heartwaves/Public/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="/heartwaves/Public/js/plugins/chartJs/Chart.min.js"></script>
<script>
        var s_url=window.location.pathname;
        var now_url = '';
        for(var i = 0;i<$("#side-menu li").length;i++){
            now_url=$("#side-menu li a").eq(i).attr("href");
            if(now_url == s_url){
                $("#side-menu a").eq(i).parent().addClass("active");
                $("#side-menu a").eq(i).parent().parent().parent().addClass("active");
                $("#side-menu a").eq(i).parent().parent().addClass("in");
            }else{
                $("#side-menu a").eq(i).parent().removeClass("active");
            }
        }
        </script>
    <!-- Toastr -->

            <!-- end footer -->
        </div>
    <!-- Data Tables -->
    <script src="/heartwaves/Public/Admin/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/heartwaves/Public/Admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/heartwaves/Public/Admin/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/heartwaves/Public/Admin/js/plugins/dataTables/dataTables.tableTools.min.js"></script>