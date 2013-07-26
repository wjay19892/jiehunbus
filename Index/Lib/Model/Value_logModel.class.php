<?php
//系统配置
class Value_logModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'val'=>array('GetNum'),
				'content'=>array('Char_cv'),
                'rel_id'=>array('GetNum'),
				'rel_module'=>array('Char_cv'),
				'addtime'=>array('','toDate'),
			);
	protected $_auto = array ( 
		array('addtime','time',1,'function'), // 对regtime字段在更新的时候写入当前时间戳
	);
	//获取多个
	function getDataAll($map=array(),$limit=''){
		$data = $this->getData($map,$limit,'id desc');
		return $data;
	}
	//获取用户好友请求数量
	function getCount($map=array()){
		return $this->where($map)->count();
	}
	//获取单个
	function getOne($id){
		if($id){
			$data = $this->find($id);
		}else{
			$data = array();
		}
		return $data;
	}

}
?>