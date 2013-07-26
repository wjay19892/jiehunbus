<?php
class Friends_groupModel extends CommonModel {
    //获取用户好友分组信息
    function getFriendsGroupData($uid,$map=array()){
		$map["uid"] = array('eq',$uid);
		$data = $this->where($map)->findAll();
		return $data;
	}
	//获取用户好友数量
	function getCount($uid,$map=array()){
	    $map["uid"] = array('eq',$uid);
		return $this->where($map)->count();
	}
	
	//获取单个的所有数据
	function getOne($id){
		if($id){
			if(is_array($id)){
				$data = $this->where($id)->find();
			}else{
				$data = $this->find($id);
			}
		}else{
			$data = array();
		}
		return $data;
	}
}
?>