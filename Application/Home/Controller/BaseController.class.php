<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    protected $email_set;
    protected $admin_email;
    protected $CAPTCHA_ID = "c6a8f518771d8ea164fd92890d5685b7";
    protected $PRIVATE_KEY = "5eff47a446c7f4958cef79f9e16b16c7";
    public function _initialize(){
        $fenlei = M("fenlei");
        $fenleiListone = $fenlei->where("fid = 0")->select();
        $fenleiListtwo = $fenlei->where("fid != 0")->select();
        $this ->assign("fenleiListone",$fenleiListone);
        $this->assign("fenleiListtwo",$fenleiListtwo);
        $Site = M("site");
        $SiteInfo =$Site->find(1);
        $this->SiteInfo = $SiteInfo;
        $this->assign("SiteInfo",$SiteInfo);
        /*查询邮件配置*/
        $emailModel = M("email_set");
        $email_set = $emailModel->find(1);
        $this->email_set = $email_set;
        /*设置管理员邮箱*/
        $this->admin_email = $SiteInfo['admin_email'];
    }

    /*发送邮件方法*/
    protected function MySmtp($smtpemailto,$mailtitle,$mailcontent){
        $email = new \Org\Util\Smtp();
        $email->smtp($this->email_set['smtpserver'],$this->email_set['smtpserverport'],true,$this->email_set['smtpuser'],$this->email_set['smtppass']);
        $email->debug = false;//是否显示发送的调试信息
        $state = $email->sendmail($smtpemailto,$this->email_set['smtpusermail'], $mailtitle, $mailcontent,"HTML");
    }


    /*极验验证验证码*/
    public function EchoMyVerify(){
        $GtSdk = new \Org\Util\GeetestLib($this->CAPTCHA_ID,$this->PRIVATE_KEY);
        $user_id = "test";
        $status = $GtSdk->pre_process($user_id);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $user_id;
        echo $GtSdk->get_response_str();
    }

    public function CheckMyVerify(){

    }
    function Sec2Time($time){
    if(is_numeric($time)){
    $value = array(
      "years" => 0, "days" => 0, "hours" => 0,
      "minutes" => 0, "seconds" => 0,
    );
    if($time >= 31556926){
      $value["years"] = floor($time/31556926);
      $time = ($time%31556926);
    }
    if($time >= 86400){
      $value["days"] = floor($time/86400);
      $time = ($time%86400);
    }
    if($time >= 3600){
      $value["hours"] = floor($time/3600);
      $time = ($time%3600);
    }
    if($time >= 60){
      $value["minutes"] = floor($time/60);
      $time = ($time%60);
    }
    $value["seconds"] = floor($time);
    //return (array) $value;
    $t=$value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
    Return $t;
    
     }else{
    return (bool) FALSE;
    }
 }

}
