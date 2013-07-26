<?php
class Talk_aboutAction extends CommonAction
{
	//获取符合条件所有说说的数据 带分页
	public function lists(){
		$gid = intval($_REQUEST['gid']);
		if($gid){
			$map['gid'] = array('eq',$gid);
		}
		
		$tid = intval($_REQUEST['tid']);
		if($tid){
			$map['tid'] = array('eq',$tid);
		}
		/* 获取说说数据 */
		$talk_about = D('Talk_about');
		$count = $talk_about->getCount($map);
		$limit = $this->page($count);
		$talk_aboutdata = $talk_about->getDataAll($map,$limit);
		$this->assign('talk_aboutdata',$talk_aboutdata);
		$this->display();
	}
	
	//获取一个 说说的数据
	public function getOne(){
		$tid = intval($_REQUEST['tid']);
		if($tid){
			$talk_about = D('Talk_about');
			$data = $talk_about->getOne($tid);
			$this->assign('vo',$data);
			$this->display();
		}
	}
	
	//获取 某 说说的 所有评论的前10条
	public function getComment(){
		$tid = intval($_REQUEST['tid']);
		if($tid){
			$talk_about_comment = D('Talk_about_comment');
			$map['tid'] = array('eq',$tid);
			$data = $talk_about_comment->getDataAll($map,10);
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	//获取一个评论的 数据
	public function getCommentOne(){
		$id = intval($_REQUEST['id']);
		if($id){
			$talk_about_comment = D('Talk_about_comment');
			$data = $talk_about_comment->getOne($id);
			$this->assign('vo',$data);
			$this->display();
		}
	}
	
	public function detail(){
		$id = intval($_REQUEST['id']);
		if(!$id){
			$this->error(L('operational_error'));
		}
		$talk_about = D('Talk_about');
		$talk_aboutdata = $talk_about->getOne($id);
		if($talk_aboutdata['gid']){
			//如果是对商品说的 在右面显示 商品
			$goods = D('Goods');
			$goodsdata = $goods->getOne($talk_aboutdata['gid']);
			$this->assign('goodsdata',$goodsdata);
		}else{
			//如果不是对商品说的 右边 显示当前用户
			$member = D('Member');
			$userdata = $member->getOne($talk_aboutdata['uid']);
			$userdata['recommend'] = $member->getRecommendNum($talk_aboutdata['uid']);
			$userdata['evaluate'] = $member->getEvaluateNum($talk_aboutdata['uid']);
			$this->assign('userdata',$userdata);
		}
		$this->assign('talk_aboutdata',$talk_aboutdata);
		$this->display();
	}
	
}
?>