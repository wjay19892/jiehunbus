<?php
class Friends_requestModel extends CommonModel {
	protected $_filter = array(
		'note'=>array('replacestr'),
	);
    //获取用户好友请求信息
    function getFriendsrequestData($uid,$map=array()){
		$map["main"] = array('eq',$uid);
		$data = $this->where($map)->findAll();
		return $data;
	}
	//获取用户好友请求数量
	function getCount($uid,$map=array()){
	    $map["main"] = array('eq',$uid);
		return $this->where($map)->count();
	}
	//删除好友请求
	public function delRrequest($uid,$map=array()){
		$map["main"] = array('eq',$uid);
		$this->where($map)->delete();
	}
}
?>