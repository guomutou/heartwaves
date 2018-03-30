<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller
{
      //初始化方法
      function _initialize()
      {
            $m   = M("jingli");
            $arr = $m->where("username = '%s'", $_SESSION['username'])->find();
            if ($_SESSION['username'] == "" || $arr == null || $_SESSION['kouling'] != md5(md5($arr['kouling']))) {
                  $this->error('非法操作', U('Admin/Login/login'), 3);
            }
      }

      public function myRelust($result)
      {
            if ($result == false) {
                  $this->error("操作失败！");
            } else {
                  $this->success("操作成功！");
            }
      }

      public function deleteAll()
      {
            $m = M("{$_GET['model']}");
            if (empty($_POST['xuanze'])) {
                  $this->error("认真选择");
            } else {
                  $count = count($_POST['xuanze']);
                  for ($i = 0; $i < $count; $i++) {
                        $str .= $_POST['xuanze'][$i] . ",";
                  }
                  $str    = substr($str, 0, strlen($str) - 1);
                  $result = $m->where("id in ({$str})")->delete();
                  $this->myRelust($result);
            }
      }
}
