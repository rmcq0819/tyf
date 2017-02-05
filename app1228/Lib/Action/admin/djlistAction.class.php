<?php 
		
		class djlistAction extends backendAction {
			
			public function _initialize() {
				parent::_initialize();
				$this->_mod = D('daijin');
				echo $this->_mod;
			}										
			
			/**
			* 显示代金券列表管理
			* Add time 2015-5-21
			* $Author Wenhao $
			*/
			public function index(){
				
				$dj = M('daijin');
				
				/** ===================屏蔽关联查询S====================
				$user = M('user');				
				$djuser = $dj->field('djuser')->select();
				//遍历元素
				$arr = array();
				foreach($djuser AS $k=>$val){ 
				
					$arr[] = $val["djuser"];  
				
				}
				//拆分$arr数组，获取元素
				$data['id'] = array('IN',array_filter($arr));
				//$uid = implode(',', array_filter($arr));
				$res = $user->field('id,username')->where($data)->select();
				$this->assign('res',$res);
			=======================屏蔽关联查询E====================**/
				
				//更新优惠码状态[0=>未使用，1=>已使用，2=>已过期]
				$res = $dj->field('djend')->select();
				//遍历元素
				$arr = array();
				foreach($res AS $k=>$val){
				
					$arr[] = $val["djend"];
				
				}
				$count = count($arr);
				$now = intval(time());
				for( $i = 0; $i< $count ;$i++ )
				{
					$data['djend'] = intval($arr[$i]);
					if($data['djend']!=0){
						
						if($now>$data['djend']){

							//更新状态：过期
							$st['djstatus'] = 2;
							$dj->where('djend='.$data['djend'])->save($st);
						
						}
						
					}
					
				}			
				if($_GET['keyword']){
					$data['djusername|djname|t_name']=array('like','%'.$_GET['keyword'].'%');
					$list=$dj->where($data)->order('id desc')->select();
					$this->assign('search',$_GET['keyword']);
				}else{
					//调用分页
					$list = $dj->order('id desc')->select();
				}
				//调用分页
				$count =count($list);
				$pager = new Page($count,20);
				$lists=array_slice($list, $pager->firstRow,$pager->listRows);
				$page = $pager->show();
				$this->assign("page", $page);
				$this->assign('list_table', true);
				$this->assign('lists',$lists);
				$this->display();
			}
			
			/**
			 * 添加优惠券
			 *  Add time 2015-5-21
			 * $Author Wenhao $
			*/
			public function add(){

				$this->display();
				
			}
			public function adddjq(){
				
				$diajin = M(daijin);
				if($_POST){
					//接收表单数据
					$data['djname'] = trim($_POST['djname']);
					$data['djcode'] = trim($_POST['djcode']);
					$data['djmoney'] = trim($_POST['djmoney']);
					$data['djcondition'] = trim($_POST['djcondition']);
					$data['djstart'] = strtotime(trim($_POST['djstart']));
					$data['djend'] = strtotime(trim($_POST['djend']));
					
					//插入数据
					if($diajin->field('djname,djcode,djmoney,djcondition,djstart,djend')->data($data)->add()){
						
						$this->success('优惠码生成成功',U('djlist/index'));
						
					}else{
						
						$this->error('优惠码生成失败');
						
					}
					
				}
				
			}
			
			/**
			 * 删除优惠码
			 * 参数:ID
			 * Add time 2015-5-21
			 * $Author Wenhao $
			 */
			public function del(){
			
				// 实例化对象
				$daijin = M('daijin');
			
				//获取ID
				$id = $this->_get('id', 'trim');
				if($daijin->where('id='.$id)->delete() !== false){
						
					$this->success('删除成功', U('djlist/index'));
						
				}else{
						
					$this->error('删除失败');
						
				}
			
			}
				
			/**
			 * 批量删除优惠码
			 * 参数：Array
			 *  Add time 2015-5-21
			 * $Author Wenhao $
			 */
			public function dels(){
			
				// 实例化对象
				$daijin = M('daijin');
							
				//接收ID，Array
				$id = $_POST['id'];
			
				//预处理，防止无参数数删除数据
				$count = count($id);
				if($count<=0){
						
					$this->error('非法操作，请选择删除的记录');
						
				}
				//批量删除
				$ids = implode(',', $id);
				if($daijin->delete($ids)){
			
					$this->success('删除成功', U('djlist/index'));
			
				}else{
			
					$this->error('删除失败');
			
				}
					
			}
			
			/**
			 * 发放优惠券
			 *  Add time 2015-5-21
			 * $Author Wenhao $
			 */
			public function djadd(){
				$temp=M('djtemp');
				$data['end']=array('gt',time());
				$data['type']=0;
				$res=$temp->where($data)->order('id desc')->select();
				if(!$res){
					$this->error('当前可用模板为空,请先添加代金劵模板');exit;
				}
				$this->assign('list',$res);
				$this->display();
				
			}
			public function fdjadd(){
				
				$daijin = M('daijin');
				$user = M('user');
				
				if($_POST){
					//接收表单数据
					$temp['id']=$_POST['temp'];
					$res=M('djtemp')->where($temp)->find();
					$data['djname']=$res['djname'];
					$data['djmoney']=$res['djprice'];
					$data['djcondition']=$res['djcondition'];
					$data['djstart']=$res['start'];
					$data['djend']=$res['end'];
					$data['temp']=$res['id'];
					$data['t_name']=$res['temp'];
					$data['djstatus']=0;
					if($_POST['class']==1){
						$user1=$_POST['djuser'];
						$dj=explode(',',$user1);
						foreach($dj as $val){
							$users=$user->where(array('id'=>$val))->field('id,username')->find();
							if ($users) {
								$data['djusername']=$users['username'];
								$data['djuser']=$users['id'];
								$list=$daijin->where(array('djuser'=>$data['djuser'],'temp'=>$data['temp']))->count();
								if($list==0){
									$daijin->add($data);
								}
							}
						}
					}elseif($_POST['class']==2){
						$users=$user->field('id,username')->select();
						if ($users) {
							foreach($users as $val){
								$data['djusername']=$val['username'];
								$data['djuser']=$val['id'];
								$list=$daijin->where(array('djuser'=>$data['djuser'],'temp'=>$data['temp']))->count();
								if($list==0){
									$daijin->add($data);
								}
							}
						}
						
					}elseif($_POST['class']==3){
						$use['reg_time']=array('between',array(strtotime($_POST['start']),strtotime($_POST['end'])));
						$users=$user->where($use)->field('id,username')->select();
						if($users){
							foreach($users as $val){
								$data['djusername']=$val['username'];
								$data['djuser']=$val['id'];
								$list=$daijin->where(array('djuser'=>$data['djuser'],'temp'=>$data['temp']))->count();
								if($list==0){
									$daijin->add($data);
								}
							}
						}else{
							$this->error('该时间段没有新用户注册');
						}
					}
					$this->success('代金劵发放成功',U('djlist/index'));
				}			
				
			}
			
			/**
			 * 编辑优惠码
			 * 参数：ID
			 * Add time 2015-5-21
			 * $Author Wenhao $
			 */
			public function edit(){
				
				$daijin = M('daijin');
				
				//获取当前对象ID
				$id = $this->_get('id', 'trim');
				$res = $daijin->where('id='.$id)->find();
				$this->assign('res',$res);
				$this->display();
			}
			public function updatedj(){
			
				$daijin = M('daijin');

				if($_POST){
				//接收表单数据
				$data['id'] = $this->_post('id', 'trim');
				$data['djname'] = trim($_POST['djname']);
				$data['djcode'] = trim($_POST['djcode']);
				$data['djmoney'] = trim($_POST['djmoney']);
				$data['djcondition'] = trim($_POST['djcondition']);
				$data['djstart'] = strtotime(trim($_POST['djstart']));
				$data['djend'] = strtotime(trim($_POST['djend']));
				

				//插入数据
				if($daijin->where('id='.$data['id'])->field('djname,djcode,djmoney,djcondition,djstart,djend')->filter('strip_tags')->save($data)!==false){
					
					$this->success('优惠码更新成功',U('djlist/index'));
					
				}else{
					
					$this->error('优惠码更新失败');

					}
					
				}
			
			}

			/**
			 * 批量添加优惠券
			 * 参数：num
			 * Add time 2015-5-22
			 * $Author Wenhao $
			 */
			public function pladd(){
				
				$this->display();
				
			}
			public function pladds(){
				
				$diajin = M(daijin);
				if($_POST){
					//接收表单数据
					$num = intval($_POST['num']);
					$data['djname'] = trim($_POST['djname']);
					$data['djmoney'] = trim($_POST['djmoney']);
					$data['djcondition'] = trim($_POST['djcondition']);
					$data['djstart'] = strtotime(trim($_POST['djstart']));
					$data['djend'] = strtotime(trim($_POST['djend']));
						
					//插入数据
					for( $i = 0; $i< $num ;$i++ ){
						
						$data['djcode'] = trim(md5(uniqid(1,32)));
						//插入数据
						if($diajin->field('djname,djcode,djmoney,djcondition,djstart,djend')->data($data)->add()){
						
							$this->success('优惠码批量生成成功',U('djlist/index'));
						
						}else{
						
							$this->error('优惠码批量生成失败');
						
						}					
						
					}											
					
				}
								
			}
			
			
		}

			
