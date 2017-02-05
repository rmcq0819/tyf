<?php

class CommentAction extends frontendAction{
	public function index(){
		//获取所有带有图片的评论
		$comment = D('item_comment');
		$comments = $comment->select();
		$this->assign('comments',$comments);
		$this->display('index1');
	}
	
}