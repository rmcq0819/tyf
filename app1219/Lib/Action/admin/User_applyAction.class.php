<?php
/** 
 *   会员申请开店
 *   @author  vany
 *   date    2015-12-2 
 *       
 */
class User_applyAction extends backendAction {
	public function _initialize(){
		parent::CheckLogin();
		$this->_mod = D('user_apply');
		$this->_user = M('user');
	}
	
	public function index(){
		/*2016-04-27 by shuguang
		$keyword = $this->_get('keyword','trim');
		$i = $this->_get('id','intval');
		*/
		//$map = array();
		$map = $this->_search();
		/*
		$keyword && $map['username|merchant'] = array('like','%'.$keyword.'%');
		if($i == 2){
			$map['hq_status'] = array('gt',0);
		}else{
			$map['up_status'] = $i;
			$map['hq_status'] = 0;
		}
		$this->assign('id',$i);
		*/
		$this->_list($this->_mod,$map);
		//echo $this->_mod->getlastsql();
		$this->display();
	}

	/**
     * 获取请求参数生成条件数组
     */
    public function _search() {
    	$keyword = $this->_get('keyword','trim');
		$i = $this->_get('id','intval');
        //生成查询条件
        $map = array();
        $keyword && $map['username|merchant'] = array('like','%'.$keyword.'%');
        if($i == 2){
			$map['hq_status'] = array('gt',0);
		}else{
			$map['up_status'] = $i;
			$map['hq_status'] = 0;
		}
		$this->assign('id',$i);

        if($_GET['time_start'] && $_GET['time_end']){
        	$map['support_time']= array('between', array(strtotime($_GET['time_start']),strtotime($_GET['time_end'])));
        }

        if($_GET['add_time_start'] && $_GET['add_time_end']){
            $map['add_time']= array('between', array(strtotime($_GET['add_time_start']),strtotime($_GET['add_time_end'])));
        }

        if($_GET['part'] != 2 && $_GET['part'] != ''){
            $map['part']= array('eq',$_GET['part']);
        }

        return $map;
    }

	public function delete(){	
		$data['id'] = $this->_get('id','intval');
		!$data['id'] && $this->_400();
		$res = $this->_mod->where($data)->delete();
		if ($res !== false) {
			$this->success('删除成功!');
		}else{
			$this->error('删除失败!');
		}
	}


/** 
 *
 *   hq_pass()
 *   get_fc($id,$fencheng,$n,$m)
 *   Modify By Liuyumei
 *   date    2016-07-03
 *       
 */
		public function hq_pass(){
		$data0['id'] = $this->_get('id','intval');//申请审核的用户id
		$data['hq_status'] = $this->_get('act','intval');
		$data['hq_do_time'] = time();
		$check =  $this->_mod->where($data0)->find();//审核之前
		//修改用户申请表状态
		$res = $this->_mod->where($data0)->save($data);	//审核
		if ($res !== false) {//审核通过
			$user = $this->_mod
				->join("a left join __USER__ as b on a.userid = b.id ")
				->where("a.id = ".$data0['id'])
				->field('a.*,b.wechatid')
				->find();
			if($check['hq_status'] == 0){//总部审核之前的状态为未处理
				//实例化模版信息类		
				$wxsend = new Wxsend();
				$date = date('Y-m-d H:i:s',$user['hq_do_time']);
				//发送模版信息通知申请会员审核结果
				$wxsend->SH($user['wechatid'],$user['username'],$user['wxname'],$user['phone_mob'],$user['hq_status'],$date);
				//$wxsend->SH('oOejpwvMFZF5-J1VkOpyU-AbIS1E',$user['username'],$user['wxname'],$user['phone_mob'],$user['hq_status'],$date);
				//发送客服信息通知申请会员的上级会员审核结果
				$share  = $this->_user
						  ->join("a left join weixin_user_category as b on a.uid = b.id")// a.uid、b.id会员组id
						  ->where(array('a.id'=>$user['shares']))//$user['shares'] 上一级分销商id
						  ->field('a.*,b.name')
						  ->find();
				
				$lastlv = M("user_category")->where(array('id'=>$share['uid']+1))->find();
				if($user['hq_status'] == 1){
					$data = array(
							"text"=>$share['username'].$share['name'].",又有一名".$lastlv['name']."归到您的麾下,名片如下:",
							"username"=>$user['username'],
							"wxname"=>$user['wxname'],
							"phone_mob"=>$user['phone_mob']
					);
					$wxsend->DLTZ($share['wechatid'],$data);
				}else{
					$text = '尊敬的'.$share["username"].',很遗憾,您的代理:'.$user["username"].'未通过二次审核.如有疑问请联系客服！';
					$wxsend->KF_M($share['wechatid'],$text);
					exit;
				}
				if($user['part']==1){
                    //1是店长
				    $data1['uid']=3;
                } 
				$data1['ren_time']	 = time();
				$data1['password']	 = md5("123456");
				$data1['status']	 = 1;
				$data1['nickname']	 = $user['username'];
				$data1['merchant']	 = $user['merchant'];
				$data1['m_desc']	 = $user['m_desc'];
				$data1['address'] 	 = $user['address'];
				$data1['phone_mob']	 = $user['phone_mob'];
				$data1['card']		 = $user['card'];
				$data1['email']		 = $user['email'];
				$data1['shares_tree']= $user['shares_tree'];
				$data1['reshares']		 = $user['reshares'];
				//判断直推店长是否升级成为育成掌柜
				$reshares = $this->_user->where(array('id'=>$user['reshares']))->find();
				if($reshares['uid'] == 2){
					$data1['shares']	 = $user['reshares'];
				}else{
					$data1['shares']	 = $user['shares'];
				}
				$this->_user->where(array('id'=>$user['userid']))->save($data1);
				//获取推荐分成率
				$fencheng = M('user_fengchenglv')->where(array('id'=>4))->field('royalty,status')->find();
				$fc   = explode('|',$fencheng['royalty']);
				$data = array();
				$data['state'] = 1;
				$data['type'] = 1;
				
				$tree = explode('|',$user['shares_tree']);//直接上级的shares_tree
				if(count($tree)<3){
					return 0;
				}
				$num=count($tree);
				$data['fencheng'] = $fc[1];   //+200
				$data['price'] = $fc[1];
				$data['uid'] = $tree[$num-2];
				$data['add_time'] = time();
				$data['user_id'] = $check['userid'];
				$reshares = M('user')->where(array('id'=>$tree[$num-2]))->field('uid,wechatid,id,username')->find();
				$wxsend->SR($reshares['wechatid'],$data['fencheng'],date("Y-m-d H:i:s"),"代理培训奖金");
				//$wxsend->SR('oOejpwvMFZF5-J1VkOpyU-AbIS1E',$data['fencheng'],date("Y-m-d H:i:s"),"代理培训奖金");
				M("user_fengchengllist")->add($data);
				if($reshares['uid']==2){
					$this->get_fc($tree[$num-2],$fencheng['royalty'],$check['userid'],0,2);//再往上为 +40 +40  0用于获取分成数组中的40
				}else if($reshares['uid']==3){
					$this->get_fc($tree[$num-2],$fencheng['royalty'],$check['userid'],2,3);//再往上为 +120 +40 +40  2用于获取分成数组中的120
				}	
			}
			$this->success("操作成功!",U('User_apply/index',array('id'=>1)));
		}else{
			$this->error("操作失败!",U('User_apply/index',array('id'=>1)));
		}
	}

	public function get_fc($id,$fencheng,$mid,$n,$m){
		$user = M('user')->where(array('id'=>$id))->field('shares_tree')->find();
		$tree = explode('|',$user['shares_tree']);//直接上级的shares_tree
		$m--;
		if($m<0||count($tree)<3){
			return 0;
		}
		//实例化模版信息类		
		$wxsend = new Wxsend();
		$data['state'] = 1;
		$data['type'] = 1;
		$fc = explode('|',$fencheng);
		$num=count($tree);
		
		$share = M('user')->where(array('id'=>$tree[$num-2]))->field('uid,wechatid,shares_tree,id,username')->find();
		while($share['uid']==3){    //如果再往上的直接上级等级为3则需要在往上一级
            $tree = explode('|',$share['shares_tree']);//直接上级的shares_tree
            $num=count($tree);
            if($num<3){
                return 0;
            }
            $share = M('user')->where(array('id'=>$tree[$num-2]))->field('uid,wechatid,shares_tree,id,username')->find();
        }
		
		$data['type'] = 1;
		$data['fencheng'] = $fc[$n];
		$data['price'] = $fc[$n];
		$data['uid'] = $tree[$num-2];   
		$data['add_time'] = time();
		$data['user_id']  = $mid;
		$ret=M("user_fengchengllist")->add($data);
		$wxsend->SR($share['wechatid'],$data['fencheng'],date("Y-m-d H:i:s"),"代理培训奖金");
		//$wxsend->SR('oOejpwvMFZF5-J1VkOpyU-AbIS1E',$data['fencheng'],date("Y-m-d H:i:s"),"代理培训奖金"); //测试样例
		$this->get_fc($tree[$num-2], $fencheng,$mid,0,$m);
	}


	//导出数据 
	public function excelout(){
        //$data['a.status'] = array('in','2,3,4,5');
        //$data['a.add_time'] = session('xiaoshou_list');
        if(!$_POST['time_start'] || !$_POST['time_end']){
            $this->error('请选择支付时间！');
            exit();
        }
        $map['support_time']= array('between', array(strtotime($_POST['time_start']),strtotime($_POST['time_end'])));
        $map['hq_status'] = array('gt',0);
        $data=$this->_mod->where($map)->select();
        //print_r($data);die;
        $print_data = array();
        foreach ($data as $key => $value) {
         	$print_data[$key]['id'] = $value['id'];
         	$print_data[$key]['username'] = $value['username'];
         	$print_data[$key]['wxname'] = $value['wxname'];
         	$print_data[$key]['phone_mob'] = $value['phone_mob'];
         	$print_data[$key]['address'] = $value['address'];
         	$print_data[$key]['card'] = $value['card'];
         	$print_data[$key]['shares_name'] = $value['shares_name'];
         	if(empty($value['support_time'])){
         		$value['support_time'] = '暂未支付会员费';
         	}else{
         		$value['support_time'] =  date('Y-m-d H:i:s',$value['support_time']);
         	}
         	$print_data[$key]['support_time'] = $value['support_time'];
         	if(empty($value['up_do_time'])){
         		$value['up_do_time'] = '暂未处理';
         	}else{
         		$value['up_do_time'] = date('Y-m-d H:i:s',$value['up_do_time']);
         	}
         	$print_data[$key]['up_do_time'] = $value['up_do_time'];//上级审核时间
         	switch ($value['up_status']) {
         		case '1':
         			$value['up_status'] = '审核通过';
         			break;
         		case '2':
         			$value['up_status'] = '审核不通过';
         			break;
         		default:
         			$value['up_status'] = '未处理';
         			break;
         	}
         	$print_data[$key]['up_status'] = $value['up_status'];//上级审核状态
         	switch ($value['hq_status']) {
         	 	case '1':
         	 		$value['hq_status'] = '审核通过';
         	 		break;
         	 	case '2':
         	 		$value['hq_status'] = '审核不通过';
         	 		break;
         	 	default:
         	 		$value['hq_status'] = '未处理';
         	 		break;
         	 } 
         	$print_data[$key]['hq_status'] = $value['hq_status'];//总部审核状态

         } 
         //print_r($print_data);die;
        $filename="已审核列表-".date('Y-m-d');
        $headArr=array("ID","用户名","微信号","联系方式","联系地址","身份证","推荐人","支付时间","上级审核时间","上级审核状态","总部审核状态");
        //如果第五个标题为时间戳字段,则在参数最后一位设置为5,没有则为0
        $this->getExcel($filename,$headArr,$print_data,6,0);
    }
    /** 
     *   后台数据到出excel
     *   @author  vany
     *   date    2015 04 21 
     *       
     */   
    public function getExcel($fileName,$headArr,$data,$key1,$keys){
            //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
            import("Think.ORG.PHPExcel");
            import("Think.ORG.PHPExcel.Writer.Excel5");
            import("Think.ORG.PHPExcel.IOFactory.php");
            //对数据进行检验
            if(empty($data) || !is_array($data)){
                die("data must be a array");
            }
            //检查文件名
            if(empty($fileName)){
                exit;
            }

            //$date = date("Y_m_d",time());
            $fileName .= ".xls";

            //创建PHPExcel对象，注意，不能少了\
            $objPHPExcel = new PHPExcel();
            $objProps = $objPHPExcel->getProperties();
            
            //设置表头
            $key = ord("A");
            foreach($headArr as $v){
                $colum = chr($key);
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
                $key += 1;
            }
            
            $column = 2;
            $objActSheet = $objPHPExcel->getActiveSheet();
            foreach($data as $key => $rows){ //行写入
                $span = ord("A");
                $i=1;
                foreach($rows as $keyName=>$value){// 列写入
                    $j = chr($span);
                    //判断第E个为时间戳时间
                    if ($keys==$i) {
                        $objActSheet->setCellValue($j.$column,date('Y-m-d',$value));
                    }else if($key1 == $i){
                        $objActSheet->setCellValue($j.$column,'"'.$value.'"');
                    }else{
                        $objActSheet->setCellValue($j.$column,$value);
                    }
                    $span++;
                    $i++;
                }
                $column++;
            }

            $fileName = iconv("utf-8", "gb2312", $fileName);
            //重命名表
            // $objPHPExcel->getActiveSheet()->setTitle('test');
            //设置活动单指数到第一个表,所以Excel打开这是第一个表
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=\"$fileName\"");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output'); //文件通过浏览器下载
            exit;
    }
	
	/**
     * ajax修改单个字段值
     */
    public function ajax_edit()
    {
        

        //AJAX修改数据
        $mod = D('user_apply');
        $pk = $mod->getPk();
        $id = $this->_get($pk, 'intval');
        $field = $this->_get('field', 'trim');
        $val = $this->_get('val', 'trim');
        $val = strtotime($val);//修改支付时间 
        //允许异步修改的字段列表  放模型里面去 TODO
        $mod->where('id='.$id)->setField($field, $val);

        $this->ajaxReturn(1);
    }





}
?>