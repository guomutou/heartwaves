<?php
namespace Home\Controller;
use Think\Controller;
class HtmlController extends BaseController {
	//店铺页
	public function dianpu(){
		$this->display();
	}
	//内容页
	public function neirong(){
		$this->display();
	}
}
