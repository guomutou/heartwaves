<?php
return array(
    //'配置项'=>'配置值'
        'DB_TYPE'   => 'mysqli', // 数据库类型
        'DB_HOST'   => '172.21.0.9', // 服务器地址
        'DB_NAME'   => 'heartwaves', // 数据库名
        'DB_USER'   => 'root', // 用户名
        'DB_PWD'    => 'Hrv123456',  // 密码
        'DB_PORT'   => '3306', // 端口
        'DB_PREFIX' => 'h_', // 数据库表前缀
        'SHOW_PAGE_TRACE' =>false,  //
        'SHOW_ERROR_MSG' =>    false,
        'URL_MODEL'             =>  0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
        // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
        'URL_HTML_SUFFIX'       =>  'html',  // URL伪静态后缀设置
        'ERROR_MESSAGE'  =>    '发生错误！'
        // 'ERROR_PAGE' =>'http://www.myDomain.com/Public/error.html'

         );
