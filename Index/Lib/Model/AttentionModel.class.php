<?php
class AttentionModel extends CommonModel {
	//获取用户被关注信息
    function getAttentionsData($uid,$map=array()){
	    $prefix = C('DB_PREFIX');
		$map["A.was"] = array('eq',$uid);
		$data = $this->Table("{$prefix}attention as A")->
			   join("{$prefix}member as M on A.was= M.id")->
			   where($map)->field('A.*,M.name as wasname')->
			   order('A.id desc')->findAll();
		return $data;
	}
	//获取用户被关注数量
	function getAttentionsCount($uid,$map=array()){
	    $prefix = C('DB_PREFIX');
		$map["A.was"] = array('eq',$uid);
		return  $this->Table("{$prefix}attention as A")->
			   join("{$prefix}member as M on A.was= M.id")->
			   where($map)->count();
	}
	//获取多个的所有信息
	function getDataAll($map,$limit){
		$member = D('Member');
		$data = $this->getData($map,$limit,'id desc');
		foreach($data as &$value){
			$value['maindata'] = $member->getOne($value['main']);
			$value['wasdata'] = $member->getOne($value['was']);
		}
		return $data;
	}
	//获取单个的所有数据
	function getOne($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$member = D('Member');
				$data['maindata'] = $member->getOne($data['main']);
				$data['wasdata'] = $member->getOne($data['was']);
			}
		}else{
			$data = array();
		}
		return $data;
	}
	//获取统计值
	function getCount($map){
		return $this->where($map)->count();
	}
}
?>