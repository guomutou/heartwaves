<?php

namespace Home\Controller;

use Think\Controller;

class GResult {

	private static $instance=null;
	
	
 	private function __construct(){
 		
    }
    
    public static function getInstance(){
        if(self::$instance==null){
                self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function  __clone(){ //pretend clone oprationg
        throw('Singleton class can not be cloned');
        return self::getInstance();
    }
    
    public function echoOkAndResult(){

    	$num=func_num_args();
    	$list=func_get_args();
        //$obj['status']['succeed'] = '1';;
    	// $obj['status']['succeed'] = 1;
        $obj['status']='1';
    	for($i=0;$i<$num;$i++)
    	{
    		if($list[$i])
    			$obj+= $list[$i];
    	}

    	echo urldecode ( json_encode ( $this->to_utf8 ( $obj ) ) );
    }
    public function echoOk2AndResult(){
    	$num=func_num_args();
    	$list=func_get_args();
    	$obj ['isOK'] = 2;
    	for($i=0;$i<$num;$i++)
    	{
    	if($list[$i])
    		$obj += $list[$i];
    	}
    	echo urldecode ( json_encode ( $this->to_utf8 ( $obj ) ) );
    }
    
    public function echoErro1AndMessage(){
    	$obj ['isOK'] = -1;
    	$num=func_num_args();
    	if($num != 0)
    	{
    		$list=func_get_args();
    		$obj ['result'] = $list[0];
    	}
    	echo urldecode ( json_encode ( $this->to_utf8 ( $obj ) ) );
    }
    public function echoErroAndMessage(){
    	$num=func_num_args();
    	$list=func_get_args();
        //$obj['status']['succeed'] = '0';;
    	// $obj['status']['succeed'] = 1;
        $obj['status']=1;
    	for($i=0;$i<$num;$i++)
    	{
    		if($list[$i])
    			$obj+= $list[$i];
    	}

    	echo urldecode ( json_encode ( $this->to_utf8 ( $obj ) ) );
    }
    
    public function echoGameDataErro(){
    	$obj ['isOK'] = -100;
    	$obj ['result'] = 'game data is be changed!!!';
    	echo urldecode ( json_encode ( $this->to_utf8 ( $obj ) ) );
    }
	
	private function to_utf8($in) {
		if (is_array ( $in )) {
			foreach ( $in as $k => $e ) {
				if (is_array ( $e )) {
					$in [$k] = $this->to_utf8 ( $e );
				} else {
					$in [$k] = urlencode ( $e );
				}
			}
			return $in;
		}
	}
}
?>