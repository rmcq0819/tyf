<?php
class adminAction extends backendAction
{
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('admin');
    }

    public function _before_index() {
        $big_menu = array(
            'title' => '添加管理员',
            'iframe' => U('admin/add'),
            'id' => 'add',
            'width' => '500',
            'height' => '210'
        );
        $this->assign('big_menu', $big_menu);
        $this->list_relation = true;
    }

    public function _before_add() {
        $role_list = M('admin_role')->where('status=1')->select();
        $_SESSION['content']='添加管理员资料';
        $this->assign('role_list', $role_list);
    }

    public function _before_insert($data='') {
        if( ($data['password']=='')||(trim($data['password']=='')) ){
            unset($data['password']);
        }else{
            $data['password'] = md5($data['password']);
        }
        return $data;
    }

    public function _before_edit() {
        $role_list = M('admin_role')->where('status=1')->select();
        $_SESSION['content']='修改管理员资料';
        $this->assign('role_list', $role_list);
    }
    public function _before_delete() {
        $_SESSION['content']='删除管理员资料';
    }

    public function _before_update($data=''){
        if( ($data['password']=='')||(trim($data['password']=='')) ){
            unset($data['password']);
        }else{
            $data['password'] = md5($data['password']);
        }
        return $data;
    }

    public function ajax_check_name() {
        $name = $this->_get('username', 'trim');
        $id = $this->_get('id', 'intval');
        if ($this->_mod->name_exists($name, $id)) {
            echo 0;
        } else {
            echo 1;
        }
    }
}