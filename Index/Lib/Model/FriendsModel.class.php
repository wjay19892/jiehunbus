<?php
class FriendsModel extends CommonModel {
    //获取用户好友信息
    function getFriendsData($uid,$map=array()){
	    $prefix = C('DB_PREFIX');
		$map["F.main"] = array('eq',$uid);
		$data = $this->Table("{$prefix}friends as F")->
			   join("{$prefix}member as M on F.friend = M.id")->
			   join("{$prefix}friends_group as FG on F.gid = FG.id")->
			   where($map)->field('F.*,(case when (F.remark is null or F.remark ="") then M.name else F.remark end) as friendname,M.header,M.online,FG.name as groupname')->
			   order('F.id desc')->findAll();
		return $data;
	}
	//获取用户好友数量
	function getFriendsCount($uid,$map=array()){
	    $prefix = C('DB_PREFIX');
		$map["F.main"] = array('eq',$uid);
		return $this->Table("{$prefix}friends as F")->
			   join("{$prefix}member as M on F.friend = M.id")->
			   join("{$prefix}friends_group as FG on F.gid = FG.id")->
			   where($map)->count();
	}
	
	function getFriendsAll($uid){
		$data = $this->getFriendsData($uid);
		$arr = array();
		$member = D('Member');
		foreach($data as $value){
			$gid = $value['gid'];
			if(empty($arr[$gid])){
				if($gid == 0){
					$arr[$gid] = array(
						'group' =>L('my_friends'),
						'count'=>0,
					);
				}else{
					$arr[$gid] = array(
						'group' =>$value['groupname'],
						'count'=>0,
					);
				}
			}
			$arr[$gid]['count'] ++;
			$arr[$gid]['friends'][] = array(
				'id'=>$value['friend'],
				'name'=>$value['friendname'],
				'header'=>$member->getHeader($value['header']),
				'online'=>$value['online'],
			);
		}
		return $arr;
	}
	//获取多个的所有信息
	function getDataAll($map,$limit){
		$member = D('Member');
	    $friends_group = D('Friends_group');
		$data = $this->getData($map,$limit,'id desc');
		foreach($data as &$value){
			$value['frienddata'] = $member->getOne($value['friend']);
			$value['groupdata'] = $friends_group->getOne($value['gid']);
		}
		return $data;
	}
	
	//获取单个的所有数据
	function getOne($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$member = D('Member');
				$friends_group = D('Friends_group');
				$data['frienddata'] = $member->getOne($data['friend']);
				$data['groupdata'] = $friends_group->getOne($data['gid']);
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