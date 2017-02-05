<?php 
		
		class ftempAction extends backendAction {
			
			/**
			 * 显示运费模板列表
			 * Add time 2015-5-19
			 * $Author Wenhao $
			 */
			public function index(){
				
				//实例化对象
				$ftemp = M('ftemp');
				
				//获取运费模板列表
				$lists = $ftemp->select();
				$this->assign('lists',$lists);
				$this->display();
						
			}
			
			/**
			 * 新增模板
			 * Add time 2015-5-19
			 * $Author Wenhao $
			 */
			public function addft(){
				
				//实例化对象
				$ftemp = M('ftemp');
				$addr = M('address');
				$dey = M('delivery');
				
				//获取数据库中的发货地址
				$fh = $addr->select();
				$this->assign('fh',$fh);
				
				//获取数据库中的快递
				$kd = $dey->field("id,name")->select();
				$this->assign('kd',$kd);								
				$this->display();
				
			}
			
			public function add(){
				
				//实例化对象
				$ftemp = M('ftemp');
				
				if($_POST){
					//接收表单传过来的数据
					$data['ft_name'] = trim($_POST['tempname']);
					$data['ft_fhaddr'] = trim($_POST['addr']);
					$data['ft_mode'] = intval($_POST['type']);
					$data['ft_tran'] = implode(',', $_POST['mode']);
					$data['ft_curr'] = trim($_POST['cs1']);
					$data['ft_currf'] = trim($_POST['fy1']);
					$data['ft_add'] = trim($_POST['cs2']);
					$data['ft_addf'] = trim($_POST['fy2']);
					$data['ft_city'] = trim($_POST['area']);
					
					//新增前预处理，防止插入空数据
/* 					if($data['ft_name']==""||$data['ft_fhaddr']||$data['ft_mode']||$data['ft_tran']||$data['ft_curr']||$data['ft_currf']||$data['ft_add']||$data['ft_addf']||$data['ft_city']){
						
						$this->error('运费模板名称、发货地址、计算方式、运送方式、配送区域、配送参数不能为空');
						
					}
 */					
					//插入数据
					if($ftemp->data($data)->add()){
						
						$this->success('新增成功', U('ftemp/index'));
						
					}else{
						
						$this->error($this->_mod->getError());
						
					}
															
				}
								
			}
			
			/**
			 * 删除运费模板
			 * 参数:ID
			 * Add time 2015-5-19
			 * $Author Wenhao $
			 */
			public function del(){
				
				// 实例化对象
				$ftemp = M('ftemp');
				
				//获取ID
				$id = $this->_get('id', 'trim');
				if($ftemp->where('id='.$id)->delete()){
					
					$this->success('删除成功', U('ftemp/index'));
					
				}else{
					
					$this->error('删除失败');
					
				}
				
			}
			
			/**
			 * 批量运费模板
			 * 参数：Array
			 *  Add time 2015-5-19
			 * $Author Wenhao $
			 */
			public function dels(){
				
				// 实例化对象
				$ftemp = M('ftemp');
				
				//接收ID，Array
				$id = $_POST['id'];
				
				//预处理，防止无参数数删除数据
				$count = count($id);
				if($count<=0){
					
					$this->error('非法操作，请选择删除的记录');
					
				}
				//批量删除
				$id = implode(',', $id);
				if($ftemp->delete($id)){
						
					$this->success('删除成功', U('ftemp/index'));
						
				}else{
						
					$this->error('删除失败');
						
				}
			
			}
			
			/**
			 * 查看、更新运费模板
			 * 参数：ID
			 *  Add time 2015-5-19
			 * $Author Wenhao $
			 */
			public function update(){
				
				// 实例化对象
				$ftemp = M('ftemp');
				$addr = M('address');
				$dey = M('delivery');
				
				//获取ID
				$id = $this->_get('id', 'trim');
				
				 $res = $ftemp->where(array('id'=>$id))->find();
				 
				 //获取数据库中的发货地址
				 $fh = $addr->select();
				 //获取数据库中的快递
				 $kd = $dey->field("id,name")->select();
				 
				 $this->assign('kd',$kd);
				 $this->assign('fh',$fh);			 	
				 $this->assign('res',$res);				
							
				$this->display();								
			}
			
			public function update_s(){
				
				// 实例化对象
				$ftemp = M('ftemp');				
				
				$id = intval($_POST['id']);

				//接收表单传过来的数据
				$data['ft_name'] = trim($_POST['tempname']);
				$data['ft_fhaddr'] = trim($_POST['addr']);
				$data['ft_mode'] = intval($_POST['type']);
				$data['ft_tran'] = implode(',', $_POST['mode']);
				$data['ft_curr'] = trim($_POST['cs1']);
				$data['ft_currf'] = trim($_POST['fy1']);
				$data['ft_add'] = trim($_POST['cs2']);
				$data['ft_addf'] = trim($_POST['fy2']);
				$data['ft_city'] = trim($_POST['area']);
				
				//更新前预处理，防止插入空数据
/* 				if($data['ft_name']==""||$data['ft_fhaddr']||$data['ft_mode']||$data['ft_tran']||$data['ft_curr']||$data['ft_currf']||$data['ft_add']||$data['ft_addf']||$data['ft_city']){
				
					$this->error('运费模板名称、发货地址、计算方式、运送方式、配送区域、配送参数不能为空');
				
				}
	 */									
				// 根据条件更新记录
				if($ftemp->where('id='.$id)->save($data)){
						
					$this->success('保存成功', U('ftemp/index'));
						
				}else{
						
					$this->error('保存失败');
						
				}
				
			}
				
			
		}