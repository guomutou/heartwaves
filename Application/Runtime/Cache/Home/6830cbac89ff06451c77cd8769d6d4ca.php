<?php if (!defined('THINK_PATH')) exit();?><!-- 调用头部文件 -->
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>会员中心-<?php echo ($SiteInfo["title"]); ?></title>
    <meta name = "keywords" content="<?php echo ($SiteInfo["keywords"]); ?>" >
    <meta name = "description" content="<?php echo ($SiteInfo["description"]); ?>" >
    <link href="/heartbrain/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/heartbrain/Public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/heartbrain/Public/css/animate.css" rel="stylesheet">
    <link href="/heartbrain/Public/css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header" style="text-align:center;">
                        <div class="dropdown profile-element"> <span>
                        <a href="/heartbrain/index.php">
                            <img alt="image" class="img-circle" src="/heartbrain/Public/Uploads/<?php echo ($SiteInfo["logo"]); ?>" width="80px;"  height="80px;" />
                        </a>
                        </span>
                        <span class="clear"> <span class="block m-t-xs" style = "color:#fff;"> <strong class="font-bold"><?php echo ($SiteInfo["name"]); ?></strong>
                        </span> <span class="text-muted text-xs block"><?php echo ($SiteInfo["set_content"]); ?></span> </span>
                    </div>
                    <div class="logo-element">
                        <?php echo ($SiteInfo["name"]); ?>
                    </div>
                </li>
                <?php if(is_array($fenleiListone)): foreach($fenleiListone as $key=>$vo): ?><li class="">
                    <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label"><?php echo ($vo["name"]); ?></span><span class="fa arrow"></span></a>
                    <ul style="height: 0px;" aria-expanded="false" class="nav nav-second-level collapse">
                        <?php if(is_array($fenleiListtwo)): foreach($fenleiListtwo as $key=>$vs): if($vo["id"] == $vs['fid']): ?><li><a href="<?php echo U('Fenlei/index',array('id'=>$vs['id']));?>"><?php echo ($vs["name"]); ?></a></li><?php endif; endforeach; endif; ?>
                    </ul>
                </li><?php endforeach; endif; ?>
                <li>
                    <a href="<?php echo U('Message/index');?>"><i class="fa fa-globe"></i> <span class="nav-label">留言板</span><span class="label label-info pull-right">NEW</span></a>
                </li>
                <li>
                    <a href="<?php echo U('Userlist/index');?>"><i class="fa fa-globe"></i> <span class="nav-label">本站会员</span></a>
                </li>
                <li>
                    <a href="<?php echo U('Index/yaoqingma');?>"><i class="fa fa-globe"></i> <span class="nav-label" style = "color:#ED5565;">邀请码与友链</span></a>
                </li>
                    </ul>

                </div>
            </nav>
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            <form role="search" class="navbar-form-custom" action="<?php echo U('Index/serch');?>" method="post">
                                <div class="form-group">
                                    <input type="text" placeholder="搜索框在这里......" class="form-control" name="keywords" id="top-search" required>
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <span class="m-r-sm text-muted welcome-message">欢迎来到<?php echo ($SiteInfo["name"]); ?>，有你代码，有你的风格！</span>
                            </li>
                        <?php if($_SESSION['muser']!= ''): ?><li class="dropdown">
                                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="javascript:void(0)">
                                    <i class="fa fa-envelope"></i>  <span class="label label-warning">家</span>
                                </a>
                                <ul class="dropdown-menu dropdown-messages">
                                    <li>
                                        <div class="dropdown-messages-box">
                                            <div class="media-body">
                                                <strong><a href="<?php echo U('User/index');?>">进入会员中心</a></strong>. <br>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="dropdown-messages-box">
                                            <div class="media-body ">
                                                <strong><a href="<?php echo U('User/logout');?>">退出登陆</a></strong>. <br>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <div class="text-center link-block">
                                                <i class="fa fa-envelope"></i> <strong>里程密和你在一起</strong>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <li>欢迎你，<?php echo (session('muser')); ?></li>
                        <?php else: ?>
                            <li>
                                <a data-toggle="modal" href="#myModal6">注册</a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#modal-form">登陆</a>
                            </li><?php endif; ?>
                        </ul>

                    </nav>
                </div>
                <!-- 登陆在这里开始 -->
                <div style="display: none;" class="modal inmodal fade in" id="modal-form" tabindex="-1" role="dialog" aria-hidden="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">登陆中心</h4>
                            </div>
                            <div class="modal-body">

                                <form class="form-horizontal" action="<?php echo U('User/login');?>" method="post">
                                    <p>没有账号可不要乱登陆哦</p>
                                    <div class="form-group"><label class="col-lg-2 control-label">邮箱</label>

                                        <div class="col-lg-10"><input placeholder="请输入邮箱" class="form-control" type="email" name = "email" required>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">密码</label>

                                        <div class="col-lg-10"><input placeholder="请输入密码" class="form-control" type="password" name = "password" required></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-5 col-lg-7">
                                            <button class="btn btn-sm btn-white" type="submit">点击登陆</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- 登陆结束 -->


                <!-- 注册开始 -->
                <div style="display: none;" class="modal inmodal fade in" id="myModal6" tabindex="-1" role="dialog" aria-hidden="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">注册中心</h4>
                            </div>
                            <div class="modal-body">

                                <form class="form-horizontal" action="<?php echo U('User/reg');?>" method="post">
                                    <p>注册的前提是你必须有邀请码.</p>
                                    <div class="form-group"><label class="col-lg-2 control-label">邮箱</label>

                                        <div class="col-lg-10"><input placeholder="请输入邮箱" class="form-control" type="email" required name = "email">
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-lg-2 control-label">密码</label>

                                        <div class="col-lg-10"><input placeholder="请输入密码" class="form-control" type="password" required name = "password"></div>
                                    </div>
                                     <div class="form-group"><label class="col-lg-2 control-label" >昵称</label>

                                        <div class="col-lg-10"><input placeholder="请输入昵称（一旦注册无法修改！）" class="form-control" type="text" required name = "truename">
                                        </div>
                                    </div>
                                    <?php if($SiteInfo["userstatus"] == 1): ?><div class="form-group"><label class="col-lg-2 control-label" >邀请码</label>

                                        <div class="col-lg-10"><input placeholder="请输入邀请码" class="form-control" type="text" required name = "code">
                                        </div>
                                    </div><?php endif; ?>
                                    <div class="form-group">
                                        <div class="col-lg-offset-5 col-lg-7">
                                            <button class="btn btn-sm btn-white" type="submit">点击注册</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- 注册结束 -->

<!-- 本页导航栏开始 -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>会员中心</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/heartbrain/index.php">首页</a>
            </li>
            <li class="active">
                <strong>会员中心</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<!-- 本页导航栏结束 -->

<!-- 正文开始 -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
<div class="wrapper wrapper-content">
        <div class="row">
                        <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <a class="btn btn-block btn-primary compose-mail" href="<?php echo U('User/addArticle');?>">写一篇文章</a>
                            <div class="space-25"></div>
                            <h5>我的信息</h5>
                            <ul class="folder-list m-b-md" style="padding: 0">
                                <li><a href="<?php echo U('User/userInfo');?>"> <i class="fa fa-inbox "></i> 基本信息 <span class="label label-navy pull-right">账号信息</span></a></li>
                                <li><a href="<?php echo U('User/detail');?>"> <i class="fa fa-envelope-o"></i>主页信息<span class="label label-danger pull-right">个人主页</span></a></li>
                                <li><a href="<?php echo U('User/liuyan');?>"> <i class="fa fa-certificate"></i> 我的留言<span class="label label-primary pull-right">查看留言</span></a></li>
                                <li><a href="javascript:void(0)" onclick="alert('暂未对外开放')"> <i class="fa fa-file-text-o"></i> 我的私信<span class="label label-info pull-right">TA的小纸条</span>
                                <li><a href="<?php echo U('User/gonggao');?>"> <i class="fa fa-trash-o"></i>我的通知<span class="label label-warning pull-right">管理员的公告</span></a></li>
                            </ul>
                            <h5>我的文章</h5>
                            <ul class="category-list" style="padding: 0">
                                <li><a href="<?php echo U('User/myArticle');?>"> <i class="fa fa-circle text-navy"></i>我发布的</a></li>
                            </ul>

                            <h5 class="tag-title">创业板块</h5>
                            <ul class="tag-list" style="padding: 0">
                                <li><a href="default.htm"><i class="fa fa-tag"></i> 暂未开放</a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
            <center>
                <h2>
                    会员中心主页
                </h2>
            </center>
            </div>
                <div class="mail-box" style="padding-top:10px;">
                    <center>
                    <h1>亲爱的程序员<?php echo (session('muser')); ?>,欢迎你回家</h1>
                    <h1>希望你能遵守这里的每一条规则</h1>
                    <h1>我们共同让这里变得更美好</h1>
                    <h1>代码的世界里面没有喧嚣</h1>
                    <h1>但请你记住</h1>
                    <h1>We Will Change The World</h1>
                    <h1>你能做的事情都在左边</h1>
                    </center>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
    </div>
<!-- 正文结束 -->

<!-- 调用脚部文件 -->
      <a href="#0" class="cd-top">↑</a>
        <div class="footer" style="z-index:9999;">
            <div class="pull-right">
               <a href="<?php echo U('Admin/Index/index');?>" target="_blank">后台登陆</a>&nbsp;&nbsp;<strong>如果你使用本站程序</strong> 请保留友情链接.
            </div>
            <div>
                <strong>Copyright</strong> <a href="http://www.lcm.wang/">里程密</a> &copy; 2014-2016
                管理员邮箱：<?php echo ($SiteInfo["admin_email"]); ?>&nbsp; &nbsp;统计：<?php echo ($SiteInfo["statistics"]); ?>
            </div>
        </div>

        </div>
        </div>

    <script src="/heartbrain/Public/js/jquery-2.1.1.js"></script>
    <script src="/heartbrain/Public/js/jquery-ui-1.10.4.min.js"></script>
    <script src="/heartbrain/Public/js/bootstrap.min.js"></script>
    <!-- 手风琴菜单 -->
    <script src="/heartbrain/Public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <!-- 滚动条 -->
    <script src="/heartbrain/Public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- 导航菜单 -->
    <script src="/heartbrain/Public/js/inspinia.js"></script>
    <!-- 进度条 -->
    <script src="/heartbrain/Public/js/plugins/pace/pace.min.js"></script>

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
        <!-- 返回顶部 -->
        <script>
                jQuery(document).ready(function($){
    // browser window scroll (in pixels) after which the "back to top" link is shown
    var offset = 300,
        //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.cd-top');

    //hide or show the "back to top" link
    $(window).scroll(function(){
        ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if( $(this).scrollTop() > offset_opacity ) {
            $back_to_top.addClass('cd-fade-out');
        }
    });

    //smooth scroll to top
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0 ,
            }, scroll_top_duration
        );
    });

});
        </script>
</body>

</html>