<?php
// 用户模型

class Message_tplModel extends CommonModel {

	public function getBody($name){
		$where = array(
			'name' => array('eq',$name),
		);
		$vlaue = $this->where($where)->find();
		return $vlaue['content'];
	}
	
	
}
?>