<?php
//系统配置
class Cash_logModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'content'=>array('Char_cv'),
				'val'=>array('toPrice','toPrice'),
                'rel_id'=>array('GetNum'),
				'rel_module'=>array('Char_cv'),
				'addtime'=>array('','toDate'),
			);
	//获取多个的所有信息
	function getDataAll($map,$limit){
		$member = D('Member');
		$data = $this->getData($map,$limit,'id desc');
		foreach($data as &$value){
			$value['member'] = $member->getOne($value['uid']);
		}
		return $data;
	}

}
?>