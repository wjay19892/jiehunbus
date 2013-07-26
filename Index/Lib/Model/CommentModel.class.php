<?php
class CommentModel extends CommonModel {
	protected $_filter = array(
		'content'=>array('contentFilter'),
	);
	//获取商品所有信息
	function getDataAll($map,$limit){
		$member = D('Member');
		$comment_reply = D('Comment_reply');
	    $goods = D('Goods');
		$data = $this->getData($map,$limit,'id desc');
		foreach($data as &$value){
		    $value['goods'] = $goods->getOne($value['gid']);
		    if($value['goods']){
		    	$value['goods']['evaluate'] = $goods->getEvaluate($value['gid']);
		    }
			$value['reviewer'] = $member->getOne($value['reviewer']);
			$value['reply'] = $comment_reply->getDataAll($value['id']);
		}
		return $data;
	}
	
	//获取单个的所有数据
	function getOne($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$member = D('Member');
				$comment_reply = D('Comment_reply');
				$goods = D('Goods');
				$data['good'] = $goods->getOne($data['gid']);
				$data['reviewer'] = $member->getOne($data['reviewer']);
				$data['reply'] = $comment_reply->getDataAll($data['id']);
				$data['promulgator'] = $data['good']['promulgator'];
			}
		}else{
			$data = array();
		}
		return $data;
	}
	
	function getNewComment($limit){
		if(C('sysconfig.is_switch_region')){
			$default_region = getDefaultRegion();
			$region = D('Region');
			$arr = $region->getChild($default_region['id']);
			$map['G.rid'] = array('in',$arr[0]['child']);
			$data = $this->_getNewComment($map,$limit);
		}
		if(empty($data)){
			$data = $this->_getNewComment('',$limit);
		}
		return $data;
	}
	
	function _getNewComment($map,$limit){
		$prefix = C('DB_PREFIX');
		$data = $this->Table("{$prefix}comment as C")->
		join("{$prefix}goods as G ON C.gid = G.id")->
		field('C.*,G.title')->
		where($map)->limit($limit)->order('id desc')->findAll();
		return $data;
	}
}
?>