-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 05 月 04 日 17:14
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `boke`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_article`
--

DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE IF NOT EXISTS `blog_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `pic` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `edittime` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `Comment` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `mp3` varchar(200) NOT NULL,
  `biaoqian` varchar(20) NOT NULL,
  `pingfen` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `blog_article`
--

INSERT INTO `blog_article` (`id`, `title`, `content`, `pic`, `uid`, `fid`, `ctime`, `edittime`, `view`, `Comment`, `status`, `mp3`, `biaoqian`, `pingfen`) VALUES
(13, '我在这里  你在哪里？', '我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？我在这里&nbsp; 你在哪里？\r\n\r\n                                    ', '2015-08-12/55ca3a3d10f7f.jpg', 1, 12, 1439316541, 1439316541, 126, 7, 0, '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `blog_blogliuyan`
--

DROP TABLE IF EXISTS `blog_blogliuyan`;
CREATE TABLE IF NOT EXISTS `blog_blogliuyan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `blog_blogliuyan`
--

INSERT INTO `blog_blogliuyan` (`id`, `uid`, `name`, `tel`, `email`, `content`, `ctime`, `ip`) VALUES
(1, 1, '李传明', '13552875303', '731371050@qq.com', '阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款阿什顿卡收到款', 1439044923, '127.0.0.1'),
(3, 0, '1111', '111', '7313711012350@qq.com', '11', 1457970754, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `blog_code`
--

DROP TABLE IF EXISTS `blog_code`;
CREATE TABLE IF NOT EXISTS `blog_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=162 ;

--
-- 转存表中的数据 `blog_code`
--

INSERT INTO `blog_code` (`id`, `code`, `status`, `user`) VALUES
(1, 'hkjchkagyaisu', 1, '7313710150@qq.com'),
(160, '0', 0, ''),
(161, 'asdasd', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `content` varchar(200) NOT NULL,
  `uid` int(11) NOT NULL,
  `replay` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `blog_comment`
--

INSERT INTO `blog_comment` (`id`, `name`, `email`, `content`, `uid`, `replay`, `ctime`, `aid`) VALUES
(38, '111', 'xx@qq.com', 'asdasdasd', 13, 0, 1453393489, 13),
(39, '111', 'xx@qq.com', 'asdasd', 13, 0, 1453393498, 13),
(40, 'MonkeyCode', '731371050@qq.com', 'asdasd', 1, 0, 1453393513, 13),
(41, 'asdasd', 'asdasd@qq.com', 'asdasd', 0, 0, 1453393529, 13),
(42, 'MonkeyCode', '731371050@qq.com', '123', 1, 0, 1454678768, 13),
(52, 'asdasd', 'asdasd@qq.com', 'asdasdasdasd', 0, 0, 1459696620, 13),
(53, '阿萨德阿萨德', '731371050@qq.com', '阿萨德', 0, 0, 1462375083, 13);

-- --------------------------------------------------------

--
-- 表的结构 `blog_email_set`
--

DROP TABLE IF EXISTS `blog_email_set`;
CREATE TABLE IF NOT EXISTS `blog_email_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smtpserver` varchar(200) NOT NULL COMMENT 'SMTP服务器',
  `smtpserverport` int(11) NOT NULL COMMENT 'SMTP服务器端口',
  `smtpusermail` varchar(200) NOT NULL COMMENT 'SMTP服务器的用户邮箱',
  `smtpuser` varchar(200) NOT NULL COMMENT 'SMTP服务器的用户帐号',
  `smtppass` varchar(200) NOT NULL COMMENT 'SMTP服务器的用户密码',
  `reg_set_admin` int(11) NOT NULL COMMENT '用户注册 管理员是否收到邮件 0是 1不是',
  `reg_set_user` int(11) NOT NULL COMMENT '用户注册 用户是否收到邮件 0是 1不是',
  `send_article_set` int(11) NOT NULL COMMENT '用户发表文章  管理员是否收到邮件 0是 1 不是',
  `comment_set` int(11) NOT NULL COMMENT '用户回复 管理员是否收到邮件 0是 1不是',
  `message_set` int(11) NOT NULL COMMENT '收到留言是否发邮件 0是 1不是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `blog_email_set`
--

INSERT INTO `blog_email_set` (`id`, `smtpserver`, `smtpserverport`, `smtpusermail`, `smtpuser`, `smtppass`, `reg_set_admin`, `reg_set_user`, `send_article_set`, `comment_set`, `message_set`) VALUES
(1, 'smtp.163.com', 25, 'zhaodong1475@163.com', 'zhaodong1475@163.com', 'zxc123456', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `blog_email_type`
--

DROP TABLE IF EXISTS `blog_email_type`;
CREATE TABLE IF NOT EXISTS `blog_email_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_user_title` varchar(200) NOT NULL COMMENT '用户注册用户收到邮件的标题',
  `reg_user_content` text NOT NULL COMMENT '用户注册用户收到邮件的内容',
  `reg_admin_title` varchar(200) NOT NULL COMMENT '用户注册管理员收到邮件的标题',
  `reg_admin_content` text NOT NULL COMMENT '用户注册管理员收到邮件的内容',
  `send_article_title` varchar(200) NOT NULL COMMENT '用户发文章管理员收到邮件的标题',
  `send_article_content` text NOT NULL COMMENT '用户发文章管理员收到邮件的内容',
  `send_comment_title` varchar(200) NOT NULL COMMENT '用户评论管理员收到邮件的标题',
  `send_comment_content` text NOT NULL COMMENT '用户评论管理员收到邮件的内容',
  `send_message_title` varchar(200) NOT NULL COMMENT '用户收到留言用户邮件的标题',
  `send_message_content` text NOT NULL COMMENT '用户收到留言用户邮件内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `blog_email_type`
--

INSERT INTO `blog_email_type` (`id`, `reg_user_title`, `reg_user_content`, `reg_admin_title`, `reg_admin_content`, `send_article_title`, `send_article_content`, `send_comment_title`, `send_comment_content`, `send_message_title`, `send_message_content`) VALUES
(1, '恭喜您注册本站', '<p></p><p>123asdasd</p><p><br/></p><p><br/></p><p><strong>111阿萨德阿萨德阿萨德阿萨德</strong><br/></p><p></p>', '有人注册本网站了', '<p></p><p>撒的阿萨德阿萨德撒的阿萨德<br/></p><p></p>', '有人发表文章了呦', '<p></p><p></p><p>阿萨德按时打算打算的阿萨德阿萨德<img src="http://img.baidu.com/hi/bobo/B_0004.gif" _src="http://img.baidu.com/hi/bobo/B_0004.gif"/>a</p><p></p><p></p>', '亲爱的管理员 有人评论文章了呦11122', '<p></p><p></p><p></p><p></p><p>阿萨德很卡金士顿贺卡上接电话卡接收到华盛顿安达市安达市阿萨德1111221</p><p></p><p></p><p></p><p></p>', '亲爱的管理员有用户留言了啊！', '<p></p><p>9<img src="http://img.baidu.com/hi/jx2/j_0002.gif" _src="http://img.baidu.com/hi/jx2/j_0002.gif"/></p><p>阿萨德安静收<strong>到货卡收到后卡萨达加</strong></p><p><strong>阿萨德阿萨德阿萨德安达</strong>市</p><p>阿萨德那就是的很快就阿萨德阿萨德阿萨德<br/></p><p></p>');

-- --------------------------------------------------------

--
-- 表的结构 `blog_fenlei`
--

DROP TABLE IF EXISTS `blog_fenlei`;
CREATE TABLE IF NOT EXISTS `blog_fenlei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `fid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `blog_fenlei`
--

INSERT INTO `blog_fenlei` (`id`, `name`, `fid`, `type`) VALUES
(1, '技术', 0, 2),
(2, 'PHP', 1, 1),
(3, '音乐', 0, 1),
(4, '电影', 0, 1),
(5, '心情', 0, 1),
(8, 'Css', 1, 1),
(10, '音乐分享', 3, 2),
(11, '电影赏评', 4, 3),
(12, '心灵之声', 5, 4),
(17, '111', 16, 1),
(15, 'asdasd', 14, 1);

-- --------------------------------------------------------

--
-- 表的结构 `blog_friendlink`
--

DROP TABLE IF EXISTS `blog_friendlink`;
CREATE TABLE IF NOT EXISTS `blog_friendlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(30) NOT NULL COMMENT '标题',
  `content` varchar(200) NOT NULL COMMENT '描述',
  `ctime` int(11) NOT NULL COMMENT '时间',
  `url` varchar(100) NOT NULL COMMENT '链接',
  `type` varchar(20) NOT NULL COMMENT '样式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `blog_friendlink`
--

INSERT INTO `blog_friendlink` (`id`, `title`, `content`, `ctime`, `url`, `type`) VALUES
(1, '斗图啊', '斗图啊是一个在线制作搞笑表情的网站', 1454596882, 'http://www.doutua.com/', 'info');

-- --------------------------------------------------------

--
-- 表的结构 `blog_gonggao`
--

DROP TABLE IF EXISTS `blog_gonggao`;
CREATE TABLE IF NOT EXISTS `blog_gonggao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` varchar(220) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `blog_gonggao`
--

INSERT INTO `blog_gonggao` (`id`, `title`, `content`, `ctime`) VALUES
(2, '阿萨德阿萨德阿萨德', ' 撒的阿萨德阿萨德阿萨德阿萨德阿萨德奥迪阿萨德阿萨德撒的撒的1111111111', 0);

-- --------------------------------------------------------

--
-- 表的结构 `blog_jingli`
--

DROP TABLE IF EXISTS `blog_jingli`;
CREATE TABLE IF NOT EXISTS `blog_jingli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `kouling` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blog_jingli`
--


-- --------------------------------------------------------

--
-- 表的结构 `blog_liuyan`
--

DROP TABLE IF EXISTS `blog_liuyan`;
CREATE TABLE IF NOT EXISTS `blog_liuyan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(10) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` varchar(100) NOT NULL,
  `ctime` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- 转存表中的数据 `blog_liuyan`
--

INSERT INTO `blog_liuyan` (`id`, `color`, `ip`, `title`, `content`, `ctime`, `name`) VALUES
(50, '#F7A54A', '127.0.0.1', 'ASDASDASD', 'asd', 1462370318, 'asd'),
(51, '#1A7BB9', '127.0.0.1', 'a', 'a', 1462373260, 'aaa'),
(52, '#1A7BB9', '127.0.0.1', '啊实打实的阿萨德啊', '阿萨德', 1462375005, '阿萨德');

-- --------------------------------------------------------

--
-- 表的结构 `blog_site`
--

DROP TABLE IF EXISTS `blog_site`;
CREATE TABLE IF NOT EXISTS `blog_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(200) NOT NULL,
  `articleSatus` int(11) NOT NULL COMMENT '0 无需审核 1 需要审核',
  `userStatus` int(11) NOT NULL COMMENT '0无需注册码 1需要注册码',
  `admin_email` varchar(100) NOT NULL,
  `set_content` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `statistics` text NOT NULL COMMENT '网站统计代码',
  `code` text NOT NULL COMMENT '邀请码说明',
  `friend_link` text NOT NULL COMMENT '友情链接说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `blog_site`
--

INSERT INTO `blog_site` (`id`, `title`, `keywords`, `description`, `logo`, `articleSatus`, `userStatus`, `admin_email`, `set_content`, `name`, `statistics`, `code`, `friend_link`) VALUES
(1, '里程密开源博客系统', '里程密|ThinkPHP开源博客系统456', '这里是一个网站描述11', '2015-12-02/565dc606b3238.jpg', 1, 0, '731371050@qq.com', '阿萨德阿萨德1', '里程密', '<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id=''cnzz_stat_icon_1256104530''%3E%3C/span%3E%3Cscript src=''" + cnzz_protocol + "s11.cnzz.com/stat.php%3Fid%3D1256104530'' type=''text/javascript''%3E%3C/script%3E"));</script>', '正如本站的名称一样，里程密，一个程序员里程的秘密，所以我们更希望这里是一个和谐干净的程序员呆的地方，\r\n而不希望这里像菜市场一样杂乱无章. ', '使用里程密开源博客系统 并且保持友情链接的网站 可以获得本站邀请码一枚和友情链接\r\n请把你的网站发送给管理员邮箱:lcm1475@aliyun.com 或者把你的网站信息发送给群主\r\n稍后就会添加上你网站的友情链接 ');

-- --------------------------------------------------------

--
-- 表的结构 `blog_slides`
--

DROP TABLE IF EXISTS `blog_slides`;
CREATE TABLE IF NOT EXISTS `blog_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `url` varchar(100) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `blog_slides`
--

INSERT INTO `blog_slides` (`id`, `title`, `pic`, `url`, `ctime`) VALUES
(1, '测试幻灯片', '2015-12-01/565d948a5b0b1.jpg', 'http://www.baidu.com/', 1448973450);

-- --------------------------------------------------------

--
-- 表的结构 `blog_user`
--

DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE IF NOT EXISTS `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `ctime` int(11) NOT NULL,
  `lasttime` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `truename` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `blog_user`
--

INSERT INTO `blog_user` (`id`, `email`, `password`, `ctime`, `lasttime`, `ip`, `status`, `truename`) VALUES
(1, '731371050@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 1438876696, 1462366870, '127.0.0.1', 0, 'MonkeyCode'),
(2, '7313710150@qq.com', '7555051b6d8a2dca27a29f9cb0d2e3a6', 1438876849, 0, '127.0.0.1', 0, 'asdasdasd'),
(3, '73137105120@qq.com', '39ee488c7696d8f3ee3456218666a3c9', 1439019702, 0, '127.0.0.1', 0, 'admin'),
(4, '12@qq.com', '9fe8593a8a330607d76796b35c64c600', 1448987693, 0, '127.0.0.1', 0, '678'),
(5, '456@qq.com', '49f0bad299687c62334182178bfd75d8', 1448987973, 0, '127.0.0.1', 0, 'asd'),
(6, 'qqq@qq.com', '7815696ecbf1c96e6894b779456d330e', 1448988041, 0, '127.0.0.1', 0, 'aaaaaa'),
(7, '22@qq.com', 'b6d767d2f8ed5d21a44b0e5886680cb9', 1448988121, 0, '127.0.0.1', 0, '22'),
(8, 'qq@qq.com', '202cb962ac59075b964b07152d234b70', 1450795590, 0, '127.0.0.1', 0, '123'),
(9, '731371012350@qq.com', '4297f44b13955235245b2497399d7a93', 1452020081, 0, '127.0.0.1', 0, '123123123'),
(10, '7313711012350@qq.com', '202cb962ac59075b964b07152d234b70', 1452020105, 0, '127.0.0.1', 0, '1231231232'),
(11, 'asdxsad@qq.com', '4297f44b13955235245b2497399d7a93', 1452020148, 0, '127.0.0.1', 1, '321ss'),
(12, '123@123.com', '202cb962ac59075b964b07152d234b70', 1453392488, 0, '127.0.0.1', 1, '1231231231111');

-- --------------------------------------------------------

--
-- 表的结构 `blog_userinfo`
--

DROP TABLE IF EXISTS `blog_userinfo`;
CREATE TABLE IF NOT EXISTS `blog_userinfo` (
  `uid` int(11) NOT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `biaoqian` varchar(200) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `gexing` varchar(250) DEFAULT NULL,
  `shanchangtitle1` varchar(30) DEFAULT NULL,
  `shanchangtitle2` varchar(30) DEFAULT NULL,
  `shanchangtitle3` varchar(30) DEFAULT NULL,
  `shanchangtitle4` varchar(30) DEFAULT NULL,
  `shanchangcontent1` varchar(250) DEFAULT NULL,
  `shanchangcontent2` varchar(250) DEFAULT NULL,
  `shanchangcontent3` varchar(250) DEFAULT NULL,
  `shanchangcontent4` varchar(250) DEFAULT NULL,
  `zuopintitle1` varchar(30) DEFAULT NULL,
  `zuopintitle2` varchar(30) DEFAULT NULL,
  `zuopintitle3` varchar(30) DEFAULT NULL,
  `zuopintitle4` varchar(30) DEFAULT NULL,
  `zuopincontent1` varchar(90) DEFAULT NULL,
  `zuopincontent2` varchar(90) DEFAULT NULL,
  `zuopincontent3` varchar(90) DEFAULT NULL,
  `zuopincontent4` varchar(90) DEFAULT NULL,
  `zuopinpic` varchar(255) DEFAULT NULL,
  `geyan` varchar(100) DEFAULT NULL,
  `pingjianan` varchar(200) DEFAULT NULL,
  `pingjianv` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blog_userinfo`
--

INSERT INTO `blog_userinfo` (`uid`, `pic`, `biaoqian`, `description`, `gexing`, `shanchangtitle1`, `shanchangtitle2`, `shanchangtitle3`, `shanchangtitle4`, `shanchangcontent1`, `shanchangcontent2`, `shanchangcontent3`, `shanchangcontent4`, `zuopintitle1`, `zuopintitle2`, `zuopintitle3`, `zuopintitle4`, `zuopincontent1`, `zuopincontent2`, `zuopincontent3`, `zuopincontent4`, `zuopinpic`, `geyan`, `pingjianan`, `pingjianv`) VALUES
(3, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1, 'UserPic/1_big.jpg', '逗比,123123123不装逼会死星人,照镜子会被自己迷住,帅比', '本人学识渊博、经验丰富，代码风骚、效率恐怖，c/c++、java、php无不精通，熟练掌握各种框架，深山苦练20年，一天只睡3个小时，电话通知出bug后秒登vpn，千里之外定位问题，瞬息之间修复上线，本人身体强壮，健步如飞，可连续编程100小时不休息，讨论技术方案5小时不喝水，上至带项目、出方案，下至盗账号、威胁pm，学校不支持编程已辍学，家人不支持编程已断绝关系，老婆不支持编程已离婚，小孩不支持编程已送孤儿院，备用电源百兆光纤永不断电断网，门口已埋雷无人打扰， 现本人求一份it公司端茶递水工作', '一个想法会有很多人想到并且去做 而你成功的重点在于没有人想比你把这件事做的更好！', '撸管', '打屁', 'PHP写代码', '睡觉', '可以360度花式撸管，曾经运用360无死角撸管招式或者吉尼斯撸管大赛冠军。', '最喜欢的就是扯皮了，小嘴啪啪啪的不停，一个矿泉水，一包瓜子，别提多开心了。', 'PHP是什么？PHP顾名思义，就是拍黄片的意思，好了，说正经的，PHP是一门语言，讲究说学逗唱...........', '睡觉是世界上最舒服的事情，当然了。无论两个人睡，或者一个人睡，都挺舒服的，两个人可以你懂得，一个人可以睡懒觉。想想都爽啊~', '百度', '谷歌', 'Facebook', 'YouTube', '百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的，百度是我做的', '谷歌也是我做的，谷歌也是我做的，谷歌也是我做的，谷歌也是我做的谷歌也是我做的谷歌也是我做的谷歌也是我做的，谷歌也是我做的，', 'Facebook是我的，Facebook是我的，Facebook是我的，Facebook是我的，Facebook是我的，Facebook是我的，Facebook是我的，Facebo', 'YouTube是我的，YouTube是我的，YouTube是我的，YouTube是我的，YouTube是我的，YouTube是我的，YouTube是我的，YouTube是我的，Yo', '', '如果一个男人把撸管的时间放在奋斗上，那么一定有女人愿意帮你撸管。', '长的特别帅，人品也非常好，学识渊博，经验丰富，代码风骚，效率恐怖....我说完了，能把枪拿开了么？', '长的帅这个就不用说了，主要是特别有气质，真想嫁给他，给他生一堆小猴子，我也说完了，能把坦克开走了么？'),
(4, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 'default.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
