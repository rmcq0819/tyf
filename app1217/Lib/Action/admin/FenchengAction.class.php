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
			/*if($_POST['fencheng']){
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
			}*/
			if($_POST['status'] == ''){
			    //掌柜
                $zrr = $_POST['zhanggui'];
                $zids = array('2','2','2');
                for($i=0;$i<count($_POST['zhanggui']);$i++){
                    $data['royalty'] = implode('|',$zrr);
                    array_pop($zrr);
                    $id = implode('',$zids);
                    $zes = $fengchenglv->where(array('id'=>$id))->save($data);
                    array_pop($zids);
                }
                //店长
                $drr = $_POST['dianzhang'];
                $dids = array('3','2','2','2');
                for($i=0;$i<count($_POST['dianzhang']);$i++){
                    $data['royalty'] = implode('|',$drr);
                    array_pop($drr);
                    $id = implode('',$dids);
                    $zes = $fengchenglv->where(array('id'=>$id))->save($data);
                    array_pop($dids);
                }
                //经纪人1   掌柜
                $jrr1 = $_POST['jingjiren1'];
                $jids1 = array('5','2','2','2');
                for($i=0;$i<count($_POST['jingjiren1']);$i++){
                    $data['royalty'] = implode('|',$jrr1);
                    array_pop($jrr1);
                    $id = implode('',$jids1);
                    $zes = $fengchenglv->where(array('id'=>$id))->save($data);
                    array_pop($jids1);
                }
                //经纪人2    店长
                $jrr2 = $_POST['jingjiren2'];
                $jids2 = array('5','3','2','2','2');
                for($i=0;$i<count($_POST['jingjiren2']);$i++){
                    $data['royalty'] = implode('|',$jrr2);
                    array_pop($jrr2);
                    $id = implode('',$jids2);
                    $zes = $fengchenglv->where(array('id'=>$id))->save($data);
                    array_pop($jids2);
                }
                //dump($zes);die;
                if($zes!==false){
                    $this->success('更新成功',U('Fencheng/index'));
                }else{
                    $this->error('更新失败');
                }
            }else{
                $data['status'] = $_POST['status'];
                $res = $fengchenglv->where(array('id' => 3))->save($data);
                if ($res !== false) {
                    $this->success('更新成功!', U('Fencheng/index'));
                } else {
                    $this->error('更新失败!');
                }
            }

		}else{
			$user_fengchenglv= M('user_fengchenglv');

			$fengchenglv1= $user_fengchenglv->where(array('id'=>222))->find();
			$fengchenglv2= $user_fengchenglv->where(array('id'=>3222))->find();
			$fengchenglv3= $user_fengchenglv->where(array('id'=>5222))->find();
			$fengchenglv4= $user_fengchenglv->where(array('id'=>53222))->find();
			$fengcheng = $user_fengchenglv->where(array('id'=>4))->find();

            $zhanggui=explode('|',$fengchenglv1['royalty']);
            $dianzhang=explode('|',$fengchenglv2['royalty']);
            $jingjiren1=explode('|',$fengchenglv3['royalty']);
            $jingjiren2=explode('|',$fengchenglv4['royalty']);
            $lv1 = explode('|',$fengcheng['royalty']);


			$list = array('经纪人','店长','掌柜','掌柜','掌柜');
			$list1 = array('育成掌柜','推荐小二','掌柜','团长');


			$this->assign('list',$list);
			$this->assign('list1',$list1);
			$this->assign('status',$fengcheng['status']);
			$this->assign('lv1',$lv1);

			$this->assign('zhanggui',$zhanggui);
			$this->assign('dianzhang',$dianzhang);
			$this->assign('jingjiren1',$jingjiren1);
			$this->assign('jingjiren2',$jingjiren2);
			$this->display();
		}
    }
	
   
}