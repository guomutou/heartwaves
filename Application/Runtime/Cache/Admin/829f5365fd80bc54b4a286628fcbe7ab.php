<?php if (!defined('THINK_PATH')) exit();?>
  <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>个人记录</title>
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

<style type="text/css">
    .viewall{float: right;right: 5%;}
</style>
        <!-- start left -->

      <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">欢迎使用HRV调节训练系统管理平台</strong>
                             </span> <span class="text-muted text-xs block"> <?=$_SESSION['username']?><b class="caret"></b></span> </span> </a>
                        </div>
                        <div class="logo-element">
                           欢迎使用HRV调节训练系统管理平台
                        </div>
                    </li>
                    <li class="active">
                <a href="<?php echo U('Index/index');?>"><i class="fa fa-diamond"></i> <span class="nav-label">后台首页</span> <span class="label label-primary pull-right">NEW</span></a>
            </li>
                    <?php if( $_SESSION['id']==1):?>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">超级管理员管理</span> <span class="fa arrow"></span></a>

                    </li>
                    <ul class="nav nav-second-level">
                        <li ><a href="<?php echo U('Jingli/index');?>">超级账户信息</a></li>
                        <li ><a href="<?php echo U('Jingli/jinglilist');?>">普通管理员列表</a></li>
                        <li ><a href="<?php echo U('Statistics/index');?>">数据统计</a></li>
                        <li ><a href="<?php echo U('Liuyan/index');?>">留言管理</a></li>
                        <!--  <li ><a href="<?php echo U('Adminer/index');?>">资源管理</a></li> -->
                    </ul>
                <?php endif;?>
                    <?php if( $_SESSION['id'] !=1):?>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">组织结构</span> <span class="fa arrow"></span></a>

                    </li>
                    <ul class="nav nav-second-level">
                    <li ><a href="<?php echo U('Organizeconstruct/orgmanager');?>">组织管理</a></li>
                    <li ><a href="<?php echo U('Organizeconstruct/usermanager');?>">用户管理</a></li>
                    <li ><a href="<?php echo U('Organizeconstruct/jsmanager');?>">角色管理</a></li>
                    <li ><a href="<?php echo U('Organizeconstruct/authormanager');?>">权限管理</a></li>
                       <li ><a href="<?php echo U('Organizeconstruct/index');?>">修改密码</a></li>
                    <!--  <li ><a href="<?php echo U('Adminer/index');?>">资源管理</a></li> -->
                </ul>



                    <!--
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">游戏大厅</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo U('Fenlei/index');?>">查看分类</a></li>
                            <li ><a href="<?php echo U('Fenlei/add');?>">添加分类</a></li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">记录管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo U('Recordmanager/record');?>">记录</a></li>
                           <!--<li ><a href="<?php echo U('Slides/add');?>">添加幻灯片</a></li>-->
                        </ul>
                    </li>
                    <?php endif?>
                   <!--  <li>
                       <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">日志管理</span> <span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a href="<?php echo U('Logmanager/log');?>">日志</a></li>
                           <li ><a href="<?php echo U('View/add');?>">添加信息</a></li>
                       </ul>
                   </li> -->
                   <!--  <li>
                       <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">网站邀请码管理</span> <span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level">
                           <li><a  href="<?php echo U('Yaoqing/index');?>">查看邀请码</a></li>
                           <li ><a href="<?php echo U('Yaoqing/add');?>">添加邀请码</a></li>
                           <li ><a href="<?php echo U('Yaoqing/production');?>">生成邀请码</a></li>
                       </ul>
                   </li> -->
                     <?php if($_SESSION['id'] !=1):?>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">系统公告</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a  href="<?php echo U('Gonggao/index');?>">查看公告</a></li>
                            <li ><a href="<?php echo U('Gonggao/add');?>">添加公告</a></li>
                        </ul>
                    </li>
                         <?php endif?>
                        <!--    <li>
                                                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">会员管理</span> <span class="fa arrow"></span></a>
                                                <ul class="nav nav-second-level">
                                    <li><a href = "<?php echo U('User/search');?>">会员查找</a></li>
                         <li><a href="<?php echo U('User/index');?>">会员查看</a></li>
                         <li><a href="<?php echo U('User/recovery');?>">会员回收站</a></li>
                                    
                                                </ul>
                                            </li> -->
                    <?php if( $_SESSION['id'] !=1):?>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">留言管理</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <!--<li><a href="<?php echo U('Liuyan/index');?>">留言查看</a></li>-->
                            <li><a href="<?php echo U('Liuyan/replyadd');?>">给超级管理员留言</a></li>
                             <li><a href="<?php echo U('Liuyan/putongindex');?>">查看留言</a></li>
                        </ul>
                    </li>
                    <?php endif?>
                  <!--   <li>
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
                    </li> -->
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
                    <h2>个人记录</h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>欢迎使用HRV调节训练系统管理平台!</h5>
                        <a href = "/heartwaves/index.php/Admin/Organizeconstruct/usermanager"><div class="viewall">返回上一级</div></a>
                    </div>
                    <div class="ibox-content">

                    <table class="table table-striped table-bordered table-hover dataTables-example"  id="uid">
                    <thead>
					<form name = "form1" action = "/heartwaves/index.php/Admin/Organizeconstruct/recordSearch" method = "get">
			<!--<a href = "#"><button type = "button"> 新增用户</button></a>-->&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;<div style = "width:250px;display:inline-block;float:left;margin:20px 10px;"><span style = "font-size:15px;font-weight:bold;">用户名:</span>&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "uname" placeholder = "用户名"></div>
            <!--<div style = "width:250px;display:inline-block;float:left;margin:20px 10px;"><span style = "font-size:15px;font-weight:bold;">记录时间:</span>&nbsp;&nbsp;&nbsp;&nbsp;<input type = "date" name = "time" placeholder = "记录时间"></div>-->
			<div style = "width:515px;display:inline-block;float:left;margin:20px 10px;;"><span style = "font-size:15px;font-weight:bold;">类型:</span>&nbsp;&nbsp;&nbsp;&nbsp;<select style = "width:100px;" name = "sel">

			<option select = "selected"></option>
			<?php if(is_array($sel)): foreach($sel as $key=>$v): ?><option value = '<?php  if ($v["timetype"] == 1){ echo 1; } else if ($v["timetype"] == 2){ echo 2; } else if ($v["timetype"] == 3){ echo 3; } else if ($v["timetype"] == 61){ echo 61; } else if ($v["timetype"] == 62){ echo 62; } else if ($v["timetype"] == 63){ echo 63; } else if ($v["timetype"] == 64){ echo 64; } else if ($v["timetype"] == 65){ echo 65; } else if ($v["timetype"] == 66){ echo 66; } else if ($v["timetype"] == 41){ echo 41; } else if ($v["timetype"] == 42){ echo 42; } else if ($v["timetype"] == 43){ echo 43; } else if ($v["timetype"] == 44){ echo 44; } else if ($v["timetype"] == 45){ echo 45; } else if ($v["timetype"] == 46){ echo 46; } else if ($v["timetype"] == 70){ echo 70; } else if ($v["timetype"] == 71){ echo 71; } else if ($v["timetype"] == 72){ echo 72; } else if ($v["timetype"] == 20){ echo 20; } else{ echo 100; }?>'><?php  if ($v["timetype"] == 1){ echo "基线测试"; } else if ($v["timetype"] == 2){ echo "5分钟测试"; } else if ($v["timetype"] == 3){ echo "10分钟测试"; } else if ($v["timetype"] == 61){ echo "荷韵"; } else if ($v["timetype"] == 62){ echo "梅花"; } else if ($v["timetype"] == 63){ echo "丝绸之路"; } else if ($v["timetype"] == 64){ echo "菩提树"; } else if ($v["timetype"] == 65){ echo "生命之泉"; } else if ($v["timetype"] == 66){ echo "星空"; } else if ($v["timetype"] == 41){ echo "挪来移去"; } else if ($v["timetype"] == 42){ echo "看图绘画"; } else if ($v["timetype"] == 43){ echo "边缘视力"; } else if ($v["timetype"] == 44){ echo "多彩球"; } else if ($v["timetype"] == 45){ echo "方向瞬记"; } else if ($v["timetype"] == 46){ echo "以此类推"; } else if ($v["timetype"] == 70){ echo "神笔马良"; } else if ($v["timetype"] == 71){ echo "冒险岛"; } else if ($v["timetype"] == 72){ echo "射箭"; } else if ($v["timetype"] == 20){ echo "情境仿真"; } else{ echo "放松训练"; }?></option><?php endforeach; endif; ?>
			</select>
                <div style = "float:left;margin:0px 11px;"><span style = "font-size:15px;font-weight:bold;">组织:</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <select style = "width:100px;" name ="group">
                        <option value=""></option>
                        <?php foreach ($group as $k=>$v):?>
                        <option value="<?=$v['name']?>"><?=$v['name']?></option>
                        <?php endforeach?>
                    </select>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type = "submit" name = "submit" value = "查询"></div>
			</form>
			<br>
                    <tr>
                        <!--<th>序号</th> -->
                    	<th>用户名</th>
	      	            <th>记录类型</th>
                    	<!-- <th>难度</th> -->
                    	<th>开始时间</th>
                        <th>记录时长</th>
                        <th>综合得分</th>
                        <th>调节指数</th>
                        <th>稳定指数</th>
                        <th>压力指数</th>
        		      	<th>HRV得分</th>
            			<!-- <th>评价</th>
                        <th>用户备注</th> -->
            			<th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr class="gradeU">
                       	<!-- <td><?php echo ($vo["id"]); ?></td> -->
                       	<td><?php echo ($vo["nickname"]); ?></td>
                       	<td><?php  if ($vo["timetype"] == 1){ echo "基线测试"; } else if ($vo["timetype"] == 2){ echo "5分钟测试"; } else if ($vo["timetype"] == 3){ echo "10分钟测试"; } else if ($vo["timetype"] == 61){ echo "荷韵"; } else if ($vo["timetype"] == 62){ echo "梅花"; } else if ($vo["timetype"] == 63){ echo "丝绸之路"; } else if ($vo["timetype"] == 64){ echo "菩提树"; } else if ($vo["timetype"] == 65){ echo "生命之泉"; } else if ($vo["timetype"] == 66){ echo "星空"; } else if ($vo["timetype"] == 41){ echo "挪来移去"; } else if ($vo["timetype"] == 42){ echo "看图绘画"; } else if ($vo["timetype"] == 43){ echo "边缘视力"; } else if ($vo["timetype"] == 44){ echo "多彩球"; } else if ($vo["timetype"] == 45){ echo "方向瞬记"; } else if ($vo["timetype"] == 46){ echo "以此类推"; } else if ($vo["timetype"] == 70){ echo "神笔马良"; } else if ($vo["timetype"] == 71){ echo "冒险岛"; } else if ($vo["timetype"] == 72){ echo "射箭"; } else if ($vo["timetype"] == 20){ echo "情境仿真"; } else{ echo "放松训练"; }?></td>
			<td><?php echo ($vo["s_time"]); ?></td>
            <td><?php echo ($vo["time_length"]); ?></td>
            <td><?php echo ($vo["synthesisscore"]); ?></td>
            <td><?php echo ($vo["stabilityindex"]); ?></td>
            <td><?php echo ($vo["deflatingindex"]); ?></td>
            <td><?php echo ($vo["pressureindex"]); ?></td>
			<td><?php echo ($vo["hrvscore"]); ?></td>
                        <td style = "width:500px;">
            <form method="post" action="/heartwaves/index.php/Admin/Organizeconstruct/deletesrecord">  
                            <a href="http://123.206.62.179/heartwaves/index.php?m=Admin&c=Recordmanager&a=recorddetail&id=<?php echo ($vo["id"]); ?>"><button type="button" class="btn btn-w-m btn-danger">查看</button></a>
                            <a href="/heartwaves/index.php/Admin/Organizeconstruct/recordDelet/id/<?php echo ($vo["id"]); ?>" onclick = "return shifou();"><button type="button" class="btn btn-w-m btn-danger">删除</button></a>
                <input type="checkbox" name="test[]" value="<?php echo ($vo["id"]); ?>" > 

			</td>
                    </tr><?php endforeach; endif; ?>
			<?php echo ($page); ?>
                    </tbody>
		
                    </table>
                    
                    </div>
                </div>
            </div>
            </div>         
                <button onclick="deletes()" style="position: absolute;bottom: 40px;left:150px;">批量删除</button>
            </form>
                    <button onclick="doCheck(1)"  style="position: absolute;bottom: 40px;left:35px;">全选</button>
                    <button onclick="doCheck(2)"  style="position: absolute;bottom: 40px;left:85px;">全不选</button>
 <div style="position: absolute;bottom: 40px;right:160px;font-size:14px;">总共&nbsp;<?php echo ($count); ?>&nbsp;条记录</div>


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
 <script type="text/javascript">
        function doCheck(b){
            //获取所有的input选择框
            var uid = document.getElementById("uid");
            var list = uid.getElementsByTagName("input");
            //遍历
            for(var i=0;i<list.length;i++){
                switch(b){
                    case 1: list[i].checked = true; break; 
                    case 2: list[i].checked = false; break; 
                    case 3: list[i].checked = !list[i].checked; break; 
                }
            }
        }

       /* function deletes(){
            obj = document.getElementsByName("test");
            check_val = [];
            for(k in obj){
                if(obj[k].checked)
                    check_val.push(obj[k].value);
            }
            alert(check_val);

        }*/
    </script>