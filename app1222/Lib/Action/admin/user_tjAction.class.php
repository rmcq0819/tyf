<?php
/** 
 *   用户统计
 *   @author  vany
 *   date    2015 05 19 
 *       
 */
class user_tjAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('user');
    }
    public function index(){
        $order=$_GET['order']?$_GET['order']:"DESC";
        $sort = array(  
        'direction' => 'SORT_'.strtoupper($order), //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
        'field'     => $_GET['sort']?$_GET['sort']:"order_count",       //排序字段  
        ); 
        if($_GET['keyword']||$_GET['time']){
            $time=$_GET['time'];
            $data['username']=array('like','%'.$_GET['keyword'].'%');
			$data['reg_time']=array('between',array(strtotime($time['time_start']),strtotime($time['time_end'])));
			$data['_logic'] = 'OR';
            $res=M('user')->where($data)->field('id,username,wechatid,email,gender,uid,hyimg,cover')->select();
            $this->assign('keyword',$_GET['keyword']);
            $this->assign('search', array(
            'time_start' => $time['time_start'],
            'time_end' => $time['time_end'],
        ));
        }else{
            $res=M('user')->field('id,username,wechatid,email,gender,hyimg,cover,phone_mob,uid')->where('uid=2 or uid=3')->select();
            
        }
        $res1=array();
        foreach ($res as $key => $value) {
			$where['shopid'] = $value['id'];
			$where['status'] = array('in','2,3,4');
            $order_sumPrice=M('item_order')->where($where)->sum('order_sumPrice');
            $order_sumPrice=$order_sumPrice?$order_sumPrice:0;
            $order_count=M('item_order')->where($where)->count();
            $order_count=$order_count?$order_count:0;
            $value['order_count']=$order_count;
            $value['order_sumPrice']=$order_sumPrice;
            $res1[]=$value;
        }
        
        $res1=$this->multi_array_sort($res1,$sort);
        $_SESSION['user_tj']=$res1;
        //dump($res1);
        $count =count($res1);
        $pager = new Page($count,20);
        $list=array_slice($res1, $pager->firstRow,$pager->listRows);
        $page = $pager->show();
        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->assign('list_table', true);
        $this->display();
        
    }
    /*多维数组排序
    $multi_array:多维数组名称
    $sort_key:二维数组的键名
    $sort:排序常量	SORT_ASC || SORT_DESC
    */
    public function multi_array_sort($multi_array,$sort){
        $arrSort = array();  
        foreach($multi_array AS $uniqid => $row){  
            foreach($row AS $key=>$value){  
                $arrSort[$key][$uniqid] = $value;  
            }  
        }  
        if($sort['direction']){  
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $multi_array);  
        }
        //dump($multi_array);
        return $multi_array;
    }
    public function excelout(){
        $data=$_SESSION['user_tj'];
        $filename="客户统计";
        $headArr=array("ID","用户名","微信ID","电子邮箱","性别(0为女/1为男)","订单数量","订单金额");
        //如果第五个标题为时间戳字段,则在参数最后一位设置为5,没有则为0
        $this->getExcel($filename,$headArr,$data,0);
    }
    
}  