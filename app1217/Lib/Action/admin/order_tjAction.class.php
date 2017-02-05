<?php
/**
 * 用户信息管理
 */
class order_tjAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('user');
    }
    public function index(){
        // 饼形图模拟数据
        if ($_GET['time']) {
            $time=$_GET['time'];
            $date=array('between',array(strtotime($time['time_start']),strtotime($time['time_end']))); 
        }
        $optionPie = array(
            "tooltip"=>array(
                "trigger"=> "item",
                "show"=> true,
                "formatter"=> "{a} <br>{b} : {c} ({d}%)"
            ),
        "grid"=>array("height"=> 450, "y"=> 20,"x"=> 81),
        "legend"=>array("待付款","待发货","待收货","完成","关闭","维权"),
        "series"=>array(
                array("name"=>"订单概况","type"=>"pie","stack"=>"总数",
        "data"=>array(
                array("value"=>$this->order_count($date,1),"name"=>"待付款"),
                array("value"=>$this->order_count($date,2),"name"=>"待发货"),
                array("value"=>$this->order_count($date,3),"name"=>"待收货"),
                array("value"=>$this->order_count($date,4),"name"=>"完成"),
                array("value"=>$this->order_count($date,5),"name"=>"关闭"),
                array("value"=>$this->order_count($date,6),"name"=>"维权"),
                ),
                ),
                ),
            );
            $ec = new Echarts();//显示图表
            $echarts= $ec->show('order_info', $optionPie,$optionPie,0);  // 显示在指定的dom节点上
            
            $this->assign('count',
            array(
            'echarts'=>$echarts
            )
            );
            $this->assign('search',$time);
            $this->display();
            
    }
    public function order_count($time,$status){
        if ($time) {
            $data['add_time']=$time;
            $data['status']=$status;
            $res=M('item_order')->where($data)->count();
        }else{
            $data['status']=$status;
            $res=M('item_order')->where($data)->count();
        }    
        return $res;
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
    
}  