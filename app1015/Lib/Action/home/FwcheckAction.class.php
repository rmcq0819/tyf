<?php
/** 
 *   防伪码
 *   @author  vany
 *   date    2015 06 5 
 *       
 */
class FwcheckAction extends frontendAction {

    public function _initialize() {
        parent::_initialize();
        $this->_mod=M('fwm');
       
    }
    /**
     * 商品详细页
     */
    public function index() {
    	if (IS_POST){
    		$data['code']=$_POST['code'];
    		$res=$this->_mod->where($data)->find();
    		if ($res) {
    			$date=array('success'=>"防伪码存在,验证成功!");
    		}else{
    			$date=array('error'=>"防伪码不存在,验证失败!");
    		}
    		echo json_encode($date);
    	}else{				
        	$this->display();
    	}
    }
	
}