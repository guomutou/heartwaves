<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>登陆</title>

    <link href="/heartwaves/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/heartwaves/Public/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/heartwaves/Public/css/animate.css" rel="stylesheet">
    <link href="/heartwaves/Public/css/style.css" rel="stylesheet">
<style type="text/css">
      #bg {
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
    }

    #bg img {
        position:absolute;
        left:0;
        right:0;
        bottom:0;
        margin:auto;
        width:100%;
        height:100%;
        z-index:-1;
    }
</style>
</head>

<body class="gray-bg" style="">
     <div id="bg">
        <img src="/heartwaves/Public/img/heartbg.jpg" alt="">
    </div>
    <div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">　</h1>

            </div>
            <h3 style="color:#fff;">欢迎使用HRV调节训练系统管理平台</h3>
            <!-- <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views. -->
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            <!-- </p> -->
            <!-- <p>Login in. To see it in action.</p> -->
            <form class="m-t" role="form" action="<?php echo U('Login/checklogin');?>" method="post">
                <div class="form-group">
                    <input type="username" class="form-control" placeholder="用户名" required="" name="username">
                </div>
               <!--  <div class="form-group">
                   <input type="password" class="form-control" placeholder="口令" required="" name="kouling">
               </div> -->
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required="" name="password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="javascript:void(0);" onclick="alert('想找回密码是吧?然而这并没有什么卵用,忘记密码的话请联系工作人员');"><small>忘记密码?</small></a>
                <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p> -->
                <!-- <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> -->
            </form>
            <p class="m-t"> <small>版权所有&copy; 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/heartwaves/Public/js/jquery-2.1.1.js"></script>
    <script src="/heartwaves/Public/js/bootstrap.min.js"></script>

</body>

</html>