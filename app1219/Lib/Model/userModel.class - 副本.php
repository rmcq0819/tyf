<?php

class userModel extends Model
{
    protected $_validate = array(
        array('username', 'require', '{%username_require}'), //不能为空
        array('repassword', 'password', '{%inconsistent_password}', 0, 'confirm'), //确认密码
        array('email', 'email', '{%email_error}'), //邮箱格式
        array('username', '1,20', '{%username_length_error}', 0, 'length', 1), //用户名长度
        array('password', '6,20', '{%password_length_error}', 0, 'length', 1), //密码长度
        array('username', '', '{%username_exists}', 0, 'unique', 1), //新增的时候检测重复
    );

    protected $_auto = array(
        array('password','md5',1,'function'), //密码加密
        array('reg_time','time',1,'function'), //注册时间
        array('reg_ip','get_client_ip',1,'function'), //注册IP
    );

    /**
     * 修改用户名
     */
    public function rename($map, $newname) {
        if ($this->where(array('username'=>$newname))->count('id')) {
            return false;
        }
        $this->where($map)->save(array('username'=>$newname));
        $uid = $this->where(array('username'=>$newname))->getField('id');
        //修改商品表中的用户名
        M('item')->where(array('uid'=>$uid))->save(array('uname'=>$newname));
        //修改专辑表中的用户名
        M('album')->where(array('uid'=>$uid))->save(array('uname'=>$newname));
        //评论和微薄暂时不修改。
        return true;
    }

    public function name_exists($name, $id = 0) {
        $where = "username='" . $name . "' AND id<>'" . $id . "'";
        $result = $this->where($where)->count('id');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function email_exists($email, $id = 0) {
        $where = "email='" . $email . "' AND id<>'" . $id . "'";
        $result = $this->where($where)->count('id');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 通过用户id获取所有分销商
     * @param unknown $userid
     */
    public function getfenxiao($userid,$level=1,$shares){
    	static $fenxiaos = array();
    	$where = array('shares'=>$userid,'status'=>1); 
    	//获取当前userid下的所有分销商
        $shares=$this->field('username')->where(array('id'=>$userid))->find();
    	$res = $this->field('id,username,reg_time,cover')->where($where)->select();
    	foreach ($res as $k=>$v){
    		$v['level'] = $level;
            $v['shares']= $shares['username'];
    		$fenxiaos[] = $v;
    		$this->getfenxiao($v['id'],$level+1);
    	}
    	return $fenxiaos;
    }

     /**
     *  判断代理是否符合升级条件
     *  @author vany 
     *  date 2015-12-14
     */
    public function check_lv($id,$uid){
        //如果当前会员等级为boss
        if ($uid == 1) {
            return false;
            exit;
        }
        //掌柜获取所有卖咖数
        if ($uid == 2) {
            $res['num'] = $this->get_mk($id,$uid);
            $data['shares'] = $id;
            $data['uid'] = 3;
            $data['recom'] = 0;
            $res['zt']  = $this->where($data)->count(); 
        }else if ($uid == 3) {
            //获取所有直推卖咖
            $res['num'] = $this->get_mk($id,$uid);
            $data['recom'] = $id;
            $data['uid'] = 3;
            $res['zt'] = $this->where($data)->count();
        }
        //获取用户升级条件
        $where['id'] = $uid-1;
        $condition = M('user_category')->where($where)->find();
        if ($res['num'] >= $condition['upgrade'] && $res['zt'] >= $condition['upgrade1']) {
            $res['status'] = 1;
			return $res;
        }else{
			$res['status'] = 0;
            return $res;
        }
    }

    /**
     *  通过用户id获取卖咖总数
     *  @author vany 
     *  date 2015-12-11
     */
    public function get_mk($user,$uid){
        if ($uid == 2) {
            $data['shares'] = $user;
        }else{
            $data['recom']  = $user;
        }
        $data['uid'] = 3;
        $res = $this->where($data)->field('id')->select();
        $recom += count($res);
        if ($res) {
            foreach ($res as $key => $value) {
                $this->get_mk($value['id']);
            }
        }
        return $recom;
    }
}