<?php
/*
 * 修改分成率
 * @edit  vany
 * date   2015 05 19	
 */
class fenchengAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = M('user_fengchenglv');
    }

    public function index() {
		if(IS_POST){
			$fengchenglv=M('user_fengchenglv');
			if($_POST['fencheng']){
				$fencheng=$_POST['fencheng'];
				$fengcheng1 = $_POST['fencheng1'];
				$data['royalty']=implode('|',$fencheng);
				$res=$fengchenglv->where(array('id'=>3))->save($data);
				$data['royalty'] = implode('|', $fengcheng1);
				$res=$fengchenglv->where(array('id'=>4))->save($data);
				if($res!== false){
					$this->success('更新成功',U('Fencheng/index'));
				}else{
					$this->error('更新失败!');
				}
			}else{
				$data['status']=$_POST['status'];
				$res=$fengchenglv->where(array('id'=>3))->save($data);
				if($res!== false){
					$this->success('更新成功!',U('Fencheng/index'));
				}else{
					$this->error('更新失败!');
				}
			}	
		}else{
			$user_fengchenglv= M('user_fengchenglv');
			$fengchenglv= $user_fengchenglv->where(array('id'=>3))->find();
			$fengcheng = $user_fengchenglv->where(array('id'=>4))->find();
			if($fengchenglv['royalty']){
				$lv=explode('|',$fengchenglv['royalty']);
				$lv1 = explode('|',$fengcheng['royalty']);
			}
			$list = array('小二','掌柜','团长');
			$list1 = array('育成掌柜','推荐小二','掌柜','团长');
			$count=count($lv);
			$this->assign('list',$list);
			$this->assign('list1',$list1);
			$this->assign('status',$fengchenglv['status']);
			$this->assign('count',$count);
			$this->assign('lv1',$lv1);
			$this->assign('lv',$lv);
			$this->display();
		}
    }
	
   
}