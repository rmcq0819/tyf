<?php
/** 
 *   后台操作记录
 *   @author  vany
 *   date    2015 05 19 
 *       
 */
class logAction extends backendAction
{
    public function index(){
        $log=M('log');
        if ($_GET['keyword']||$_GET['time']) {
            if ($_GET['keyword']) {
                $data['username']=array('like',array('%'.$_GET['keyword'].'%'));
            }else{
                $data['add_time']=array('between',array(strtotime($_GET['time']['time_start']),strtotime($_GET['time']['time_end'])+24*60*60));
            }
            $res=$log->where($data)->order('add_time desc')->select();
            $this->assign('search',$_GET['time']);
            $this->assign('keyword',$_GET['keyword']);
        }else{
            $res=$log->order('add_time desc')->select();
        }
        $count =count($res);
        $pager = new Page($count,20);
        $list=array_slice($res, $pager->firstRow,$pager->listRows);
        $page = $pager->show();
        $this->assign("page", $page);
        $this->assign('list', $list);
        $this->assign('list_table', true);
        $this->display();
    }
    

   
}