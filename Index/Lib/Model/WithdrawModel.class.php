<?php
//系统配置
class WithdrawModel extends CommonModel {	
	protected $_filter = array(
		'id'=>array('GetNum'),
		'uid'=>array('GetNum'),
		'cash'=>array('toPrice'),
		'bank_id'=>array('Char_cv'),
		'bank_card'=>array('Char_cv'),
		'realname'=>array('Char_cv'),
		'remark'=>array('Char_cv'),
		'addtime'=>array('','toDate'),
		'status'=>array('GetNum'),
	);
	protected $_auto = array ( 
		array('addtime','time',1,'function'), // 对addtime字段在更新的时候写入当前时间戳
		array('status','0'),  // 新增的时候把status字段设置为0
	);
	//获取多个的所有信息
	function getDataAll($map,$limit = ''){
		$member = D('Member');
		$data = $this->getData($map,$limit,'id desc');
		if($data){
			foreach($data as &$value){
				$value['member'] = $member->getOne($value['uid']);
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
				$data['member'] = $member->getOne($data['uid']);
			}
		}else{
			$data = array();
		}
		return $data;
	}
}
?>