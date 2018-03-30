<?php if (!defined('THINK_PATH')) exit();?>
  <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>修改角色</title>
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
                    <h2>修改角色</h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>欢迎使用HRV调节训练系统管理平台!</h5>
                        <a href = "/heartwaves/index.php/Admin/Organizeconstruct/jsmanager"><div class="viewall">返回上一级</div></a>

                    </div>
                    <div class="ibox-content">

                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
            <!-- <th>序号</th> -->
                        <th>角色名</th>
                        <th>权限名称</th>
                        <!-- <th>创建时间</th> -->
             <th>描述</th>
             <th>选择权限</th>
            <th>操作</th>         
                    </tr>
                    </thead>
                    <tbody>
            <form name = "form1" action = "/heartwaves/index.php/Admin/Organizeconstruct/editJsOk/uid/<?php echo ($data[0]["id"]); ?>" method = "post">
                            <tr class="gradeU">
           <!--  <td><input type = "text" name = "id" value = "<?php echo ($data[0]["id"]); ?>" readonly></td> -->
                            <td><input type = "text" name = "name" value = "<?php echo ($data[0]["name"]); ?>" readonly></td>
                            <!-- <td><input type = "text" name = "acode" value = "<?php echo ($data[0]["fid"]); ?>"></td> -->
                            <td>
                                      <!-- <input type = "text" name = "fids" value = "<?php echo ($data[0]["fid"]); ?>" readonly>  -->
                                      <textarea name="fids" readonly rows="10"><?php echo ($data[0]["fid"]); ?></textarea>
                            
                            </td>
            <!-- <td><input type = "date" name = "ctime" value = "<?php echo (date('Y-m-d',$data[0]["ctime"])); ?>"></td> -->
            <!-- <td><input type = "text" name = "ctime" value = "<?php echo ($data[0]["ctime"]); ?>"></td> -->
                <td><input type = "text" name = "description" value = "<?php echo ($data[0]["description"]); ?>"></td>

                <td>
                 <?php foreach ($fenlei as $k => $v): ?>
                                <ul>
                                    <li>

                                        <input  type = "checkbox" name = "fid[]" value="<?php echo ($v['id']); ?>" class="<?php echo ($v['fid']); ?>" onchange="check(this)"  >:<?php echo ($value['name']); ?>&nbsp;<?php echo ($v['name']); ?>

                                    </li>

                                    <?php if(isset($v['zi'])): ?><ul>
                                        <?php foreach($v['zi'] as $k1=>$v1): ?>
                                            <li>
                                                <input  type = "checkbox" name = "fid[]" value="<?php echo ($v1['id']); ?>" class="zi<?php echo ($v1['fid']); ?>" onchange="check(this)" disabled="true">:<?php echo ($value['name']); ?>&nbsp;<?php echo ($v1['name']); ?>
                                            </li>


                                            <?php if(isset($v1['zi'])): ?><ul>
                                                <?php foreach($v1['zi'] as $k2=>$v2): ?>
                                                    <li>
                                                        <input  type = "checkbox" name = "fid[]" value="<?php echo ($v2['id']); ?>" class="zi<?php echo ($v2['fid']); ?>" onchange="check(this)" disabled="true">:<?php echo ($value['name']); ?>&nbsp;<?php echo ($v2['name']); ?>
                                                    </li>


                                                    <?php if(isset($v2['zi'])): ?><ul>
                                                        <?php foreach($v2['zi'] as $k3=>$v3): ?>
                                                            <li>
                                                                <input  type = "checkbox" name = "fid[]" value="<?php echo ($v3['id']); ?>" class="zi<?php echo ($v3['fid']); ?>" onchange="check(this)" disabled="true">:<?php echo ($value['name']); ?>&nbsp;<?php echo ($v3['name']); ?>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul><?php endif ?>


                                                <?php endforeach ?>
                                           </ul> <?php endif ?>


                                        <?php endforeach ?>
                                   </ul> <?php endif ?>
                                </ul>
                            <?php endforeach ?>
                   <!--  <div id="uid">
                       <?php foreach ($code as $key => $value): ?>
                                   <input  type = "checkbox" name = "fid[]" value="<?php echo ($value['id']); ?>">:<?php echo ($value['name']); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                               <?php endforeach ?>
                   </div>
                    <div style = "margin:auto 130px;margin-top:30px;">
                               <input type="button" onclick="doCheck(1)" value="全选">&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="button" onclick="doCheck(2)" value="全不选">&nbsp;&nbsp;&nbsp;&nbsp;
                               <input type="button" onclick="doCheck(3)" value="反选">
                           </div>
                       </div> -->
                </td>

                <td>
                             <input type="submit" name = "submit" value = "保存" class="btn btn-w-m btn-info" ></a>
                            <!--<a href="http://119.29.14.66/logisticsht/index.php?m=Admin&c=Order&a=transferOrderOk&id=<?php echo ($v["id"]); ?>"><button type="button" class="btn btn-w-m btn-info">转单</button></a>-->
            <!--<a href="http://119.29.14.66/logisticsht/index.php?m=Admin&c=Order&a=transferOrderfailed&id=<?php echo ($v["id"]); ?>"><button type="button" class="btn btn-w-m btn-danger">不通过</button></a>-->
                        </td>
                    </tr>
            </form>
                    <?php if(is_array($arr2)): foreach($arr2 as $k=>$vs): if($vo["id"] == $vs['fid']): ?><tr class="gradeU">
                        <td><?php echo ($vs["id"]); ?></td>
                        <td>——<?php echo ($vs["name"]); ?></td>
                        <td>
                           <a href="<?php echo U('Fenlei/edit',array('id'=>$vs['id']));?>"><button type="button" class="btn btn-w-m btn-info">修改</button></a>
                            <a href="<?php echo U('Fenlei/delete',array('id'=>$vs['id']));?>" onclick = "return shifou();"><button type="button" class="btn btn-w-m btn-danger">删除</button></a>
                        </td>
                    </tr><?php endif; endforeach; endif; ?>
                    </tbody>
                    </table>

                    </div>
                </div>
            </div>
            </div>

 <!--            <?php foreach ($xuanzhong as $xuan):?>
            <?php var_dump($xuanzhong);?>
            <?php endforeach?> -->


            <!-- <div id="uid">
                <?php foreach ($code as $key => $value): ?>
                            <input  type = "checkbox" name = "fid[]" value="<?php echo ($value['id']); ?>">:<?php echo ($value['name']); ?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php endforeach ?>
            </div>

                         <div style = "margin:auto 130px;margin-top:100px;">
                                            <button onclick="doCheck(1)">全选</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button onclick="doCheck(2)">全不选</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button onclick="doCheck(3)">反选</button>
                                        </div>
                                    </div>  -->
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
        </script>

<script language=javascript> 
function check(t){ 
    if(t.checked == false)
    {
        var par = t.parentNode;
        var ne = par.nextElementSibling;
        var nes = ne.getElementsByTagName('input');
        for(var i=0;i<nes.length;i++){
        console.log(nes[i]);
            nes[i].checked = false;
            nes[i].disabled = true;
        }

    }
    else
    {
        var id = t.value;

        var zibox = document.getElementsByClassName('zi'+id);
//        alert(zibox);
        console.log(zibox);
        for(var i=0;i<zibox.length;i++)
            zibox[i].removeAttribute('disabled');
    }
} 
    /*var xz = document.getElementById(id);
    var ids = xz.value;
    alert(ids); 
    alert(xz.checked);*/ 
/*$("#xz").blur(function(){
    var xz=document.getElementById("xz"); 
    alert(xz.checked);
})*/
    /* $(".xz").blur(function(){

         var id=$(".xz").val();
         alert(id); 
         alert($(".xz").is(':checked'));

    })*/
</script>