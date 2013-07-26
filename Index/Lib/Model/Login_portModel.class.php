<?php
class Login_portModel extends CommonModel {
	//获取多个
	function getDataAll($map=array()){
		$data = $this->getData($map,'','id asc');
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