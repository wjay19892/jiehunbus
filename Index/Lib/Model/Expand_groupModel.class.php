<?php
//系统配置
class Expand_groupModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'expand_ids'=>array('Char_cv'),
		'sort'=>array('GetNum'),
		'status'=>array('GetNum'),
	);
	function getOne($id){
		static $expand_group_one = array();
		if (isset($expand_group_one['_'.$id])){
			return $expand_group_one['_'.$id];
		}
		if($id){
			$data = $this->find($id);
		}else{
			$data = array();
		}
		$expand_group_one['_'.$id] = $data;
		return $data;
	}
}
?>