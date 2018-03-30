<?php if (!defined('THINK_PATH')) exit();?>
  <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>编辑用户</title>
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
    select{width:160px;}
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
                    <h2>编辑用户</h2>
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
                    <form name = "form1" action = "/heartwaves/index.php/Admin/Organizeconstruct/editUserOk/uid/<?php echo ($data[0]["id"]); ?>" method = "post">
                        <ul style="margin-left:20%;">
                           <!--  <li>序号</li><input type = "text" name = "id" value = "<?php echo ($data[0]["id"]); ?>" disabled><br><br> -->
                            <li>所属组织</li><select name = "groups" >
      <!--                       <option value="<?php echo ($data[0]["groups"]); ?>" ><?php echo ($data[0]["groups"]); ?></option> -->
                            <?php foreach ($js as $key => $value): ?>
                                <option value="<?php echo ($value['name']); ?>"><?php echo ($value['name']); ?></option>
                            <?php endforeach ?>
                            </select><br><br>
                            <li>姓名</li><input type = "text" name = "nickname" value = "<?php echo ($data[0]["nickname"]); ?>"><br><br>
                           <!--  <li>真实姓名</li><input type = "text" name = "realname" value = "<?php echo ($data[0]["realname"]); ?>"><br><br> -->
                            <li>性别</li><input type = "text" name = "sex" value = "<?php  if($data[0]['sex'] == 1){ echo '男'; } elseif($data[0]['sex'] == 2){ echo '女'; }else{ echo ''; } ?>"><br><br>
                            <li>年龄</li><input type = "text" name = "birthday" value = "<?php echo ($data[0]["birthday"]); ?>"><br><br>
                            <li>职级</li>
                            <!--<input type = "text" name = "position" value = "<?php echo ($data[0]["position"]); ?>" readonly>-->
                            <select name="position">
                                <option selected value="<?php echo ($data[0]["companytype"]); ?>"><?php echo ($data[0]["position"]); ?></option>
                                <option>科级及以下</option>
                                <option>正处</option>
                                <option>副局</option>
                                <option>正局</option>
                                <option>基层</option>
                                <option>中层</option>
                                <option>高层</option>
                                <option>其他</option>
                            </select>
                            <br><br>
                            <li>单位性质</li>
                                <select name="companytype">
                                    <option selected value="<?php echo ($data[0]["companytype"]); ?>"><?php echo ($data[0]["companytype"]); ?></option>
                                    <option>企业</option>
                                    <option>政府</option>
                                    <option>事业单位</option>
                                    <option>其他</option>
                                </select><br><br>
                            <li>工作单位</li><input type = "text" name = "workingPlace" value = "<?php echo ($data[0]["workingplace"]); ?>"><br><br>
                            </ul><ul  style="margin-left:40%;position: absolute;top:65px;">
                            <li>手机</li><input type = "text" name = "mobile" value = "<?php echo ($data[0]["mobile"]); ?>"><br><br>
                            <li>既往病史</li><input type = "text" name = "medicalHistory" value = "<?php echo ($data[0]["medicalHistory"]); ?>"><br><br>
                            <li>观察力</li><input type = "text" name = "observe" value = "<?php echo ($data[0]["observe"]); ?>" disabled><br><br>
                            <li>记忆力</li><input type = "text" name = "rember" value = "<?php echo ($data[0]["rember"]); ?>" disabled><br><br>
                            <li>情绪情感</li><input type = "text" name = "emotion" value = "<?php echo ($data[0]["emotion"]); ?>" disabled><br><br>
                            <li>意志力</li><input type = "text" name = "willpower" value = "<?php echo ($data[0]["willpower"]); ?>" disabled><br><br>
                            <li>思维方式</li><input type = "text" name = "thinking" value = "<?php echo ($data[0]["thinking"]); ?>" disabled><br><br>
                                
                            </ul>
                            <div style="position: absolute;bottom:50px;right:10%;">
                                <input type="submit" name = "submit" value = "提交" class="btn btn-w-m btn-info" ><br><br>
                            </div>
                    </form>
                    <!-- <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>昵称</th>
                        <th>真实姓名</th>
                        <th>性别</th>
                        <th>年龄</th>
                        <th>职务</th>
                        <th>工作单位</th>
                        <th>手机</th>
                        <th>既往病史</th>
                        <th>observe</th>
                        <th>rember</th>
                        <th>emotion</th>
                        <th>willpower</th>
                        <th>thinking</th>
                                            <th>操作</th>            
                    </tr>
                    </thead>
                    <tbody>
                                <form name = "form1" action = "/heartwaves/index.php/Admin/Organizeconstruct/editUserOk/uid/<?php echo ($data[0]["id"]); ?>" method = "post">
                            <tr class="gradeU">
                            <td><input type = "text" name = "id" value = "<?php echo ($data[0]["id"]); ?>" disabled></td>
                            <td><input type = "text" name = "nickname" value = "<?php echo ($data[0]["nickname"]); ?>"></td>
                            <td><input type = "text" name = "realname" value = "<?php echo ($data[0]["realname"]); ?>"></td>
                            <td><input type = "text" name = "sex" value = "<?php  if($data[0]['sex'] == 1){ echo '男'; }else{ echo '女'; } ?>"></td>
                            <td><input type = "text"  name = "birthday" value = "<?php echo ($data[0]["birthday"]); ?>"></td>
                            <td><input type = "text"  name = "position" value = "<?php echo ($data[0]["position"]); ?>"></td>
                            <td><input type = "text"  name = "workingplace" value = "<?php echo ($data[0]["workingplace"]); ?>"></td>
                            <td><input type = "text" id="tel" name = "mobile" value = "<?php echo ($data[0]["mobile"]); ?>"></td>
                            <td><input type = "text"  name = "medicalHistory" value = "<?php echo ($data[0]["medicalHistory"]); ?>"></td>
                                <td><input type = "text" name = "identity" value = "<?php echo ($data[0]["identity"]); ?>">
                                <select name = "identity" >
                                    <option selected><?php echo ($data[0]["identity"]); ?></option>
                                <?php foreach ($js as $key => $value): ?>
                                    <option value="<?php echo ($value['name']); ?>"><?php echo ($value['name']); ?></option>
                                <?php endforeach ?>
                                </select></td>
                                    <td>
                                <input type="submit" name = "submit" value = "提交" class="btn btn-w-m btn-info" ></a>
                            <a href="http://119.29.14.66/logisticsht/index.php?m=Admin&c=Order&a=transferOrderOk&id=<?php echo ($v["id"]); ?>"><button type="button" class="btn btn-w-m btn-info">转单</button></a>
                                <a href="http://119.29.14.66/logisticsht/index.php?m=Admin&c=Order&a=transferOrderfailed&id=<?php echo ($v["id"]); ?>"><button type="button" class="btn btn-w-m btn-danger">不通过</button></a>
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
                    </table> -->

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
<!--     <script type="text/javascript">
    $("#tel").blur(function(){
        var inputString = $("#tel").val();
        //alert(inputString);
        var partten = /^1[3,5,8,4]\d{9}$/;
         if(partten.test(inputString))
         {
               //alert('是手机号码');
               return true;
         }
         else
         {
               alert('请输入正确的手机号');
               return false;
         }
    })
</script> -->