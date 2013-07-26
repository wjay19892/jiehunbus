<?php
class Member_commentModel extends CommonModel {
	//获取用户评论信息
	protected $_filter = array(
		'content'=>array('contentFilter'),
	);
	function getDataAll($map,$limit){
		$member = D('Member');
		$data = $this->getData($map,$limit,"`id` desc");
		foreach($data as &$value){
			$value['reviewer'] = $member->getOne($value['reviewer']);
			$value['uid'] = $member->getOne($value['uid']);
		}
		return $data;
	}	
	//获取单个的所有数据
	function getOne($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$member = D('Member');
				$data['reviewer'] = $member->getOne($data['reviewer']);
				$data['uid'] = $member->getOne($data['uid']);
			}
		}else{
			$data = array();
		}
		return $data;
	}
}
?>