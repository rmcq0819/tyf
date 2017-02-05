<?php
/*
 * 防伪码验证
 * @edit  vany
 * date   2015 05 19  
 */
class FwmAction extends backendAction
{       
       public function _initialize() {
            parent::_initialize();
            $this->_mod = D('fwm');
       }
       public function index(){
            if(IS_POST){
                //应用上传类
                $upload = new UploadFile();
                $date_dir = date('ym/d/'); //上传目录
                //设置上传参数
                $result=$upload->uploadOne($_FILES['xls'],'data/upload/xls/'.$date_dir);
                if ($result['error']) {
                    $this->error($result['info']);
                } else {
                    $path=$result[0]['savepath'].$result[0]['savename'];
                    require_once 'app/Lib/ORG/PHPExcel/IOFactory.php';
                    $objPHPExcel = PHPExcel_IOFactory::load("$path");
                    $objPHPExcel->setActiveSheetIndex(0);
                    $sheet0=$objPHPExcel->getSheet(0);
                    $rowCount=$sheet0->getHighestRow();//excel行数
                    $data=array();
                    $item['add_time']=time();
                    for ($i = 1; $i <= $rowCount; $i++){
                        //$item['code']=$this->getCalculatedValue($sheet0,'A'.$i);
                        $item['code']=$sheet0->getCell('A'.$i)->getValue();
                        if ($item['code']) {
                            $res=M('fwm')->where(array('code'=>$item['code']))->find();
                            if(!$res){
                                M('fwm')->data($item)->add();
                            }
                        }
                       
                    }
                    $this->success('导入成功!');
                }
            }else{
                $list=M('fwm')->select();
                $count =count($list);
                $pager = new Page($count,20);
                $list1=array_slice($list, $pager->firstRow,$pager->listRows);
                //dump($list);
                $page = $pager->show();
                $this->assign("page", $page);
                $this->assign('list', $list1);
                $this->assign('list_table', true);
                $this->display();
            }
       }
      
}
