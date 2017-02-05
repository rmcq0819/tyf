<?php
class item_commentAction extends backendAction
{
    public function _initialize() {
        parent::_initialize();
        $this->_mod = M('item_comment');
    }
	
	public function user_add(){
		if(IS_POST){
			
			if(empty($_POST['username'])){
				$this->error('用户名未填写');
			}
			
			$picFile = $_FILES["user_img"];
			if($picFile["error"] === 4) {
				$this->error('用户头像未上传');
				$picurl1 = "";
				$img = "";
			}else {
				$img = "data/upload/avatar/bbs/".time()."_img.jpg";
				$exist = file_exists($picurl1);
				if($exist) {
					unlink($img);
				}
				move_uploaded_file($picFile["tmp_name"],$img);
				$data['is_ficuser'] = 1;
				$data['username'] = $this->_post('username','trim');
				$data['uid'] = 4;
				$data['password'] = md5(123456);
				$data['reg_time'] = time();
				$data['status'] = 1;
				$data['hyimg'] = $img;
				$add = M('user')->add($data);
				if($add){
					$this->success('用户添加成功');
				}else{
					$this->error('用户添加失败');
				}
				
			}
		}else{
			$this->display();
		}
		
	}
	
	public function add(){
		if(IS_AJAX){
			$id = $this->_post('id','trim');
			$userid = $this->_post('userid','trim');
			if(!empty($userid)){
				$users = M('user')->where(array('id'=>$userid))->find();
				echo $users['hyimg'];
				exit;
			}else{
				$item_detail = M('item')->where(array('id'=>$id))->find();
				echo $item_detail['img'];
				exit;
			}
		}
		if(IS_POST){
			$picFile = $_FILES["comment_img"];
			if($picFile["error"] === 4) {
				$picurl1 = "";
				$img = "";
			}else {
				$img = "data/upload/bbs/".time()."_img.jpg";
				$exist = file_exists($picurl1);
				if($exist) {
					unlink($img);
				}
				move_uploaded_file($picFile["tmp_name"],$img);
			}
			
			if(empty($_POST['comment_time'])){
				$this->error('评论时间未填写！');
			}
			
			if(empty($_POST['comment_time'])){
				$this->error('评论内容未填写');
			}
			
			$data['item_id'] = $this->_post('item','trim'); //商品id
			$data['orderId'] = 0; //订单id
			$data['uid'] = $this->_post('user','trim'); //评论用户id
			$data['uname'] = M('user')->where(array('id'=>$this->_post('user','trim')))->getField('username');
			$data['info'] = $this->_post('content','trim'); //评论内容
			$data['picurl1'] = $img; //评论图片
			$data['add_time'] = strtotime($this->_post('comment_time','trim'));
			$data['status'] = 1;
			if(M('item_comment')->add($data)){
				$this->success('评论添加成功！',U('item_comment/add',array('id'=>$_POST['item'])));
			}
		}else{
			$item = M('item')->where(array('status'=>1))->field('id,title')->select();
			foreach($item as $key => $val){
				$comment = M('item_comment')->where(array('item_id'=>$val['id']))->count();
				$arr[] = $val;
				$arr[$key]['counts'] = $comment;
			}
			$where['uid'] = 4;
			$where['is_ficuser'] = 1;
			$where['username'] = array('neq','');
			$users = M('user')->where($where)->order('ren_time asc')->field('username,id')->select();
			$this->assign('item',$arr);
			$this->assign('users',$users);
			$this->display();
		}
	
	}

    public function index() {
        $prefix = C(DB_PREFIX);

        if ($this->_request("sort", 'trim')) {
            $sort = $this->_request("sort", 'trim');
        } else {
            $sort = $prefix.'item_comment.id';
        }
        if ($this->_request("order", 'trim')) {
            $order = $this->_request("order", 'trim');
        } else {
            $order = 'DESC';
        }

        $p = $this->_get('p','intval',1);
        $this->assign('p',$p);
        
        $where = '1=1';
        $keyword = $this->_request('keyword','trim','');
        $keyword && $where .= " AND ((".$prefix."user.username LIKE '%".$keyword."%') OR (".$prefix."item.title LIKE '%".$keyword."%') OR (".$prefix."item_comment.info LIKE '%".$keyword."%') )";
        $search = array();
        $keyword && $search['keyword'] = $keyword;
        $this->assign('search',$search);

        $count = $this->_mod->join($prefix.'user ON '.$prefix.'user.id='.$prefix.'item_comment.uid')->join($prefix.'item ON '.$prefix.'item.id='.$prefix.'item_comment.item_id')->where($where)->count($prefix.'item_comment.id');
        $pager = new Page($count,20);
        $list  = $this->_mod->field($prefix.'item_comment.*,'.$prefix.'user.username,'.$prefix.'item.title as item_name,'.$prefix.'item.img')->join($prefix.'user ON '.$prefix.'user.id='.$prefix.'item_comment.uid')->join($prefix.'item ON '.$prefix.'item.id='.$prefix.'item_comment.item_id')->where($where)->order($sort . ' ' . $order)->limit($pager->firstRow.','.$pager->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$pager->show());

        $this->assign('list_table', true);

        $this->display();
    }
    
    /**
     * 删除
     */
    public function delete()
    {
        $ids = trim($this->_request('id'), ',');
        if ($ids) {
            $item_ids = $this->_mod->where(array('id'=>array('in', $ids)))->getField('item_id', true);
            if (false !== $this->_mod->delete($ids)) {
                $item_mod = D('item');
                foreach ($item_ids as $item_id) {
                    $item_mod->update_comments($item_id);
                }
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
}