<?php
/**
 * 用户升级管理
 * @author vany
 * date 2015-12-14
 */
class User_lvupAction extends backendAction
{

	public function _initialize() {
		parent::_initialize();
		$this->_mod = D('user_lvup');
	}
	public function _before_index() {
		$map = array();
        if( $keyword = $this->_request('keyword', 'trim') ){
            $map['_string'] = "username like '%".$keyword."%'";
        }
        $this->assign('search', array(
            'keyword' => $keyword,
        ));
        return $map;
	}
	//代理降级信息
	public function down(){
		$map = array();
        if( $keyword = $this->_request('keyword', 'trim') ){
            $map['_string'] = "username like '%".$keyword."%'";
        }
        $this->assign('search', array(
            'keyword' => $keyword,
        ));
		$sub_menu = array("0"=>array(
            'name' => "更新业绩",
            'module_name' => "User_lvup",
			'action_name' => "Performance",
			'class' => "on"
			)
        );
        $this->assign('sub_menu', $sub_menu);
		$mod = M('user_lvdown');
		$this->_list($mod,$map);
		$this->display();
	}
	public function lvdown_do(){
		$id  = $this->_post('id','intval');
		$act =$this->_post('act','intval');
		//act=1为降级操作,否则不降级
		if($act == 1){
			$list = M('user_lvdown')
					->join("a left join __USER__ as b on a.userid = b.id")
					->where("a.id = ".$id)
					->field("a.*,b.uid")
					->find();
			$res = M('user')->where(array('id'=>$list['userid']))->save(array('uid'=>$list['uid']+1));
			if($res !== false){
				M('user_lvdown')->where(array('id'=>$id))->save(array('status'=>1,'do_time'=>time()));
				$this->ajaxReturn('1',"降级成功!");
			}else{
				$this->ajaxReturn('2',"降级失败!");
			}
		}else{
			$res = M('user_lvdown')->where(array('id'=>$id))->save(array('status'=>2,'do_time'=>time()));
			if($res !== false){
				$this->ajaxReturn('1',"不降级操作成功!");
			}else{
				$this->ajaxReturn('2',"不降级操作失败!");
			}
		}
	}
	
	
	//2016-07-09 Modify by Liuyumei
	public function lvup_do(){
		$id   = $this->_post('id','intval') ? $this->_post('id','intval') : 0;
		$user = $this->_mod 
				->join("a left join __USER__ b on a.userid = b.id")
				->where("a.id = ".$id)
				->field("a.*,b.uid,b.shares,b.recom,b.wechatid,b.username,b.shares_tree")
				->find();
				
		//修改受理状态和受理时间
		$data1['hq_status'] = 1;
		$data1['hq_time']= time();
		$flag = M('user_lvup')->where(array('id'=>$id))->save($data1);
		if($flag !== false){
			/* //判断用户等级
			if ($user['uid'] == 3) {
				$up = M('user')->field('shares')->find($user['shares']);
				$data['shares'] = $up['shares'];
			}else if ($user['uid'] == 2) {
				$data['shares'] = 0;
			} */
			
			$shares_tree=$user['shares_tree'];
		    $tree = explode('|',$shares_tree);
			while($tree[count($tree)-2]!=$user['up_user']){
				$tree_out=array('-',$tree[count($tree)-2],'-');
				$tree=array_diff($tree,$tree_out);
				$shares_tree='-|'.implode('|',$tree).'|-';
				$tree = explode('|',$shares_tree);//改变升级者的shares_tree	
			} 
			//修改会员信息
			$data['shares_tree']=$shares_tree;
			$data['shares']=$user['userid'];
			if( $user['uid']>2){
				$data['uid']= $user['uid'] - 1;
			}
			$res = M('user')->where(array('id'=>$user['userid']))->save($data);
			$user_mod = D('user');
			$fenxiao = $user_mod->getfenxiao($user['userid'],$user['up_user']);
			foreach($fenxiao as $kk=>$vv){
				M('user')->where(array('id'=>$vv['id']))->save(array('shares'=>$user['userid']));
				$arr[] = $vv['id'];
			}
			$arr[] = $user['userid'];
			M('user_apply') ->where(array('userid'=>array('in',$arr)))->save(array('shares'=>$user['userid'],'shares_name'=>$user['username']));
			$result=$this->_mod
					->join("a left join __USER__ b on a.userid = b.id")
					->field("a.*,b.wechatid")
					->where(array('a.id'=>$id))
					->find();
			//实例化模版信息类		
			$wxsend = new Wxsend();
		
			//$wxsend->SJ('oOejpwiK88gEkMvMHJUxe5JhN6lE',$result['username'],$result['phone_mob'],$result['hq_status'],date("Y-m-d H:i:s",$result['hq_time']));//将申请结果通知到用户
			$wxsend->SJ($user['wechatid'],$result['username'],$result['phone_mob'],$result['hq_status'],date("Y-m-d H:i:s",$result['hq_time']));//将申请结果通知到用户
			if($res !== false){  
				//卖咖升级后修改直推卖咖的推荐大咖参数
				//$this->do_after($user['userid'],$user['uid'],$user['userid'],$user['shares']);
				echo 1;exit;
			}else{
				echo -1;exit;
			}
		}else{
			echo 0;exit; 
		}
	}
	
	public function do_after($id,$uid,$userid,$shares){
		$data1['recom']   = $id;
		$data1['uid']     = $uid;
		$data1['shares'] = $shares;
		$res = M('user')->where($data1)->field('id')->select();

		foreach($res as $key => $value){
			M('user')->where($data1)->save(array('shares'=>$userid));
			$this->do_after($value['id'],$uid,$userid,$shares);
		}
	}
    public function Performance(){
        //获取用户组升降级条件 
        $where['id']     = array('in','1,2');
        $where['status'] = 1;
        $group = M("user_category")->where($where)->field('id,keep,keep1')->select();
        // 获取最后更新日期
        $res = M('set')->field('user_up')->find();
        if ($res['user_up'] < strtotime(date('y-m-1'))){
            //获取卖咖以上级别的会员
			$where1['uid']     = array('in','1,2');
			$where1['status'] = 1;
            $user_list = M('user')->where($where1)->field('id,uid,username,phone_mob')->select();
            // 查询当月该会员的业绩
            $month = array(strtotime(date('y-m-1',strtotime("-1 month"))),strtotime(date('y-m-1')));
            $data1['hq_status'] = 1;
            $data1['hq_do_time'] = array('between',$month);
            foreach ($user_list as $key => $value) {
                $data1['shares_tree'] = array('like',array("%|".$value['id']."|%"));
                $list = M('user_apply')->where($data1)->count();
				$data1['recom'] = 0;
				$data1['shares']= $value['id'];
				$list1 = M('user_apply')->where($data1)->count();
                if($list < $group[$value['uid']-1]['keep'] || $lsit1 < $group[$value['uid']-1]['keep1']){
                   $data['userid']  = $value['id'];
				   $data['username']= $value['username'];
				   $data['phone_mob']= $value['phone_mob'];
				   $data['add_time']= time();
				   $data['keep']	= $group[$value['uid']-1]['keep'];
				   $data['keep1']	= $group[$value['uid']-1]['keep1'];
				   $data['num']		= $list;
				   $data['num1']	= $list1;
				   M("user_lvdown")->add($data);
                }
            }
            $data1['user_up']  =  strtotime(date('y-m-1'));
            M('set')->where(array('id'=>1))->save($data1); 
			$this->success("本月代理业绩更新成功!");
        }else{
            $this->error('这个月已更新代理业绩!');
        }
    }
}
?>