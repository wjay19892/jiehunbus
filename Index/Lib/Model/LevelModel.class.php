<?php
class LevelModel extends CommonModel {
	function valueToLevel($val){
		static $level_value_to_level= array();
		if (isset($level_value_to_level['_'.$val])){
			return $level_value_to_level['_'.$val];
		}
		$levelmap = array(
			'min' => array('elt',$val),
			'max' => array('gt',$val),
			'status'=>array('eq',1),
		);
		$data = $this->getData($levelmap,'0,1','id asc');
		$level_value_to_level['_'.$val] = $data[0];
		return $data[0];
	}
}
?>