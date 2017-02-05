<?php
/**
 * 用户信息管理
 */
class userAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('user');
		if(empty($_SESSION['admin'])){
			$this->error('非法操作');
		}
    }

    protected function _search() {
       $map = array();
        if( $keyword = $this->_request('keyword', 'trim') ){
             $map['_string'] = "username like '%".$keyword."%' OR nickname like '%".$keyword."%' OR merchant like '%".$keyword."%'";
        }
		if($id = $this->_get('id','intval')){
			$map['id'] = $id;
			$keyword   = $id;
		}
		if( $level = $this->_request('level','trim') ){
			$map['uid'] = $level;
		}
		if( $level = $this->_request('level','trim') and $keyword = $this->_request('keyword', 'trim') ){
			$map['uid'] = $level;
			$map['_string'] = "username like '%".$keyword."%' OR nickname like '%".$keyword."%' OR merchant like '%".$keyword."%'";
		}
		if( $phone_mob = $this->_request('phone_mob','trim') ){
			$map['phone_mob'] = $phone_mob;
		}
		if( $phone_mob = $this->_request('phone_mob','trim') and $keyword = $this->_request('keyword', 'trim') ){
			$map['phone_mob'] = $phone_mob;
			$map['_string'] = "username like '%".$keyword."%' OR nickname like '%".$keyword."%' OR merchant like '%".$keyword."%'";
		}
        $this->assign('search', array(
            'keyword' => $keyword,
            'phone_mob' => $phone_mob,
            'level' => $level,
        ));
        return $map;
    }
	
	
	//手动操作让会员升级至掌柜等级
	public function zg_update(){
		$id = $this->_get('id','intval');
		$user_form= M('user')->where(array('id'=>$id))->find();
		$Form = D('user_lvup');
		$user_data['useruid'] = $user_form['uid']; //会员组
		$user_data['userid'] = $user_form['id']; //会员id
		$user_data['username'] = $user_form['username']; //会员名称
		$user_data['upgrade'] = 20; //升级条件(总数)
		$user_data['upgrade1'] = 20; //升级条件(直推)
		$user_data['num']= 20 ; //上月团队新增(总数)
		$user_data['num1']= 20 ; //上月团队新增人数(直推)
		$tree = explode('|',$user_form['shares_tree']);//直接上级的shares_tree
		$num=count($tree);
		
		$suser = M('user')->where(array('id'=>$tree[$num-2]))->field('id,uid,shares_tree')->find();
		while($suser['uid']==3){    //如果再往上的直接上级等级为3则需要在往上一级
			$tree = explode('|',$suser['shares_tree']);//直接上级的shares_tree
			$num=count($tree);
			if($num<3){
				return 0;
			}
			$suser = M('user')->where(array('id'=>$tree[$num-2]))->field('id,uid,shares_tree')->find();
		}

		$user_data['up_user'] = $suser['id']; //上级id
		$user_data['add_time'] = time(); //添加时间
		$user_data['hq_status'] = 0; //总部处理状态
		$user_data['up_time'] = time();
		$user_data['up_status'] = 1; //上级处理状态
		$user_data['is_update'] = 1; //是否手动升级

		if($Form->add($user_data)){
		  $this->success(L('operation_success'));
		}
	}


    public function _before_index() {
        $big_menu = array(
            'title' => L('add_user'),
            'iframe' => U('user/add'),
            'id' => 'add',
            'width' => '500',
            'height' => '330'
        );
        $this->assign('big_menu', $big_menu);
    }

    public function _before_insert($data) {
        if( ($data['password']!='')&&(trim($data['password'])!='') ){
            $data['password'] = $data['password'];
        }else{
            unset($data['password']);
        }
        $birthday = $this->_post('birthday', 'trim');
        if ($birthday) {
            $birthday = explode('-', $birthday);
            $data['byear'] = $birthday[0];
            $data['bmonth'] = $birthday[1];
            $data['bday'] = $birthday[2];
        }
        return $data;
    }

    public function _after_insert($id) {
        $img = $this->_post('img','trim');
        $this->user_thumb($id,$img);
    }
    public function _before_delete($id) {
        $_SESSION['content']="删除用户";
    }
    public function _before_update($data) {
        if( ($data['password']!='')&&(trim($data['password'])!='') ){
            $data['password'] = md5($data['password']);
        }else{
            unset($data['password']);
        }
        $birthday = $this->_post('birthday', 'trim');
        if ($birthday) {
            $birthday = explode('-', $birthday);
            $data['byear'] = $birthday[0];
            $data['bmonth'] = $birthday[1];
            $data['bday'] = $birthday[2];
        }
        return $data;
    }

    public function _after_update($id){
        $img = $this->_post('img','trim');
        if($img){
            $this->user_thumb($id,$img);
        }
    }

    public function user_thumb($id,$img){
        $img_path= avatar_dir($id);
        //会员头像规格
        $avatar_size = explode(',', C('pin_avatar_size'));
        $paths =C('pin_attach_path');

        foreach ($avatar_size as $size) {
            if($paths.'avatar/'.$img_path.'/' . md5($id).'_'.$size.'.jpg'){
                @unlink($paths.'avatar/'.$img_path.'/' . md5($id).'_'.$size.'.jpg');
            }
            !is_dir($paths.'avatar/'.$img_path) && mkdir($paths.'avatar/'.$img_path, 0777, true);
            Image::thumb($paths.'avatar/temp/'.$img, $paths.'avatar/'.$img_path.'/' . md5($id).'_'.$size.'.jpg', '', $size, $size, true);
        }

        @unlink($paths.'avatar/temp/'.$img);
    }

    /**
     * 添加
     */
    public function add() {
        $mod = D($this->_name);
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
            }
            if( $mod->add($data) ){
                if( method_exists($this, '_after_insert')){
                    $id = $mod->getLastInsID();
                    $this->_after_insert($id);
                }
                $this->add_log('添加新用户');
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $this->assign('open_validator', true);
             $cate=M('user_category')->field('id,name')->where(array('status' =>1))->select();
                 $this->assign('cate', $cate);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
               
                $this->display();
            }
        }
    }


    /**
     * 修改
     */
    public function edit()
    {
		$wxsend = new Wxsend();
        $mod = D($this->_name);
        $pk = $mod->getPk();
		
        if (IS_POST) {
		      
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
            }
            if (false !== $mod->save($data)) {
                if( method_exists($this, '_after_update')){
                    $id = $data['id'];
                    $this->_after_update($id);
                }
                $this->add_log('修改用户资料');
				//手动为用户添加提成记录
				$add_cny = $this->_post('add_cny','trim'); //提成金额
				$add_cont = $this->_post('add_cont','trim'); //添加提成理由
				$user_source = $this->_post('user_source','trim'); //下单所属
				$add_points = $this->_post('add_points','trim');
				$point_type = $this->_post('point_type','trim'); 
				$info = M('user')->where(array('id'=>$id))->find();// 用户详情
				if(!empty($add_cny) && !empty($add_cont)){
					//向用户发送微信提醒消息
					$wxsend->SendUser($info['wechatid'],$add_cny,date("Y-m-d H:i:s"),$add_cont);
					$cny_add = M('user_fengchengllist');
					$cny_add->fencheng = $add_cny;
					$cny_add->orderId = $add_cont;
					$cny_add->price = $add_cny;
					$cny_add->uid = $info['id'];
					$cny_add->class = 1;
					$cny_add->user_id = $user_source;
					$cny_add->add_time = time();
					$cny_add->state = 1;
					$cny_add->type = 0;
					$cny_add->do_time = time();
					$cny_add->is_hand = 1;
					$cny_add->add();
					IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'edit');
					$this->success(L('operation_success'));
					exit;
				}
				if(!empty($add_points) && $point_type!=25){
					$message = M('messagelist');
					$message->user_id =$info['id']; //用户id
					$message->recom = $info['id']; //商家id
					$message->type = $point_type;
					$message->order_id = 0; //订单id
					$message->time = time();
					$message->status = 0; // 默认未读状态
					$message->points = $add_points;
					$message->add();
					M('user')->where(array('id'=>$info['id']))->setInc('points',$add_points);
				}else{
					$message = M('messagelist');
					$message->user_id =$info['id']; //用户id
					$message->recom = $info['id']; //商家id
					$message->type = $point_type;
					$message->order_id = 0; //订单id
					$message->time = time();
					$message->status = 0; // 默认未读状态
					$message->points = $add_points;
					$message->add();
					M('user')->where(array('id'=>$info['id']))->setDec('points',$add_points);
				}
				IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'edit');
				$this->success(L('operation_success'));
            }else{
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $id = $this->_get($pk, 'intval');
            $info = $mod->find($id);
            $cate=M('user_category')->field('id,name')->where(array('status' =>1))->select();
            $info['cate']=$cate;
			$bankinfo=M('bank')->where(array('id'=>$info['kaihuhang']))->find();
			$this->assign('bankinfo',$bankinfo);
            $this->assign('info', $info);
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }


    public function add_users(){
        if (IS_POST) {
            $users = $this->_post('username', 'trim');
            $users = explode(',', $users);
            $password = $this->_post('password', 'trim');
            $gender = $this->_post('gender', 'intavl');
            $reg_time= time();
            $data=array();
            foreach($users as $val){
                $data['password']=$password;
                $data['gender']=$gender;
                $data['reg_time']=$reg_time;
                if($gender==3){
                    $data['gender']=rand(0,1);
                }
                $data['username']=$val;
                $this->_mod->create($data);
                $this->_mod->add();
            }
            
            $this->success(L('operation_success'));
        } else {
            $this->display();
        }
    }

    public function ajax_upload_imgs() {
        //上传图片
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'avatar/temp/' );
            if ($result['error']) {
                $this->error($result['info']);
            }else {
                $data['img'] =  $result['info'][0]['savename'];
                $this->ajaxReturn(1, L('operation_success'), $data['img']);
            }


        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
	//sail
    /*
     *会员组管理会员
     */
     public function cateindex() {
        $uid=$this->_get('uid', 'trim');
        $map=array('uid' =>$uid);
        $mod =$this->_mod;
        !empty($mod) && $this->_list($mod, $map);
        $this->display();
    }

	 /*
     *收藏明细
     */
     public function shoucang() {
        $item_likeMd = M('item_like');
		$uid=$this->_get('id', 'trim');
		$where['uid'] = $uid;
		$item_likeArr = $item_likeMd->where($where)->order('add_time DESC')->select();
		$itemshoucang = M('item');
		$itemArr = array();
		foreach($item_likeArr as $n=> $val){
				$item = $itemshoucang->where('id='.$val['item_id'].'')->select();
				$item = $item[0];
				array_push($itemArr,$item);
			}
		//相同名字的,肯定不可能设置多次给模版的,会互相覆盖的
		
		$this->assign('itemArr',$itemArr);
		$this->display();
    }
	
	/*
     *积分明细
     */
     public function jifen() {
        	
		$item_jifen = M('item_jifen');
		$uid=$this->_get('id', 'trim');
		$where['uid'] = $uid;
		$item_jifenArr = $item_jifen->where($where)->order('id DESC')->select();
		
		$wherenum['uid'] = $uid;
		$wherenum['state'] = 1;
		$item_jifennum = $item_jifen->where($wherenum)->sum('jifen');
		
		$wherenum1['uid'] = $uid;
		$wherenum1['state'] = 0;
		$item_jifennum1 = $item_jifen->where($wherenum1)->sum('jifen');
		
		$this->assign('item_jifennum',$item_jifennum);
		$this->assign('item_jifennum1',$item_jifennum1);
		$this->assign('item_jifenArr',$item_jifenArr);
		$this->display();
    }
	
	
	/**
     * 优惠券明细
     */
    public function youhuiquan() {
	
		$item_jifen = M('item_jifen');
		$uid = $this->_get('id', 'trim');
		//未使用的优惠券
		$item_jifenArr = $item_jifen->query("select *, count(*) as ttl from __TABLE__ where state=0 and jifen!=0 and orderId is null and uid=".$uid." group by title order by title desc");
		
		$item_jifenArr2 = $item_jifen->query("select *, count(*) as ttl from __TABLE__ where state=0 and jifen=0 and orderId is null and uid=".$uid." group by title order by title desc");
		
		$wherenum['uid'] = $uid;
		$wherenum['state'] = 1;
		$item_jifennum = $item_jifen->where($wherenum)->sum('jifen');
		
		$wherenum1['uid'] = $uid;
		$wherenum1['state'] = 0;
		$item_jifennum1 = $item_jifen->where($wherenum1)->sum('jifen');
		
		//已经使用的优惠券
		$item_jifenArr3 = $item_jifen->where("uid='".$uid."' and state='0' and jifen!='0' and orderId is not null")->order('add_time DESC')->select();
		
		$this->assign('item_jifennum',$item_jifennum);
		$this->assign('item_jifennum1',$item_jifennum1);
		$this->assign('item_jifenArr',$item_jifenArr);
		$this->assign('item_jifenArr2',$item_jifenArr2);
		$this->assign('item_jifenArr3',$item_jifenArr3);
		$this->display();
		
    }
	
	//分成明细上传图片
	public function fencheng_img() {
		$filesError = array(
		"文件上传成功"
		,"上传的文件超过了 php.ini中upload_max_filesize(默认情况为2M) 选项限制的值"
		,"上传文件的大小超过了 HTML表单中MAX_FILE_SIZE选项指定的值"
		,"文件只有部分被上传"
		,"没有文件被上传"
		,"传文件大小为0");
		if($_FILES["img"]["error"] > 0) {
			$this->error($filesError[$_FILES["img"]["error"]]);
			return;
		}
		$id = "";
		if(isset($_POST["id"])) $id = $_POST["id"];
		if(empty($id)) $this->error("id号不能为空!");
		/*
		$_FILES["file"]["name"] - 被上传文件的名称
		$_FILES["file"]["type"] - 被上传文件的类型
		$_FILES["file"]["size"] - 被上传文件的大小，以字节计
		$_FILES["file"]["tmp_name"] - 存储在服务器的文件的临时副本的名称
		$_FILES["file"]["error"] - 由文件上传导致的错误代码
		*/
		$fileName = $_FILES["img"]["name"];
		$fileNameExt = "";
		$fileNameArr = explode(".",$fileName);
		$fileNameNum = count($fileNameArr);
		if($fileNameNum > 1) $fileNameExt = $fileNameArr[$fileNameNum-1];
		$imgArr = array("jpg","png","gif");
		if(!in_array($fileNameExt,$imgArr)) {
			$this->error("上传文件格式错误! ".$fileNameExt);
			return;
		}
		$uuid = md5(uniqid(mt_rand(), true));
		$pingzheng = "data/upload/item/".$uuid.".jpg";
		move_uploaded_file($_FILES["img"]["tmp_name"],$pingzheng);
		M("user_fengchengllist")->where(array("id"=>$id))->save(array("pingzheng"=>$uuid.".jpg","state"=>"0"));
		//echo M("user_fengchengllist")->getLastSql(); exit;
		$this->success(L("上传成功!"));
	}
	
	//范票明细
	
	public function pointlist() {
		$ipoint = M('messagelist');
		$uid=$this->_get('id', 'trim'); //会员id
		$userinfo = M('user')->where(array('id'=>$uid))->find();
		$type = $this->_get('type','trim');
		if($type != 0){
			$where['recom'] = $uid;
			$where['type'] = $type;
		}else{
			$where['recom'] = $uid;
			$where['type'] = array('not in','1,2,3,4');	
		}
			
		$list = $ipoint->where($where)->order('id desc')->select();
		
		//红包领取积分 
		$redpoint  = $ipoint->where(array('recom'=>$uid,'type'=>8))->sum('points');
		$sendcount  = $ipoint->where(array('recom'=>$uid,'type'=>10))->sum('points');
		$zhuanpan_count  = $ipoint->where(array('recom'=>$uid,'type'=>20))->sum('points');
		$zhuanpan_dec  = $ipoint->where(array('recom'=>$uid,'type'=>21))->sum('points');
		
		$count =count($list);
		$pager = new Page($count,20);
		$lists=array_slice($list, $pager->firstRow,$pager->listRows);
		$page = $pager->show();
		$this->assign("page", $page);
		$this->assign('point_yuer',$userinfo['points']);
		$this->assign('yuer_price',$userinfo['points']/100);
		$this->assign('userinfo',$userinfo);
		$this->assign('lists',$lists);
		$this->assign('redpoint',$redpoint);
		$this->assign('sendcount',$sendcount);
		$this->assign('zhuanpan_count',$zhuanpan_count);
		$this->assign('zhuanpan_dec',$zhuanpan_dec);
		$this->assign('type',$type);
		$this->display();
    }
	
	public function pointfreeze(){
		$id = $this->_post('id','trim');
		if(isset($_POST['is_freeze'])){
			$data['is_freeze']=1;
		}else {
			$data['is_freeze']=0;
		}
		$usersave = M('user')->where(array('id'=>$id))->save($data);
		if($usersave && $_POST['is_freeze'] == 1){
			$this->success('该用户已成功被冻结！');
		}elseif($usersave && $_POST['is_freeze'] == 0){
			$this->success('该用户已被取消冻结！');
		}else{
			$this->error('操作有误！');
		}
		
	}
	
	
		/*
     *分成明细
     */
     public function fencheng() {
        	
		$user_fengchengllist = M('user_fengchengllist');
		$uid=$this->_get('id', 'trim');
			
		$where['uid'] = $uid;
		$item_jifenArr = $user_fengchengllist->where($where)->order('id DESC')->select();
		$users = M('user');
		$usersArr = array();
		foreach($item_jifenArr as $n=> $val){
				$user = $users->field('username')->where(array("id"=>$val['user_id']))->select();
				$user = $user[0];
				$bank = M('bank')->where(array('id'=>$val['kaihuhang']))->find();
				$item_jifenArr[$n]['kaihuhang'] = $bank['bank'];
				//print_r($item_jifenArr);exit;
				array_push($usersArr,$user);
			}
		//print_r($usersArr);exit;
		$item_jifennum = 0;
		$item_jifennum1 = 0;
		$wherenum['uid'] = $uid;
		$wherenum['state'] = 1;
		$fclArr = $user_fengchengllist->where($wherenum)->select();
		$nowTime = time();
		for($i=0; $i<count($fclArr); $i++) {
			$fcl = $fclArr[$i];
			$add_time = $fcl["add_time"];
			if($nowTime - $add_time > 30*24*3600) {
				$item_jifennum += $fcl["fencheng"];
			} else {
				$item_jifennum1 += $fcl["fencheng"];
			}
		}
		
		//正在申请提现的金额
		$wherenum3['uid'] = $uid;
		$wherenum3['state'] = 2;
		$item_jifennum3 = $user_fengchengllist->where($wherenum3)->sum('fencheng');
		
		//已经提现的金额
		$wherenum2['uid'] = $uid;
		$wherenum2['state'] = 0;
		$item_jifennum2 = $user_fengchengllist->where($wherenum2)->sum('fencheng');
		
		//退款应该减掉的提现的金额
		$wherenum4['uid'] = $uid;
		$wherenum4['state'] = 3;
		$item_jifennum4 = $user_fengchengllist->where($wherenum4)->sum('fencheng');
		
		$this->assign('item_jifennum',$item_jifennum);
		$this->assign('item_jifennum1',$item_jifennum1);
		$this->assign('item_jifennum2',$item_jifennum2);
		$this->assign('item_jifennum3',$item_jifennum3);
		$this->assign('item_jifennum4',$item_jifennum4);
		$this->assign('item_jifenArr',$item_jifenArr);
		$this->assign('usersArr',$usersArr);
		$this->display();
    }
	
    /**
     * 列表处理
     *
     * @param obj $model  实例化后的模型
     * @param array $map  条件数据
     * @param string $sort_by  排序字段
     * @param string $order_by  排序方法
     * @param string $field_list 显示字段
     * @param intval $pagesize 每页数据行数
     */
    protected function _list($model, $map = array(), $sort_by='', $order_by='', $field_list='*', $pagesize=20)
    {

        //排序
        $mod_pk = $model->getPk();
      
        if ($this->_request("sort", 'trim')) {
            $sort = $this->_request("sort", 'trim');
        } else if (!empty($sort_by)) {
            $sort = $sort_by;
        } else if ($this->sort) {
            $sort = $this->sort;
        } else {
            $sort = $mod_pk;
        }
        if ($this->_request("order", 'trim')) {
            $order = $this->_request("order", 'trim');
        } else if (!empty($order_by)) {
            $order = $order_by;
        } else if ($this->order) {
            $order = $this->order;
        } else {
            $order = 'DESC';
        }

        //如果需要分页
        if ($pagesize) {
            $count = $model->where($map)->count($mod_pk);
            $pager = new Page($count, $pagesize);
        }
        $select = $model->field($field_list)->where($map)->order($sort . ' ' . $order);
       // echo M()->getLastSql();
        $this->list_relation && $select->relation(true);
        if ($pagesize) {
            $select->limit($pager->firstRow.','.$pager->listRows);
            $page = $pager->show();
            $this->assign("page", $page);
        }
        $list = $select->select();
        foreach ($list as $key => $value) {
            $catename=M('user_category')->field('name')->where(array('id' =>$value['uid']))->find();
            $value['cname']=$catename['name'];
            $list[$key]=$value;//重复值list
        }
		if(in_array(ACTION_NAME, array('lists','log'))){
			foreach ($list as $key => $value) {
				$bank=M('bank')->field('bank')->where(array('id' =>$value['kaihuhang']))->find();
				$user=M('user')->field('username,phone_mob')->where(array('id' =>$value['uid']))->find();
				$value['bank']=$bank['bank'];
				$value['username'] = $user['username'];
				$value['phone_mob'] = $user['phone_mob'];
				$list[$key]=$value;//重复值list
			}
		}
        //dump($list);
        $this->assign('list', $list);
        $this->assign('list_table', true);
    }
    /**
     * ajax检测会员是否存在
     */
    public function ajax_check_name() {
        $name = $this->_get('username', 'trim');
        $id = $this->_get('id', 'intval');
        if ($this->_mod->name_exists($name,  $id)) {
            $this->ajaxReturn(0, '该会员已经存在');
        } else {
            $this->ajaxReturn();
        }
    }

    /**
     * ajax检测邮箱是否存在
     */
    public function ajax_check_email() {
        $name = $this->_get('email', 'trim');
        $id = $this->_get('id', 'intval');
        if ($this->_mod->email_exists($name,  $id)) {
            $this->ajaxReturn(0, '该邮箱已经存在');
        } else {
            $this->ajaxReturn();
        }
    }
	//代理商提现管理
	public function lists(){
		$mod = M('user_fengchengllist');
        $keyword = $this->_get("keyword","trim");
        if($keyword) {
			$where['username'] = array("like","%".$keyword."%");
			$user = M('user')->where($where)->field('id')->select();
			if(is_array($user)){
				foreach($user as $key => $val){
					$uid[$key] = $val['id'];
				}
			}
			$userid = implode(',',$uid);
			$data['uid']    = array('in',$userid);
			$data['_logic'] = 'or';
			$data["huming"]  = array("like","%".$keyword."%");
			$map['_complex']= $data;
            $this->assign("keyword",$keyword);
        }
		$map["state"]= 2;

		$this->_list($mod,$map);
       // echo $mod->getLastSql();
		$this->display();
	}
	//确认代理商提现
	public function quer(){
		$id = $_GET['id'];
		$mod = D('user_fengchengllist');
		$data = array("state"=>0,"do_time"=>time());
		if($mod->where("id=$id")->save($data) !== false){
			$this->redirect("确认成功",U("user/lists"));exit;
		}else{
			$this->error("确认失败",U("user/lists"));exit;
		}
	}
    //获取提现记录
    public function log(){
        $mod = D("user_fengchengllist");
        $keyword = $this->_get("keyword","trim");
        if($keyword) {
			$where['username'] = array("like","%".$keyword."%");
			$user = M('user')->where($where)->field('id')->select();
			if(is_array($user)){
				foreach($user as $key => $val){
					$uid[$key] = $val['id'];
				}
			}
			$userid = implode(',',$uid);
			$data['uid']    = array('in',$userid);
			$data['_logic'] = 'or';
			$data["huming"]  = array("like","%".$keyword."%");
			$map['_complex']= $data;
            $this->assign("keyword",$keyword);
        }
        $map["state"] = 0;
        //2016-04-27 by shuguang 添加 
        if($_GET['time_start'] && $_GET['time_end']){
            $map['add_time']= array('between', array(strtotime($_GET['time_start']),strtotime($_GET['time_end'])));
        }

        $this->_list($mod,$map);

        //echo $mod->getLastSql();
        
        $this->display();
    }
    //获取下线分销商 
    public function fenxiao_list(){
        $id=$_GET['id'];
        $username=$_GET['username'];
        $user = D('user');
        $data = $user->getfenxiao($id,$username);   //2016-07-06 Modify By Liuyumei
/*      测试用
        $data_s = $user->getfenxiao_s($id,$username);   //2016-07-06    
        static $arr=array();
        foreach($data as $ke=>$va){
            $arr[]=$va['id'];
        }

        static $arr_s=array();
        foreach($data_s as $ke=>$va){
            $arr_s[]=$va['id'];
        }
        $arr=array_unique($arr); 
        $arr_s=array_unique($arr_s); 

        dump(array_diff($arr, $arr_s));
        dump(array_diff($arr_s, $arr));
        dump($arr);
        dump($arr_s);
        exit;*/
        $this->assign('list',$data);
        $this->display();
    }

    //导出数据 
    public function excelout(){
        //$data['a.status'] = array('in','2,3,4,5');
        //$data['a.add_time'] = session('xiaoshou_list');
        if(!$_POST['time_start'] || !$_POST['time_end']){
            $this->error('请选择申请时间！');
            exit();
        }
        $map['add_time']= array('between', array(strtotime($_POST['time_start']),strtotime($_POST['time_end'])));
        $map['state'] = 0;
        $data=D('user_fengchengllist')->where($map)->select();
        
        $print_data = array();
        foreach ($data as $key => $value) {
            $print_data[$key]['id'] = $value['id'];

            $bank=M('bank')->field('bank')->where(array('id' =>$value['kaihuhang']))->find();
            $user=M('user')->field('username,phone_mob')->where(array('id' =>$value['uid']))->find();
            $value['bank']=$bank['bank'];
            $value['username'] = $user['username'];
            $value['phone_mob'] = $user['phone_mob'];

            $print_data[$key]['username'] = $value['username'];//会员名称

            $print_data[$key]['bank'] = $value['bank'];//开户行
            $print_data[$key]['huming'] = $value['huming'];//持卡人
            $print_data[$key]['zhanghao'] = $value['zhanghao'];//银行账号 

            $print_data[$key]['fencheng'] = $value['fencheng'];//提现金额 
            $print_data[$key]['phone_mob'] = $value['phone_mob'];//手机号 
            
            $print_data[$key]['add_time'] =  date('Y-m-d',$value['add_time']);//申请时间 
            
            $print_data[$key]['do_time'] = date('Y-m-d',$value['do_time']);//处理时间 


         } 
         //print_r($print_data);die;
        $filename="提现记录-".date('Y-m-d');
        $headArr=array("ID","会员名称","开户行","持卡人","银行卡号","提现金额","联系方式","申请时间","处理时间");
        //如果第五个标题为时间戳字段,则在参数最后一位设置为5,没有则为0
        $this->getExcel($filename,$headArr,$print_data,5,0);
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


}