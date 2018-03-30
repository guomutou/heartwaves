<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
            $user= M("user");
            $userCount = $user->count();
            $this->assign("userCount",$userCount);
            $article= M("article");
            $articleCount = $article->count();
            $this->assign("articleCount",$articleCount);
            $liuyan= M("liuyan");
            $liuyanCount = $liuyan->count();
            $this->assign("liuyanCount",$liuyanCount);
            $comment= M("comment");
            $commentCount = $comment->count();
            $this->assign("commentCount",$commentCount);
            $getVersion = file_get_contents("http://www.lcm.wang/index.php/Home/Index/getVersion");
            $version = json_decode($getVersion,true);
            $this->assign("version",$version);
            $urlSite = C("URL_MODEL");
            $this->assign("urlSite",$urlSite);
    	$this->display();
    }

}
