1.友情链接公告修改
2.进入作者主页后点击回到里程密 跳入的是官网
3.增加返回顶部
4.留言板增加验证码
6.修复分页BUG
7.跳转样式修改
8.增加留言批量删除
9.清理缓存抛出异常抱错
10.增加在线升级
11.修复注册失败BUG
12.修复安装失败BUG
13.增加多URL访问模式 支持nginx
数据库具体修改：
ALTER TABLE `blog_site` ADD `code` TEXT NOT NULL COMMENT '邀请码说明',
ADD `friend_link` TEXT NOT NULL COMMENT '友情链接说明'


 官网网址： http://www.lcm.wang/
    交流群群号： 132020914