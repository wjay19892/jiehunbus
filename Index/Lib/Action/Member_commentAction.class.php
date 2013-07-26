<?php
class Member_commentAction extends CommonAction
{
    public function ajaxComment(){
    //获取查询条件
    	$data = Init_GP(array('uid','reviewer'));
    	$uid = intval($data['uid']);
		$reviewer = intval($data['reviewer']);
		
    	if(!empty($uid)){
    		$map['uid'] = array('eq',$uid);
    	}
    	if(!empty($reviewer)){
    		$map['reviewer'] = array('eq',$reviewer);
    	}
    	if(empty($map['uid'])){
    		$this->error(L('parameter_error'));
    	}

    	//获取的评论
    	$comment = D('Member_comment');
    	$comment_count = $comment->getCount($map);
    	$limit = $this->page($comment_count);
    	$commentdata = $comment->getDataAll($map,$limit);
		$this->assign('commentdata',$commentdata);
		$result['commentdata'] = $this->fetch('list');
		$result['page'] = $this->get('page');
		$result['model'] = 'member_comment';
		$this->ajaxReturn($result);
    }
    public function ajaxreviewsComment(){
    //获取查询条件
    	$data = Init_GP(array('uid'));
    	$uid = intval($data['uid']);
		if(empty($uid))$uid = $this->memberinfo['id'];
    	if(!empty($uid)){
    		$map['uid'] = array('eq',$uid);
    	}
    	if(empty($map['uid'])){
    		$this->error(L('parameter_error'));
    	}

    	//获取的评论
    	$comment = D('Member_comment');
    	$comment_count = $comment->getCount($map);
    	$limit = $this->page($comment_count);
    	$commentdata = $comment->getDataAll($map,$limit);
		$this->assign('commentdata',$commentdata);
		$result['commentdata'] = $this->fetch('reviewslist');
		$result['page'] = $this->get('page');
		$result['model'] = 'member_comment';
		$this->ajaxReturn($result);
    }
	public function ajaxreleasedComment(){
    //获取查询条件
    	$data = Init_GP(array('uid'));
    	$uid = intval($data['uid']);
		if(empty($uid))$uid = $this->memberinfo['id'];
    	if(!empty($uid)){
    		$map['reviewer'] = array('eq',$uid);
    	}
    	if(empty($map['reviewer'])){
    		$this->error(L('parameter_error'));
    	}
		$now = time();
        $this->assign('now',$now);
    	//获取的评论
    	$comment = D('Member_comment');
    	$comment_count = $comment->getCount($map);
    	$limit = $this->page($comment_count);
    	$commentdata = $comment->getDataAll($map,$limit);
		$this->assign('commentdata',$commentdata);
		$result['commentdata'] = $this->fetch('releasedlist');
		$result['page'] = $this->get('page');
		$result['model'] = 'member_comment';
		$this->ajaxReturn($result);
    }
	public function ajaxSpaceComments(){
    //获取查询条件
    	$data = Init_GP(array('uid','limit'));
    	$uid = intval($data['uid']);
		$limit = intval($data['limit']);
		$limit =$limit.",10";
		$allshownum = $limit+10;
		
		$comment = D('Member_comment');
		$commentmap['uid'] = array('eq',$uid);
		$commentdata = $comment->getDataAll($commentmap,$limit);
		$commentdatanum = $comment->getCount($commentmap);

		$this->assign('commentdata',$commentdata);
		$this->assign('allshownum',$allshownum);
		$this->assign('commentdatanum',$commentdatanum);
		$result = $this->fetch('spacelist');
		$this->ajaxReturn($result,'',1);
    }
    
}
?>