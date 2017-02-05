<?php
/** 
 *   数据魔方
 *   @author  vany
 *   date    2015 05 19 
 *       
 */
class ShujuAction extends backendAction{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('requestdata');
    }

    public function index(){
        //查询昨天的数据
        $data['year']=date('Y');
        $data['month']=date('m');
        $data['day']=date('d')-1;
        $res=$this->_mod->where($data)->find();
        //判断是否进行查询
        if($_GET['month']||$_GET['nian']) {
            if($_GET['month']) {
                $_SESSION['s_month']=$_GET['month'];
            }elseif($_GET['nian']){
                $_SESSION['s_year']=$_GET['nian'];
            }    
            //获取指定年份的的折线图数据
            $option = array(
            "legend"=>array("关注人数","取消关注数","文本请求数","图文请求数","语音请求数"),
            "xaxis"=>array("type"=>"category","boundaryGap"=>"true","data"=>$this->time($_SESSION['s_year'],$_SESSION['s_month'])),  
            "series"=>array(
            array("name"=>"关注人数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count($_SESSION['s_year'],$_SESSION['s_month'],'follownum')),                                    
            array("name"=>"取消关注数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count($_SESSION['s_year'],$_SESSION['s_month'],'unfollownum')),                   
            array("name"=>"文本请求数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count($_SESSION['s_year'],$_SESSION['s_month'],'textnum')),              
            array("name"=>"图文请求数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count($_SESSION['s_year'],$_SESSION['s_month'],'imgnum')),                 
            array("name"=>"语音请求数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count($_SESSION['s_year'],$_SESSION['s_month'],'videonum')),          
            ),
            );
            $data=array();
            //获取指定月份的每天数据
            $data['time']=array('between',array(strtotime(date($_SESSION['s_year']."-".$_SESSION['s_month']."-01",time())),strtotime(date($_SESSION['s_year']."-".$_SESSION['s_month']."-t",time()))+24*60*60));
            $list1=$this->_mod->where($data)->select();
        }else{
            if(empty($_SESSION['s_year'])){
                $_SESSION['s_year']=date('Y');
            }
            if(empty($_SESSION['s_month'])){
                $_SESSION['s_month']=date('n');
            }
            //折线图数据
            $option = array(
            "legend"=>array("关注人数","取消关注数","文本请求数","图文请求数","语音请求数"),
            "xaxis"=>array("type"=>"category","boundaryGap"=>"true","data"=>$this->time()),  
            "series"=>array(
            array("name"=>"关注人数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count('','','follownum')),                                    
            array("name"=>"取消关注数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count('','','unfollownum')),                   
            array("name"=>"文本请求数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count('','','textnum')),              
            array("name"=>"图文请求数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count('','','imgnum')),                 
            array("name"=>"语音请求数","type"=>"line","smooth"=>"true","stack"=>"总量","data"=>$this->count('','','videonum')),          
            ),
            );
            $data=array();
            //获取当月的每天数据
            $data['time']=array('between',array(strtotime(date("Y-m-01",time())),strtotime(date("Y-m-t",time()))+24*60*60));
            $list1=$this->_mod->where($data)->select();
        }
        $res1=$this->_mod->field('year')->distinct(true)->select();
        $ec = new Echarts();//显示图表
        $echarts= $ec->show('visit_charts',$option,$option,0);  // 显示在指定的dom节点上
        $this->assign('month',$_SESSION['s_month']);
        $this->assign('nian',$_SESSION['s_year']);
        $this->assign('list2',$res1);
        $this->assign('list1',$list1);
        $this->assign('list',$res);
        $this->assign('echarts',$echarts);
    	$this->display();
    }
    //获取前一个月的天数
    public function time($year,$date){
        $data0=array();
        if($date||$year) {
            for($i=0;$i<date("t",strtotime($year.'-'.$date.'-01'));$i++){ 
                $data0[]=date($date.'-d',strtotime(date($year.'-'.$date.'-01'))+24*60*60*$i);
            } 
        }else{
            for($i=0;$i<date("t",time());$i++){ 
                $data0[]=date('m-d',strtotime(date('Y-m-01',time()))+24*60*60*$i);
            }
        }           
        $data1=array(
               $data0
            );
        return $data1[0];

    }
    //获取前一个前一个月每天的数据
    public function count($year,$date,$file){
        $data0=array();
        if($date||$year) {
            for ($i=0;$i<date("t",strtotime(date($year.'-'.$date.'-01',time())));$i++) { 
                $data0[]=$this->qq_num(strtotime(date($year."-".$date."-01",time()))+24*60*60*$i,$file);
            }
        }else{
            for ($i=0;$i<date("t",time());$i++) { 
                $data0[]=$this->qq_num(strtotime(date("Y-m-01",time()))+24*60*60*$i,$file);
            }
        }        
        $data2=array(
                $data0
            );
        return $data2[0];
    }
    //获取时间段内的数据
    public function qq_num($date,$keyword){
        $data3['time']=array('between',array($date,$date+24*60*60));
        $data4=$this->_mod->where($data3)->field($keyword)->find();
        if ($data4) {
            return $data4[$keyword];
        }else{
            return 0;
        }
        
    }
}