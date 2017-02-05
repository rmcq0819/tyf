<?php
class zhuanpanAction extends backendAction
{
	public function index()
	{	
		$zhuanpan=M('zhuanpan_config');
		if($_GET['keyword']) {
			$data['hd_name']=array('like','%'.$_GET['keyword'].'%');
			$this->assign('keyword',$_GET['keyword']);
			$list=$zhuanpan->where($data)->select();
		}else{
			$list=$zhuanpan->select();
		}
		$this->assign('list',$list);
		$this->display();
	}
	
	public function edit()
	{
		if (IS_POST) {
			$zhuanpan = M('zhuanpan_config');
			$id=$_POST['id'];
			$con_data['hd_name']			= $_POST['hd_name'];
			$con_data['hd_info']			= $_POST['hd_info'];
			$con_data['hd_duijiang_info']	= $_POST['hd_duijiang_info'];
			$con_data['hd_begin_time']		= $_POST['hd_begin_time']?strtotime($_POST['hd_begin_time']):time();
			$con_data['hd_end_time']		= $_POST['hd_end_time']?strtotime($_POST['hd_end_time']):time()+3600*24*7;
			$con_data['hd_chongfu_info']	= $_POST['hd_chongfu_info'];
			$con_data['hd_end_info']		= $_POST['hd_end_info'];
			$con_data['hd_cishu']			= $_POST['hd_cishu']?$_POST['hd_cishu']:1;
			$con_data['hd_renshu']			= $_POST['hd_renshu']?$_POST['hd_renshu']:1;
			$zhuanpan->where("id=".$id)->save($con_data);
			//更新奖项
			$jp = M('zhuanpan_list');
			
			$hd_renshu	= $_POST['hd_renshu']?trim($_POST['hd_renshu']):1;
			$hd_cishu	= $_POST['hd_cishu']?trim($_POST['hd_cishu']):1;
			
			$jpdata_1['uid']=$id;
			$jpdata_1['praisecontent']	= trim($_POST['jp_1_1']);
			$jpdata_1['chance']	= trim($_POST['jp_1_2'])/($hd_renshu*$hd_cishu);
			$jpdata_1['shuliang']	= trim($_POST['jp_1_2'])?trim($_POST['jp_1_2']):1;
			$res=$jp->where(array('uid'=>$id,'praisename'=>'一等奖'))->save($jpdata_1);
			if ($res===0 && !empty($jpdata_1['praisecontent'])) {
				$res1=$jp->where(array('uid'=>$id,'praisename'=>'一等奖'))->find();
				if (!$res1) {
					$jpdata_1['praisename']='一等奖';
					$jp->add($jpdata_1);
				}
				
			}

			$jpdata_2['uid']=$id;
			$jpdata_2['praisecontent']	= trim($_POST['jp_2_1']);
			$jpdata_2['chance']	= trim($_POST['jp_2_2'])/($hd_renshu*$hd_cishu);
			$jpdata_2['shuliang']	= trim($_POST['jp_2_2'])?trim($_POST['jp_2_2']):1;
			$res=$jp->where(array('uid'=>$id,'praisename'=>'二等奖'))->save($jpdata_2);
			if ($res===0 && !empty($jpdata_2['praisecontent'])) {
				$res1=$jp->where(array('uid'=>$id,'praisename'=>'二等奖'))->find();
				if (!$res1) {
					$jpdata_2['praisename']='二等奖';
					$jp->add($jpdata_2);
				}
			}

			$jpdata_3['uid']=$id;
			$jpdata_3['praisecontent']	= trim($_POST['jp_3_1']);
			$jpdata_3['chance']	= trim($_POST['jp_3_2'])/($hd_renshu*$hd_cishu);
			$jpdata_3['shuliang']	= trim($_POST['jp_3_2'])?trim($_POST['jp_3_2']):1;
			$res=$jp->where(array('uid'=>$id,'praisename'=>'三等奖'))->save($jpdata_3);
			if ($res===0 && !empty($jpdata_3['praisecontent'])) {
				$res1=$jp->where(array('uid'=>$id,'praisename'=>'三等奖'))->find();
				if (!$res1) {
					$jpdata_3['praisename']='三等奖';
					$jp->add($jpdata_3);
				}
			}

			$jpdata_4['uid']=$id;
			$jpdata_4['praisecontent']	= trim($_POST['jp_4_1']);
			$jpdata_4['chance']	= trim($_POST['jp_4_2'])/($hd_renshu*$hd_cishu);
			$jpdata_4['shuliang']	= trim($_POST['jp_4_2'])?trim($_POST['jp_4_2']):1;
			$res=$jp->where(array('uid'=>$id,'praisename'=>'四等奖'))->save($jpdata_4);
			if ($res===0 && !empty($jpdata_4['praisecontent'])) {
				$res1=$jp->where(array('uid'=>$id,'praisename'=>'四等奖'))->find();
				if (!$res1) {
					$jpdata_4['praisename']='四等奖';
					$jp->add($jpdata_4);
				}

			}

			$jpdata_5['uid']=$id;
			$jpdata_5['praisecontent']	= trim($_POST['jp_5_1']);
			$jpdata_5['chance']	= trim($_POST['jp_5_2'])/($hd_renshu*$hd_cishu);
			$jpdata_5['shuliang']	= trim($_POST['jp_5_2'])?trim($_POST['jp_5_2']):1;
			$res=$jp->where(array('uid'=>$id,'praisename'=>'五等奖'))->save($jpdata_5);
			if ($res===false && !empty($jpdata_5['praisecontent'])) {
				$res1=$jp->where(array('uid'=>$id,'praisename'=>'五等奖'))->find();
				if (!$res1) {
					$jpdata_5['praisename']='五等奖';
					$jp->add($jpdata_5);
				}

			}

			$jpdata_6['uid']=$id;
			$jpdata_6['praisecontent']	= trim($_POST['jp_6_1']);
			$jpdata_6['chance']	= trim($_POST['jp_6_2'])/($hd_renshu*$hd_cishu);
			$jpdata_6['shuliang']	= trim($_POST['jp_6_2'])?trim($_POST['jp_6_2']):1;
			$res=$jp->where(array('uid'=>$id,'praisename'=>'六等奖'))->save($jpdata_6);
			if ($res===false && !empty($jpdata_6['praisecontent'])) {
				$res1=$jp->where(array('uid'=>$id,'praisename'=>'六等奖'))->find();
				if (!$res1) {
					$jpdata_6['praisename']='六等奖';
					$jp->add($jpdata_6);
				}
			}
			$this->success('更新成功',U('zhuanpan/edit',array('id'=>$id)));
		}else{
			//读取大转盘配置信息
			$zhuanpan = M('zhuanpan_config');
			$id=$_GET['id'];
			$zp_info = $zhuanpan->where("id=".$id)->find();
			if(!empty($zp_info['hd_begin_time']))
			{
				$zp_info['hd_begin_time']	= date("Y-m-d",$zp_info['hd_begin_time']);
			}else{
				$zp_info['hd_begin_time']	= date("Y-m-d",time());
			}
			
			if(!empty($zp_info['hd_end_time']))
			{
				$zp_info['hd_end_time']	= date("Y-m-d",$zp_info['hd_end_time']);
			}else{
				$zp_info['hd_end_time']	= date("Y-m-d",time()+3600*24*7);
			}
			//读取奖品列表
			$jp = M('zhuanpan_list');
			$this->assign('jp1',$jp->where(array('uid'=>$id,'praisename'=>'一等奖'))->find());
			$this->assign('jp2',$jp->where(array('uid'=>$id,'praisename'=>'二等奖'))->find());
			$this->assign('jp3',$jp->where(array('uid'=>$id,'praisename'=>'三等奖'))->find());
			$this->assign('jp4',$jp->where(array('uid'=>$id,'praisename'=>'四等奖'))->find());
			$this->assign('jp5',$jp->where(array('uid'=>$id,'praisename'=>'五等奖'))->find());
			$this->assign('jp6',$jp->where(array('uid'=>$id,'praisename'=>'六等奖'))->find());
			$this->assign('id',$id);
			$this->assign('zp_info',$zp_info);
			$this->display();
			
		}
	}
	public function add(){
		if (IS_POST) {
			$zhuanpan = M('zhuanpan_config');
			$con_data['hd_name']			= $_POST['hd_name'];
			$con_data['hd_info']			= $_POST['hd_info'];
			$con_data['hd_duijiang_info']	= $_POST['hd_duijiang_info'];
			$con_data['hd_begin_time']		= strtotime($_POST['hd_begin_time']);
			$con_data['hd_end_time']		= strtotime($_POST['hd_end_time']);
			$con_data['hd_chongfu_info']	= $_POST['hd_chongfu_info'];
			$con_data['hd_end_info']		= $_POST['hd_end_info'];
			$con_data['hd_cishu']			= $_POST['hd_cishu'];
			$con_data['hd_renshu']			= $_POST['hd_renshu'];
			$id=$zhuanpan->add($con_data);
			//更新奖项
			$jp = M('zhuanpan_list');
			
			$hd_renshu	= $_POST['hd_renshu'];
			$hd_cishu	= $_POST['hd_cishu'];
			$jpdata_1['uid']=$id;
			$jpdata_1['praisename']='一等奖';
			$jpdata_1['praisecontent']	= $_POST['jp_1_1'];
			$jpdata_1['chance']	= $_POST['jp_1_2']/($hd_renshu*$hd_cishu);
			$jpdata_1['shuliang']	=$_POST['jp_1_2'];
			$jp->add($jpdata_1);

			$jpdata_2['uid']=$id;
			$jpdata_2['praisename']='二等奖';
			$jpdata_2['praisecontent']	= trim($_POST['jp_2_1']);
			$jpdata_2['chance']	= trim($_POST['jp_2_2'])/($hd_renshu*$hd_cishu);
			$jpdata_2['shuliang']	= trim($_POST['jp_2_2'])?trim($_POST['jp_2_2']):1;
			$jp->add($jpdata_2);
			
			$jpdata_3['uid']=$id;
			$jpdata_3['praisename']='三等奖';
			$jpdata_3['praisecontent']	= trim($_POST['jp_3_1']);
			$jpdata_3['chance']	= trim($_POST['jp_3_2'])/($hd_renshu*$hd_cishu);
			$jpdata_3['shuliang']	= trim($_POST['jp_3_2'])?trim($_POST['jp_3_2']):1;
			$jp->add($jpdata_3);
			
			$jpdata_4['uid']=$id;
			$jpdata_4['praisename']='四等奖';
			$jpdata_4['praisecontent']	= trim($_POST['jp_4_1']);
			$jpdata_4['chance']	= trim($_POST['jp_4_2'])/($hd_renshu*$hd_cishu);
			$jpdata_4['shuliang']	= trim($_POST['jp_4_2'])?trim($_POST['jp_4_2']):1;
			$jp->add($jpdata_4);
			
			$jpdata_5['uid']=$id;
			$jpdata_5['praisename']='五等奖';
			$jpdata_5['praisecontent']	= trim($_POST['jp_5_1']);
			$jpdata_5['chance']	= trim($_POST['jp_5_2'])/($hd_renshu*$hd_cishu);
			$jpdata_5['shuliang']	= trim($_POST['jp_5_2'])?trim($_POST['jp_5_2']):1;
			$jp->add($jpdata_5);
			
			$jpdata_6['uid']=$id;
			$jpdata_6['praisename']='六等奖';
			$jpdata_6['praisecontent']	= trim($_POST['jp_6_1']);
			$jpdata_6['chance']	= trim($_POST['jp_6_2'])/($hd_renshu*$hd_cishu);
			$jpdata_6['shuliang']	= trim($_POST['jp_6_2'])?trim($_POST['jp_6_2']):1;
			$jp->add($jpdata_6);
			
			$this->success('添加成功',U('zhuanpan/index'));
		}
		if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
	}
	public function log()
	{
		$zp = M('zhuanpan_list');
		$useracc = M('zhuanpan_log');
    	if( $keyword = $this->_request('keyword', 'trim') ){
            $map['_string'] = "username like '%".$keyword."%' ";
        }
        $map['listid']	= array('lt',7);
    	$count      = $useracc->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件
    	$Page       = new Page($count);// 实例化分页类 传入总记录数
    	$show       = $Page->show();// 分页显示输出
    	// 进行分页数据查询
    	$list = $useracc->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	foreach ($list  as $key=>$val)
    	{
    		$listid = $val['listid'];
    		$listinfo = $zp->where("id=$listid")->find();
    		$list[$key]['jp_leibei']	= $listinfo['praisename'];
    		$list[$key]['jp_name']		= $listinfo['praisecontent'];
    	}
    	$this->assign('list',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出
    	$this->display();
	}
	public function dojp()
	{
		$id = $_GET['id'];
		$zplog = M('zhuanpan_log');
		$data['status'] =1;
		$data['do_time']	= time();
		$zplog->where("id=$id")->save($data);
		$this->success('奖励发放成功');
	}
}
?>