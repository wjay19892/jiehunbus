<?php
class Comment_replyModel extends CommonModel {
	protected $_filter = array(
		'content'=>array('contentFilter'),
	);
	//获取商品评论信息
	function getDataAll($cid){
		$member = D('Member');
		$map['cid'] = array('eq',$cid);
		$data = $this->getData($map,'','id asc');
		if($data){
			foreach($data as &$value){
				$value['uid'] = $member->getOne($value['uid']);
				$value['reviewer'] = $member->getOne($value['reviewer']);
			}
		}
		return $data;
	}
	
	//获取单个的所有数据
	function getOne($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$member = D('Member');
				$data['uid'] = $member->getOne($data['uid']);
				$data['reviewer'] = $member->getOne($data['reviewer']);
			}
		}else{
			$data = array();
		}
		return $data;
	}
	
	
}
?>