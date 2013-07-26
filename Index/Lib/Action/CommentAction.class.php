<?php
class CommentAction extends CommonAction
{
    public function ajaxComment(){
    //获取查询条件
    	$data = Init_GP(array('gid','uid'));
    	$gid = intval($data['gid']);
    	if(!empty($gid)){
    		$map['gid'] = array('eq',$gid);
    	}
    	//获取的评论
    	$comment = D('Comment');
    	$comment_count = $comment->getCount($map);
    	$limit = $this->page($comment_count);
    	$commentdata = $comment->getDataAll($map,$limit);
		$this->assign('commentdata',$commentdata);
		$this->display();
    }
    
    //全部评论
    public function index(){
    	$this->display();
    }
    
    //ajax获取评论列表
    public function ajaxList(){
    	$comment = D('Comment');
    	$comment_count = $comment->getCount($map);
    	$limit = $this->page($comment_count);
    	$commentdata = $comment->getDataAll($map,$limit);
    	$this->assign('commentdata',$commentdata);
    	$result['html'] = $this->fetch('list');
    	$result['page'] = $this->get('page');
    	$this->success($result);
    }
    
	public function ajaxreviewsComment(){
    //获取查询条件
    	$data = Init_GP(('uid'));
    	$uid = intval($data['uid']);
		if(empty($uid))$uid = $this->memberinfo['id'];
    	$goods = D('Goods');
    	if(!empty($uid)){
    		$goodsmap['promulgator'] = array('eq',$uid);
    		$promulgator = $uid;
    		$ids = $goods->getGather($goodsmap);
    		$map['gid'] = array('in',$ids);
    	}
    	
    	if(empty($map['gid'])){
    		$this->error(L('parameter_error'));
    	}

    	//获取的评论
    	$comment = D('Comment');
    	$comment_count = $comment->getCount($map);
    	$limit = $this->page($comment_count);
    	$commentdata = $comment->getDataAll($map,$limit);
		$this->assign('commentdata',$commentdata);
		$result['commentdata'] = $this->fetch('reviewslist');
		$result['page'] = $this->get('page');
		$result['model'] = 'comment';
		$this->ajaxReturn($result);
    }
	public function ajaxreleasedComment(){
    //获取查询条件
    	$data = Init_GP(('uid'));
    	$uid = intval($data['uid']);
		if(empty($uid))$uid = $this->memberinfo['id'];
    	if(!empty($uid)){
    		$map['reviewer'] = array('eq',$uid) ;
    	}
    	if(empty($map['reviewer'])){
    		$this->error(L('parameter_error'));
    	}
		$now = time();
        $this->assign('now',$now);
    	//获取的评论
    	$comment = D('Comment');
    	$comment_count = $comment->getCount($map);
    	$limit = $this->page($comment_count);
    	$commentdata = $comment->getDataAll($map,$limit);
		$this->assign('commentdata',$commentdata);
		$result['commentdata'] = $this->fetch('releasedlist');
		$result['page'] = $this->get('page');
		$result['model'] = 'releasedcomment';
		$this->ajaxReturn($result);
    }
	public function ajaxSpaceComments(){
    //获取查询条件
    	$data = Init_GP(array('uid','limit'));
    	$uid = intval($data['uid']);
		$limit = intval($data['limit']);
		$limit =$limit.",10";
		$allshownum = $limit+10;
    	$goods = D('Goods');
		$goodmap['promulgator'] = array('eq',$uid);
		$goodmap['status'] = array('eq',1);
		$goodids = $goods->getIds($goodmap);
		
		$comment = D('Comment');
		$commentmap['gid'] = array('in',$goodids);
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