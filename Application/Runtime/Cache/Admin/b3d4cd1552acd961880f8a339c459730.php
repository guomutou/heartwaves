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

<style type="text/css">
    .report{background-color: rgb(97,193,161);width: 100px;height: 40px;line-height: 40px;color: #fff;position: fixed;bottom: 60px;right: 3%;text-align: center;}
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
                    <h2>用户管理</h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>欢迎使用HRV调节训练系统管理平台!</h5>
                        <a href = "/heartwaves/index.php/Admin/Organizeconstruct/orgmanager"><div class="viewall">返回上一级</div></a>
                    </div>
       <!--  <script type = "text/javascript">
           function search(){
           var x = document.getElementById("sear");            
           window.location = "http://120.27.98.52/heartwaves/index.php?m=Admin&c=Organizeconstruct&a=usersearch&str="+x.value;
       }
       </script> -->
                    <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example"   id="uid">
                    <thead>
        
            <!-- &nbsp;&nbsp;&nbsp;&nbsp;<input  id="sear" type = "text" name = "search" placeholder = "用户名搜索" onchange = "search()" > -->



            <form name = "form1" action = "/heartwaves/index.php/Admin/Organizeconstruct/usersearch" method = "post">
            <!--<a href = "#"><button type = "button"> 新增用户</button></a>-->&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;<span style = "font-size:15px;font-weight:bold;"></span>&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "uname" placeholder = "学号">&nbsp;&nbsp;&nbsp;&nbsp;
        <!--    <span style = "font-size:15px;font-weight:bold;"></span>&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "time" placeholder = "工作单位">&nbsp;&nbsp;&nbsp;&nbsp;
           <span style = "font-size:15px;font-weight:bold;"></span>&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "position" placeholder = "职位">&nbsp;&nbsp;&nbsp;&nbsp; -->
            <!-- <span style = "font-size:15px;font-weight:bold;">单位性质:</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <select name = "companytype" >
                <option>企业</option>
                <option>政府</option>
                <option>事业单位</option>
            </select> -->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "submit" name = "submit" value = "查询">
            </form>


            <br><br>
                    <tr>
                        <!-- <th>序号</th> -->
                        <th>学号</th>
                        <th>姓名</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>职位</th>
                        <th>工作单位</th>
                        <!--<th>既往病史</th>
                        <th>observe</th>
                        <th>rember</th>
                        <th>emotion</th>
                        <th>willpower</th>
                        <th>thinking</th>
                        <th>角色</th> -->
                       <!--  <th>状态</th> -->
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): foreach($list as $k=>$vo): ?><tr class="gradeU">
                        <!-- <td><?php echo ($vo["id"]); ?></td> -->
                        <td><?php echo ($vo["student_number"]); ?></td>
                        <td><?php echo ($vo["nickname"]); ?></td>
                        <td>
                            <?php  if($vo["sex"] == 1){ echo "男"; }else{ echo "女"; } ?>
                        </td>
                        <td><?php echo ($vo["birthday"]); ?></td>
                        <td><?php echo ($vo["position"]); ?></td>
                        <td><?php echo ($vo["workingplace"]); ?></td>
                       <!--  <td><?php echo ($vo["medicalhistory"]); ?></td>
                        <td><?php echo ($vo["observe"]); ?></td>
                        <td><?php echo ($vo["rember"]); ?></td>
                        <td><?php echo ($vo["emotion"]); ?></td>
                        <td><?php echo ($vo["willpower"]); ?></td>
                        <td><?php echo ($vo["thinking"]); ?></td>
                        <td><span style = "color:red;"><?php echo ($vo["identity"]); ?></span></if></td> -->
                        <!-- <td><?php if($vo["locked"] == 2): ?><span style = "color:red;">正常</span><?php else: ?><span style = "color:red;">锁定</span><?php endif; ?></td> -->
                       <!--<td><?php if($vo["status"] == 2): ?><span style = "color:red;">回收</span><?php else: ?><span class="label label-info">正常</span><?php endif; ?></td>
                        <td><?php if($vo["status"] == 2): ?><span style = "color:red;">回收</span><?php else: ?><span class="label label-info">正常</span><?php endif; ?></td>-->
<form method="post" action="/heartwaves/index.php/Admin/Organizeconstruct/deletesUser"> 
                       <td style = "width:500px;">
                           <a href="/heartwaves/index.php/Admin/Organizeconstruct/editUser/uid/<?php echo ($vo["id"]); ?>" target="_blank"><button type="button" class="btn btn-w-m btn-info">编辑</button></a>
                        <!--    <a href="/heartwaves/index.php/Admin/Organizeconstruct/record/id/<?php echo ($vo["id"]); ?>" target="_blank"><button type="button" class="btn btn-w-m btn-info">查看记录</button></a> -->
                            <!-- <a href="/heartwaves/index.php/Admin/Organizeconstruct/stopUser/uid/<?php echo ($vo["id"]); ?>" target="_blank"><button type="button" class="btn btn-w-m btn-danger"><?php if($vo["locked"] == 2): ?>锁定<?php else: ?>启用<?php endif; ?></button></a> -->
                            <a href="/heartwaves/index.php/Admin/Organizeconstruct/deleteUser/uid/<?php echo ($vo["id"]); ?>" target="_blank"   onclick= "if(confirm( '删除用户信息，HRV记录也会被删除。 ')==false)return   false; " ><button type="button" class="btn btn-w-m btn-danger">删除</button></a>

     <input type="checkbox" name="test[]" value="<?php echo ($vo["id"]); ?>" >

                   
       <!--  <a href="<?php echo U('Organizeconstruct/aaa');?>&id=<?php echo ($vo['id']); ?>"><div class="report">导出记录</div></a> -->

            </td>
                    </tr><?php endforeach; endif; ?>
            <?php echo ($page); ?>
                    </tbody>
        
                    </table>
                    </div>
                </div>
            </div>
            </div>
                   <a  onclick= "if(confirm( '删除用户信息，HRV记录也会被删除。 ')==false)return   false; "><button style="position: absolute;bottom: 50px;left:150px;">批量删除</button></a>
</form>
                    <button onclick="doCheck(1)"  style="position: absolute;bottom: 50px;left:35px;">全选</button>
                    <button onclick="doCheck(2)"  style="position: absolute;bottom: 50px;left:85px;">全不选</button><!-- 
                    <button onclick="doCheck(3)">反选</button> -->
                   <div style="position: absolute;bottom: 60px;right:160px;font-size:14px;">总共&nbsp;<?php echo ($count); ?>&nbsp;条记录</div>
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
        function putfile(){
            var str = document.getElementById("file").value;
            var suffix = str.substr(str.length-4);
            if (suffix == 'xlsx') {
                var submit = document.getElementById("submit");
                submit.disabled = false;
            }else{
                alert("请上传xlsx类型的文件");
            };
        }
    </script>

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