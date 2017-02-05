<?php 
		
		class fpeisongAction extends backendAction {
			
			/**
			 * 显示运费模板列表
			 * Add time 2015-5-19
			 * $Author Wenhao $
			 */
			public function index(){
				
				//实例化对象
				$fpeisong = M('fpeisong');
				
				//获取运费模板列表
				$lists = $fpeisong->select();
				$this->assign('lists',$lists);
				$this->display();
						
			}
			
			/**
			 * 新增模板
			 * Add time 2015-5-19
			 * $Author Wenhao $
			 */
			public function add(){
				
					$this->display();
				
			}
			
			public function addf(){
				
				//实例化对象
				$fpeisong = M('fpeisong');
				
				if($_POST){
					//接收表单传过来的数据
					$data['name'] = trim($_POST['name']);
					$data['content'] = trim($_POST['content']);
					$data['time']	= time();				
					//插入数据
					if($fpeisong->data($data)->add()){
						
						$this->success('新增成功', U('fpeisong/index'));
						
					}else{
						
						$this->error('新增失败');
						
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
				$fpeisong = M('fpeisong');
				
				//获取ID
				$id = $this->_get('id', 'trim');
				if($fpeisong->where('id='.$id)->delete()){
					
					$this->success('删除成功', U('fpeisong/index'));
					
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
				$fpeisong = M('fpeisong');
				
				//接收ID，Array
				$id = $_POST['id'];
				
				//预处理，防止无参数数删除数据
				$count = count($id);
				if($count<=0){
					
					$this->error('非法操作，请选择删除的记录');
					
				}
				//批量删除
				$id = implode(',', $id);
				if($fpeisong->delete($id)){
						
					$this->success('删除成功', U('fpeisong/index'));
						
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
			public function edit(){
				
				// 实例化对象
				$fpeisong = M('fpeisong');	
				
				//获取ID
				$id = $this->_get('id', 'trim');				
				 $res = $fpeisong->where(array('id'=>$id))->find();				 				 
				 $this->assign('res',$res);											
				$this->display();		
										
			}
			
			public function update(){
				
				// 实例化对象
				$fpeisong = M('fpeisong');	
				
				$id = intval($_POST['id']);

				//接收表单传过来的数据
				$data['name'] = trim($_POST['name']);
				$data['content'] = trim($_POST['content']);
				$data['time'] = time();
				
				// 根据条件更新记录
				if($fpeisong->where('id='.$id)->save($data)!==false){
						
					$this->success('保存成功', U('fpeisong/index'));
						
				}else{
						
					$this->error('保存失败');
						
				}
				
			}
			
			/**
			 * 查看运送地区
			 *  Add time 2015-5-22
			 * $Author Wenhao $
			 */
			public function area(){
				
				$psarea = M('psarea');
				
				$arealist =  $psarea->select();
				
				
				//调用分页
				$count =count($arealist);
				$pager = new Page($count,10);
				$lists=array_slice($arealist, $pager->firstRow,$pager->listRows);
				$page = $pager->show();
				$this->assign("page", $page);
				$this->assign('list_table', true);
				$this->assign('list',$arealist);
				
				$this->display();
				
			}
			
			/**
			 * 删除配送地区
			 *  Add time 2015-5-22
			 * $Author Wenhao $
			 */
			public function areadel(){
				
				$psarea = M('psarea');	
				
				//获取ID
				$id = $this->_get('id', 'trim');
				if($psarea->where('id='.$id)->delete()){
				
					$this->success('删除成功', U('fpeisong/area'));
				
				}else{
				
					$this->error('删除失败');
				
				}				
								
			}
			
			/**
			 * 批量删除配送地区
			 *  Add time 2015-5-22
			 * $Author Wenhao $
			 */
			public function areadels(){
				
				$psarea = M('psarea');	
					
				//接收ID，Array
				$id = $_POST['id'];
					
				//预处理，防止无参数数删除数据
				$count = count($id);
				if($count<=0){
				
					$this->error('非法操作，请选择删除的记录');
				
				}
				//批量删除
				$id = implode(',', $id);
				if($psarea->delete($id)){
						
					$this->success('删除成功', U('fpeisong/area'));
						
				}else{
						
					$this->error('删除失败');
						
				}				
								
			}
						
			/**
			 * 新增运送地区
			 *  Add time 2015-5-22
			 * $Author Wenhao $
			 */
			public function addarea(){
				
				$fpeisong = M('fpeisong');
				$id = $this->_get('id','trim');
				$info = $fpeisong->where('id='.$id)->find();
				$this->assign('info',$info);
				$this->display();
				
			}
 			public function addareas(){
				
				$psarea = M('psarea');
				$fpeisong = M('fpeisong');

				if($_POST){
					
					//接收表单数据
					$data['pid'] = $_POST['pid'];
					$data['isno'] = $_POST['type'];
					$data['p'] = $_POST['sheng'];
					$data['c'] = $_POST['shi'];
										
					$data['area'] = trim($data['p'].$data['c']);
					$data['psinit'] = intval($_POST['psinit']);
					$data['pstotal'] = intval($_POST['pstotal']);
					$data['psup'] = intval($_POST['psup']);
					$data['psupto'] = intval($_POST['psupto']);
					
					if($data['p']==""||$data['c']==""){
						
						$this->error('请选择配送省市');
						
					}
					
					//插入数据
					if($psarea->data($data)->add()){
					
						$this->success('新增成功',U('fpeisong/area'));
					
					}else{
					
						$this->error('新增失败');
					
					}										
					
				}
				
			}
			
			/**
			 * 新增运送地区
			 *  Add time 2015-5-22
			 * $Author Wenhao $
			 */
			public function editarea(){
				
				$psarea = M('psarea');
				$fpeisong = M('fpeisong');
				
				$id = $this->_get('id','intval');
				
				$info = $psarea->where('id='.$id)->find();
				$tempname =  $fpeisong->where('id='.$info['pid'])->find();
				
				$this->assign('info',$info);
				$this->assign('tempname',$tempname);
				
				$this->display();
				
			}
			public function updateareas(){
				
				$psarea = M('psarea');
				
				if($_POST){
						
					//接收表单数据
					$data['id'] = $_POST['id'];
					$data['pid'] = $_POST['pid'];
					$data['isno'] = $_POST['type'];
					$p = $_POST['sheng'];
					$c = $_POST['shi'];
						
					//预处理是否更改
					if($p==""||$c==""){

						$data['p'] =  $_POST['p1'];
						$data['c'] =  $_POST['c1'];
						$data['area'] = trim($data['p'].$data['c']);
						
					}else{

						$data['p'] = $_POST['sheng'];
						$data['c'] = $_POST['shi'];
						$data['area'] = trim($data['p'].$data['c']);

					}
					
					$data['psinit'] = intval($_POST['psinit']);
					$data['pstotal'] = intval($_POST['pstotal']);
					$data['psup'] = intval($_POST['psup']);
					$data['psupto'] = intval($_POST['psupto']);
						
					//插入数据
					if($psarea->where()->save($data)!==false){
							
						$this->success('保存成功',U('fpeisong/area'));
							
					}else{
							
						$this->error('保存失败');
							
					}
						
				}
								
			}
			
			
					
				
			
		}