<?php
class simmsgAction extends Action{
	
	public function index(){
		$this->display();
	}
	public function send_msg(){
		$wxsend   = new Wxsend();
		$msg_type = $this->_post('msg_type','trim'); //消息类型
		$username = $this->_post('username','trim'); //要给谁发
		$price = $this->_post('price','trim'); //提成金额
		$time = $this->_post('time','trim'); //发送时间
		$i_name = $this->_post('i_name','trim'); //自己的姓名
		$level = $this->_post('level','trim'); //自己的级别
		$down_name = $this->_post('down_name','trim'); //下级代理的姓名
		$down_wx = $this->_post('down_wx','trim'); //下级代理的微信号
		$down_phone = $this->_post('down_phone','trim'); //下级代理的手机号码
		$down_price = $this->_post('down_price','trim'); //招募代理的提成奖励，200，120，40
		$lastlv = "店长";
		
		if($msg_type == 1){
			if(empty($price)){
				$this->error('提成金额还未填写');
			}else{
				$wxsend->SR($username,round($price,2)."(待结算)",$time);
				$this->success('订单待结算消息已成功发出，请在微信客户端内查看');
			}
		}elseif($msg_type ==2){
			if(empty($price)){
				$this->error('提成金额还未填写');
			}else{
				$wxsend->SR($username,round($price,2)."",$time);
				$this->success('订单确认收货消息已成功发出，请在微信客户端内查看');
			}
		}else{
			if(empty($down_name)){
				$this->error('下级代理姓名未填写');
			}elseif(empty($down_wx)){
				$this->error('下级代理微信未填写');
			}elseif(empty($down_phone)){
				$this->error('下级代理商手机号码未填写');
			}elseif(empty($down_price)){
				$this->error('提成奖励还未填写');
			}else{
				$data = array(
					"text"=>$i_name.$level.",又有一名".$lastlv."归到您的麾下,名片如下:",
					"username"=>$down_name,
					"wxname"=>$down_wx,
					"phone_mob"=>$down_phone
				);
				$wxsend->DLTZ($username,$data);
				$wxsend->SR($username,$down_price,$time,"代理培训奖金");
				$this->success('新代理加入消息已成功发出，请在微信客户端内查看');
			}
		}

	}

}
?>