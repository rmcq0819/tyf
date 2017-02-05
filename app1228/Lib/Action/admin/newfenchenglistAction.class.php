<?php
class newfenchenglistAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        //$this->_mod = M('user_fengchengllist');
        $this->_rev = M('user_allfcllist');
        if(empty($_SESSION['admin'])){
            $this->error('非法操作');
        }
    }
    public function index(){

        $list=$this->_rev->where(array('state'=>1))->order('id desc')->select();

        foreach ($list as $key => $value) {
            $list1[]=$value;
        }

        $count=count($list1);
        $pager=new Page($count,20);
        $list=array_slice($list1, $pager->firstRow,$pager->listRows);
        $page = $pager->show();
        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->assign('list_table', true);
        $this->display();
    }
    public function search(){
        if ($_GET['orderId']) {
            $data['state']=1;
            $data['orderId']=trim($_GET['orderId']);
            $list=$this->_rev->where($data)->select();
        }

        if ($_GET['userName']) {
            $data1['state']=1;
            $name = trim($_GET['userName']);
            $data1['username']=array('like','%'.$name.'%');
            $user=M('user')->where($data1)->field('id')->find();
            $data=array();
            $data['state']=1;
            $data['uid']=$user['id'];

            $list=$this->_rev->where($data)->select();

            $data['userName']=$_GET['userName'];
        }

        if ($_GET['time_start'] && $_GET['time_end']) {
            $data['add_time']= array('between', array(strtotime($_GET['time_start']),strtotime($_GET['time_end'])+86400));
            $data['state']=1;
            $list=$this->_rev->where($data)->select();
            $data['time_start'] = $_GET['time_start'];
            $data['time_end']   = $_GET['time_end'];
        }

        foreach ($list as $key => $value) {
            $shares=M('user')->where(array('id'=>$value['uid']))->field('username')->find();
            $username=M('user')->where(array('id'=>$value['user_id']))->field('username')->find();
            $value['shares']=$shares['username'];
            $value['username']=$username['username'];
            $list1[]=$value;
        }
        $count =count($list1);
        $pager = new Page($count,20);
        $list=array_slice($list1, $pager->firstRow,$pager->listRows);
        $page = $pager->show();
        $this->assign('data',$data);
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->assign('list_table', true);
        $this->display();
    }
    public function delete(){
        $id = $this->_get('id','intval');
        $res = $this->_mod->where(array('id'=>$id))->delete();
        if($res !== false){
            $this->success('删除成功！',U('user/lists'));
        }else{
            $this->error('删除失败！',U('user/lists'));
        }
    }

    public function excelout(){
        if(!$_POST['time_start'] || !$_POST['time_end']){
            $this->error('请选择更新时间！');
            exit();
        }
        $map['add_time']= array('between', array(strtotime($_POST['time_start']),strtotime($_POST['time_end'])+86400));
        $map['state']=1;
        $data=$this->_rev->where($map)->select();

        foreach ($data as $key => $value) {
            unset($data[$key]['pingzheng']);
            unset($data[$key]['kaihuhang']);
            unset($data[$key]['huming']);
            unset($data[$key]['is_hand']);
            unset($data[$key]['zhanghao']);

            $shares=M('user')->where(array('id'=>$value['uid']))->field('username')->find();
            $username=M('user')->where(array('id'=>$value['user_id']))->field('username')->find();
            if($data[$key]['is_find']==1){
                $data[$key]['is_find']='未确认';
            }else{
                $data[$key]['is_find']='已确认';
            }
            $data[$key]['shares']=$shares['username'];//分成所属店主
            $data[$key]['username']=$username['username'];//下单人
            $data[$key]['update_time'] = date('Y-m-d H:i',$value['add_time']);//更新时间

            unset($data[$key]['state']);
            unset($data[$key]['type']);
            unset($data[$key]['do_time']);
            unset($data[$key]['uid']);
            unset($data[$key]['class']);
            unset($data[$key]['user_id']);
            unset($data[$key]['add_time']);
        }

        $filename="分成明细";
        $headArr=array("ID","提成率","订单号","分成金额","订单金额","订单状态","分成所属","下单所属","更新时间");
        //如果第五个标题为时间戳字段,则在参数最后一位设置为5,没有则为0
        $this->getExcel($filename,$headArr,$data,3,0);
    }
    /**
     *   后台数据到出excel
     *   @author  vany
     *   date    2015 04 21
     *
     */
    public function getExcel($fileName,$headArr,$data,$key1,$keys){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Think.ORG.PHPExcel");
        import("Think.ORG.PHPExcel.Writer.Excel5");
        import("Think.ORG.PHPExcel.IOFactory.php");
        //对数据进行检验
        if(empty($data) || !is_array($data)){
            die("data must be a array");
        }
        //检查文件名
        if(empty($fileName)){
            exit;
        }

        //$date = date("Y_m_d",time());
        $fileName .= ".xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            $i=1;
            foreach($rows as $keyName=>$value){ // 列写入
                $j = chr($span);
                //判断第E个为时间戳时间
                if ($keys==$i) {
                    $objActSheet->setCellValue($j.$column,date('Y-m-d',$value));
                }else if($key1 == $i){
                    $objActSheet->setCellValue($j.$column,'"'.$value.'"');
                }else{
                    $objActSheet->setCellValue($j.$column,$value);
                }
                $span++;
                $i++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        // $objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }




}