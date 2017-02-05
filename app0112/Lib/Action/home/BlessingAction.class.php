<?php
class BlessingAction extends frontendAction {
	public function write_blessing(){
		if(IS_POST){
			$uid = $this->visitor->info['id'];
		
			if(empty($_POST['blessing'])){
				 $this->error('请填写祝福语');
			} 
			
			//上传图片
			$pic_1 = "";
			$pic_2 = "";
			$pic_3 = "";
			$picFile = $_FILES["pic_1"];
			if($picFile["error"] === 4) {
				$pic_1 = "";
			} else {
				$pic_1 = "data/upload/blessing/".time().$uid."_picurl1.jpg";
				$exist = file_exists($pic_1);
				if($exist) {
					unlink($pic_1);
				}
				 move_uploaded_file($picFile["tmp_name"],$pic_1);
			}
			$picFile = $_FILES["pic_2"];
			if($picFile["error"] === 4) {
				$pic_2 = "";
			} else {
				$pic_2 = "data/upload/blessing/".time().$uid."_picurl2.jpg";
				$exist = file_exists($pic_2);
				if($exist) {
					unlink($pic_2);
				}
				 move_uploaded_file($picFile["tmp_name"],$pic_2);
			}
			$picFile = $_FILES["pic_3"];
			if($picFile["error"] === 4) {
				$pic_3 = "";
			} else {
				$pic_3 = "data/upload/blessing/".time().$uid."_picurl3.jpg";
				$exist = file_exists($pic_3);
				if($exist) {
					unlink($pic_3);
				}
				 move_uploaded_file($picFile["tmp_name"],$pic_3);
			}
			//上传视频
			import("Think.ORG.Ftp.class.php");
			$config = array(
				'hostname' => '112.74.132.215', //服务器地址
				'username' => 'yumei',          //FTP用户名
				'password' => '123456',         //FTP密码
				'port' => 21                    //端口
			);
	 
			$ftp = new Ftp();
			//连接ftp服务器
			$ftp->connect($config);
			
			$path = $_FILES['video_1']['tmp_name'];
			if($path){
				if($_FILES['video_1']['size']>100*1024*1024){
					$this->error("上传的文件大小不能超过100M");
				}
				
				if(substr($_FILES['video_1']['type'],0,5)!='video'){
					$this->error("文件格式错误");
				}
				if($path){
					$rpath = 'data/upload/video/'.$uid.'_'.time().'_'.$_FILES['video_1']['name'];
					$ftp->upload($path,'yf/'.$rpath);
					$data['video_1'] = $rpath;
				}
			}
			
			$gender = $this->_post('gender','intval');
			$name = $this->_post('name','trim');
			$blessing = $this->_post('blessing','trim');
			$phone = $this->_post('phone','trim');
			$orderId = $this->_post('orderId','trim');
			
			$data['gender'] = $gender;
			$data['name'] = $name;
			$data['blessing'] = $blessing;
			$data['pic_1'] = $pic_1;
			$data['pic_2'] = $pic_2;
			$data['pic_3'] = $pic_3;
			
			$data['sendId'] = $uid;
			$data['add_time'] = time();
			$data['phone'] = $phone;
			$data['orderId'] = $orderId;
			
			if(M('user_blessings')->add($data)){
				$this->assign('saved','1');
				if($gender==1){
					$uname = $name."先生";
				}else if($gender = 2){
					$uname = $name."女士";
				}else{
					$uname = $name."先生/女士";
				}
				$this->assign('uname',$uname);
				$this->assign('blessing',$blessing);
				$this->assign('phone',$phone);
				$this->assign('saved','1');
			}
		}else{
			$phone = $this->_get('phone','trim');
			$this->assign('phone',$phone);
			$orderId = $this->_get('orderId','trim');
			$this->assign('orderId',$orderId);
		}
		$this->display();
	}
	
	

	public function new_year(){
		$this->display();
	}
	public function def_blessing(){
		$this->display();
	}
	
	public function blessing(){
		$phone = $this->_get('phone','trim');
		$blessing = M('user_blessings')->where(array('phone'=>$phone))->order('add_time desc')->limit('1')->select();
		if(count($blessing)>0){
			$this->assign('blessing',$blessing[0]);
			//送出祝福的用户名称
			$send_user = M('user')->where(array('id'=>$blessing[0]['sendId']))->field('username,cover')->find();
			$this->assign('send_user',$send_user);
			
			$this->display();
		}else{
			$this->redirect('Blessing/def_blessing');
		}	
	}
}
?>