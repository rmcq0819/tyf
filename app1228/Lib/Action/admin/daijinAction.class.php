<?php 
		
		class daijinAction extends backendAction {
			
			public function _initialize() {
				parent::_initialize();
				$this->_mod = D('djtemp');
			}										
			
			/**
			* 显示代金券列表管理
			* Add time 2015-5-21
			* $Author Wenhao $
			*/
			public function index(){
				
				$dj = M('djtemp');
				if($_GET['keyword']){
					$data['djname|temp']=array('like','%'.$_GET['keyword'].'%');
					$data['type']=0;
					$list=$dj->where($data)->select();
					$this->assign('search',$_GET['keyword']);
				}else{
					//调用分页
					$list = $dj->order('id desc')->where(array('type'=>0))->select();
				}
				$count =count($list);
				$pager = new Page($count,20);
				$lists=array_slice($list, $pager->firstRow,$pager->listRows);
				$page = $pager->show();
				$this->assign("page", $page);
				$this->assign('list_table', true);
				$this->assign('lists',$lists);
				/* print_r($lists); */
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
			public function addtemp(){
				
				$diajin = M('djtemp');
				if($_POST){
					//接收表单数据
					$data['djname'] = trim($_POST['djname']);
					$data['djmoney'] = trim($_POST['djmoney']);
					$data['djcondition'] = trim($_POST['djcondition']);
					$data['start'] = strtotime(trim($_POST['djstart']));
					$data['end'] = strtotime(trim($_POST['djend']));
					
					//插入数据
					if($diajin->field('djname,djmoney,djcondition,start,end')->data($data)->add() !== false){
						
						$this->success('代金券生成成功',U('daijin/index'));
						
					}else{
						
						$this->error('代金券生成失败');
						
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
				$daijin = M('djtemp');
			
				//获取ID
				$id = $this->_get('id', 'trim');
				if($daijin->where('id='.$id)->delete() !== false){
						
					$this->success('删除成功', U('daijin/index'));
						
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
				$daijin = M('djtemp');
							
				//接收ID，Array
				$id = $_POST['id'];
			
				//预处理，防止无参数数删除数据
				$count = count($id);
				if($count<=0){
						
					$this->error('非法操作，请选择删除的记录');
						
				}
				//批量删除
				$ids = implode(',', $id);
				if($daijin->delete($ids) !== false){
			
					$this->success('删除成功', U('daijin/index'));
			
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
				
				$this->display();
				
			}
			public function fdjadd(){
				
				$daijin = M('djtemp');
				$user = M('user');
				
				if($_POST){
					//接收表单数据
					//$data['djuser'] = trim($_POST['djuser']);					
					$data['djname'] = trim($_POST['djname']);
					$data['temp']=trim($_POST['temp']);
					$data['djprice'] = trim($_POST['djmoney']);
					$data['djcondition'] = $_POST['djcondition'];
					$data['start'] = strtotime(trim($_POST['djstart']));
					$data['end'] = strtotime(trim($_POST['djend']));
					//
					$res=$daijin->add($data);
					if($res!==false){
						$this->success('添加成功',U('daijin/index'));
					}else{
						$this->error('添加失败');
					}
					/* $arr_id = explode(',', trim($_POST['djuser']));
					$count = count($arr_id);
					
					//循环插入数据
					for( $i = 0; $i< $count ;$i++ )
					{
						$data['djuser'] = $arr_id[$i];
						
						//通过相应的ID，获取相应的用户名
						$userinfo= $user->where('id='.$data['djuser'])->find();
						$data['djusername'] = $userinfo['username'];
						
						$data['djcode'] = trim(md5(uniqid(1,32)));
						//插入数据
						if($diajin->field('djuser,djusername,djname,djcode,djmoney,djcondition,djstart,djend')->data($data)->add()){
						
							$this->success('代金券发放成功',U('daijin/index'));
						
						}else{
						
							$this->error('代金券发放失败');
						
						}
						
					} */
																		
				}			
				
			}
			
			/**
			 * 编辑优惠码
			 * 参数：ID
			 * Add time 2015-5-21
			 * $Author Wenhao $
			 */
			public function edit(){
				
				$daijin = M('djtemp');
				
				//获取当前对象ID
				$id = $this->_get('id', 'trim');
				$res = $daijin->where('id='.$id)->find();
				$this->assign('res',$res);
				//print_r($res);
				$this->display();
			}
			public function updatedj(){
			
				$daijin = M('djtemp');

				if($_POST){
				//接收表单数据
				$data['id'] = $this->_post('id', 'trim');
				$data['djname'] = trim($_POST['djname']);
				$data['temp'] = trim($_POST['temp']);
				$data['djprice'] = trim($_POST['djmoney']);
				$data['djcondition'] = $_POST['djcondition'];
				$data['start'] = strtotime(trim($_POST['djstart']));
				$data['end'] = strtotime(trim($_POST['djend']));
				

				//插入数据
				if($daijin->where('id='.$data['id'])->filter('strip_tags')->save($data)!==false){
					
					$this->success('代金券更新成功',U('daijin/index'));
					
				}else{
					
					$this->error('代金券更新失败');

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
				
				$diajin = M('djtemp');
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
						
							$this->success('代金券批量生成成功',U('daijin/index'));
						
						}else{
						
							$this->error('代金券批量生成失败');
						
						}					
						
					}											
					
				}
								
			}
			
			
		}

			
