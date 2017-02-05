<?php
class remindAction extends backendAction
{
    public function _initialize() {
        parent::_initialize();
		parent::CheckLogin();
        $this->_mod = M('remind');
    }
	
    public function index(){
		$count = $this->_mod->count();
		$pager = new Page($count,15);
		$list = $this->_mod->limit($pager->firstRow.','.$pager->listRows)->order('id desc')->select();
		foreach($list as $key => $val){
			$target_time = $val['add_time']+3600*24*$val['remind_time'];
			$item = M('item')->where(array('id'=>$val['item_id']))->field('title')->find();
			$iuser = M('user')->where(array('id'=>$val['user_id']))->field('username')->find();
			$list[$key]['title'] = $item['title'];
			$list[$key]['username'] = $iuser['username'];
			$list[$key]['remind_time'] = $target_time;
			if(time() > $target_time && $val['is_remind']==0){
				$rcount = M('remind')->where(array('id'=>$val['id']))->select();
				$arr[] = count($rcount);
			}
		}
		$this->assign('page',$pager->show());
		$this->assign('list',$list);
		$this->assign('list_table', true);
		$this->assign('rcount',count($arr));
        $this->display();
    }
	
	public function remind_exc(){
		$wxsend = new Wxsend();
		$where['is_remind'] = 0;
		$list = $this->_mod->where($where)->select();
		foreach($list as $key => $val){
			if(time() > $val['add_time']+3600*24*$val['remind_time']){
				$data['is_remind'] = 1;
				$save = M('remind')->where(array('id'=>$val['id']))->save($data);
				if($save){
					$uinfo = M('user')->where(array('id'=>$val['user_id']))->find();
					$iinfo = M('item')->where(array('id'=>$val['item_id']))->find();
					$url = 'http://yooopay.com/index.php?m=Item&a=index&id='.$val['item_id'].'&shares='.$val['shopid'].'';
					$datas = '亲爱的饭团'.$uinfo['username'].'您好，您有新的宝贝购买提醒：\n\n 宝贝名称：「'.$iinfo['title'].'」\n\n购买链接：'.$url.'';
					$res = $wxsend->KF_M($uinfo['wechatid'],$datas);
					$this->success('商品购买提醒已发出！');
				}
			}
		}
	}
	
	public function del_all(){
		// 实例化对象
		$remind = M('remind');
		//接收ID，Array
		$id = $_POST['id'];
		//预处理，防止无参数数删除数据
		$count = count($id);
		if($count<=0){
			$this->error('非法操作，请选择删除的记录');
		}
		//批量删除
		$ids = implode(',', $id);
		if($remind->where(array('id'=>array('in',$ids)))->delete()){
			$this->success('删除成功', U('remind/index'));
		}else{
			$this->error('删除失败');
		}
	}

}