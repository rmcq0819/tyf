<?php
/** 
 *   销售记录统计
 *   @author  vany
 *   date    2015 05 19 
 *       
 */
class xiaoshou_listAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('user');
    }
    public function index(){
        $order=$_GET['order']?$_GET['order']:"DESC";
        $sort = array(  
        'direction' => 'SORT_'.strtoupper($order), //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
        'field'     => $_GET['sort']?$_GET['sort']:"a.id",       //排序字段  
        ); 
		$data['b.status']=array('in','2,3,4,5');
        if($_GET['keyword']||$_GET['time']){
            $time=$_GET['time'];
			$keyword = $_GET['keyword'];
			if(!empty($time['time_start'])){
				$data['b.add_time']=array('between',array(strtotime($time['time_start']),strtotime($time['time_end']." +1 day")));
			}
			if($keyword){
				$data['a.title|a.orderId']=array('like','%'.$_GET['keyword'].'%');
			}
            $res=M('order_detail')->join("a left join weixin_item_order b on a.orderId=b.orderId")->field("a.id,a.title,a.price,a.quantity,a.orderId,b.add_time")->where($data)->select();

            $this->assign('keyword',$_GET['keyword']);
            $this->assign('search', array(
				'time_start' => $time['time_start'],
				'time_end' 	 => $time['time_end'],
			));
			session('xiaoshou_list',$data['b.add_time']);
        }else{
            $res=M('order_detail')->join("a left join weixin_item_order b on a.orderId=b.orderId")->field("a.id,a.title,a.price,a.quantity,a.orderId,b.add_time")->where($data)->select();
            
        }
		
        $res=$this->multi_array_sort($res,$sort);
        $count =count($res);
        $pager = new Page($count,20);
        $list=array_slice($res, $pager->firstRow,$pager->listRows);
        //2016-04-28 by shuguang start
        foreach ($list as $k => $v) {
            $orderid = M('item_order')->where('orderId="'.$v['orderId'].'" ')->getField('id');
            $list[$k]['id'] = $orderid;
        }
        //2016-04-28 by shuguang end
        //print_r($list);
        //dump($list);
        $page = $pager->show();
        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->assign('list_table', true);
        //dump($list);

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
     //2016-07-12 Modify By Liuyumei 
    public function excelout(){
		//$data['a.status'] = array('in','2,3,4,5');
		//$data['a.add_time'] = session('xiaoshou_list');
        $data['b.status'] = array('in','2,3,4,5');
        $data['b.add_time'] = session('xiaoshou_list');

        $data = M('order_detail')->join("a left join weixin_item_order b on a.orderid=b.orderId")->field("b.id,a.title,a.orderId,a.quantity,a.price,a.quantity*a.price as order_sumPrice,b.add_time,b.cash_price,b.coupon_price")->where($data)->order('a.id asc')->select();
		
		/*
        $data=M('item_order')
			   ->where($data)
			   ->join("a left join __ORDER_DETAIL__ as b on a.orderId = b.orderId")
			   ->field('a.id,b.title,a.orderId,b.quantity,b.price,a.order_sumPrice,a.add_time')
			   ->select(); 
        */
        //2016-04-28 by shuguang start
       
        foreach ($data as $k => $v) {
            $order_id = substr($v['orderId'],0,18);
            $data[$k]['order_id'] = $order_id;
        }
        
        //构造输出数组 
        $print_data = array();
        $orderid_arr = array();//保存订单id的数组 
        foreach ($data as $key => $value) {
            $orderid_arr[] = $value['order_id'];//将当期循环的订单order_id 保存到一个数组 

            $print_data[$key]['id'] = $value['id'];//id
            $print_data[$key]['orderId'] = $value['orderId'];//订单号
            $print_data[$key]['add_time'] = $value['add_time'];//下单时间
            $print_data[$key]['title'] = $value['title'];//商品名称
            $print_data[$key]['quantity'] = $value['quantity'];//数量
            $print_data[$key]['price'] = $value['price'];//售价
            $print_data[$key]['order_sumPrice'] = $value['order_sumPrice'];//总价
            $print_data[$key]['order_id'] = $value['order_id'];//订单号
            $print_data[$key]['cash_price'] = $value['cash_price'];//订单号
            $print_data[$key]['coupon_price'] = $value['coupon_price'];//订单号
			
        }
        //2016-04-28 by shuguang end
        $orderid_arr = array_unique($orderid_arr);//根据order_id对数组去重，有几个订单以下循环几次


        $re=M('setting')->where("name='site_yunfei'")->select();
       /* dump($re[0]['data']);
        dump(floatval($re[0]['data']));exit;*/
        foreach ($orderid_arr as $kk => $vv) {
            foreach ($print_data as $ky => $vl) {
                if($vl['order_id']==$vv){
                    $temp['key'] = $ky;
                    $temp['total'] += $vl['order_sumPrice'];//统计每个订单的总金额
                    $temp['cash_price'] = $vl['cash_price'];
                    $temp['coupon_price'] = $vl['coupon_price'];
                }
            }
			if($temp['total']<99){
				$print_data[$temp['key']]['order_sumPrice'] += floatval($re[0]['data']);//订单总价小于99 的，给其中一个商品 +运费
                $print_data[$temp['key']]['order_sumPrice'] = round($print_data[$temp['key']]['order_sumPrice'],2).'';
            }
			
			if(!$temp['cash_price']==0){
				$print_data[$temp['key']]['cash_price'] = '使用'.$temp['cash_price'].'张范票抵扣了'.$temp['cash_price']/100 .'元现金';
			}else{
				$print_data[$temp['key']]['cash_price'] ='无';
			}
			if(!$temp['coupon_price']==0){
				$print_data[$temp['key']]['coupon_price'] = '使用优惠卷兑换了'.$temp['coupon_price'].'元现金';
			}else{
				$print_data[$temp['key']]['coupon_price'] ='无';
			}
			//dump($print_data);exit;
			//dump($temp).'<br>';
						
         }
		
		
		
		//dump($print_data);exit;
         //print_r($print_data);die;
        $filename = "销售明细";
        $headArr = array("ID","订单号","下单时间","商品名称","数量","售价","总价","范票","优惠卷");
        $printdata = array();
        foreach ($print_data as $key => $value) {
            $printdata[$key]['id'] = $value['id'];//id
            $printdata[$key]['orderId'] = $value['orderId'];//订单号
            $printdata[$key]['add_time'] = $value['add_time'];//下单时间
            $printdata[$key]['title'] = $value['title'];//商品名称
            $printdata[$key]['quantity'] = $value['quantity'];//数量
            $printdata[$key]['price'] = $value['price'];//售价
            $printdata[$key]['order_sumPrice'] = $value['order_sumPrice'];//总价
			if(!$value['cash_price'] == 0){
				$printdata[$key]['cash_price'] = $value['cash_price'];
			}else{
				 $printdata[$key]['cash_price'] = '无';
			}
			
			if(!$value['coupon_price'] == 0){
				$printdata[$key]['coupon_price'] = $value['coupon_price'];
			}else{
				  $printdata[$key]['coupon_price'] = '无';
			}
        }
		


        //如果第五个标题为时间戳字段,则在参数最后一位设置为5,没有则为0
        $this->getExcel($filename,$headArr,$printdata,2,3);
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
                foreach($rows as $keyName=>$value){// 列写入
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