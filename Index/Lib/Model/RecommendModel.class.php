<?php
class RecommendModel extends CommonModel {
    //获取所有信息
	protected $_filter = array(
		'content'=>array('contentFilter'),
	);
	function getDataAll($map,$limit){
		$member = D('Member');
		$data = $this->getData($map,$limit,'id desc');
		$goods = D('Goods');
		foreach($data as &$value){
		    $value['goods'] = $goods->getOne($value['gid']);
			$value['reviewer'] = $member->getOne($value['reviewer']);
		}
		return $data;
	}
    //获取单个的所有数据
	function getOne($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$member = D('Member');
				$goods = D('Goods');
				$goodsdata = $goods->getOne($value['gid']);
				$data['reviewer'] = $member->getOne($data['reviewer']);
				$data['promulgator'] = $goodsdata['promulgator'];
			}
		}else{
			$data = array();
		}
		return $data;
	}
}
?>