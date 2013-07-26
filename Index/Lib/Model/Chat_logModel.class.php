<?php
class Chat_logModel extends CommonModel {	
	function getRecently($uid){
		$prefix = C('DB_PREFIX');
		$num = C('sysconfig.recently_num');
		$sql = "select distinct (case when send={$uid} then receive else send end) as uid from `{$prefix}chat_log` 
where (send={$uid} and receive<>{$uid}) or (send<>{$uid} and receive={$uid}) order by id desc limit 0,{$num}";
		$data = $this->query($sql);
		$member = D('Member');
		$friends = D('Friends');
		$map['main'] =array('eq',$uid);
		foreach ($data as $value){
			$tmp = $member->getOne($value['uid']);
			$map['friend'] =array('eq',$value['uid']);
			$friend = $friends->getOne($map);
			if(!empty($friend['remark'])){
				$tmp['name'] = $friend['remark'];
			}
			$arr[] = $tmp;
		}
		return $arr;
	}
	
	function getSides($uid1,$uid2){
		$num = C('sysconfig.chat_log_num');
		if(!empty($num)){
			$this->getDialogue($uid1,$uid2,$num);
			krsort($data);
		}
		return $data;
	}
	
	function getDialogueCount($uid1,$uid2){
		$prefix = C('DB_PREFIX');
		$sql = "SELECT count(*) as jvf_count FROM `{$prefix}chat_log` as C left join {$prefix}member as M1 on C.send = M1.id left join {$prefix}member as M2 on C.receive = M2.id WHERE ( (C.send ={$uid1} and C.receive ={$uid2}) or (C.send ={$uid2} and C.receive ={$uid1}) ) and (mark=1) and (C.delid <> {$uid2})";
		$data = $this->query($sql);
		return $data[0]['jvf_count'];
	}
	
	function getDialogue($uid1,$uid2,$limit = ''){
		$prefix = C('DB_PREFIX');
		$sql = "SELECT C.*,M1.name as send_name,M2.name as receive_name FROM `{$prefix}chat_log` as C left join {$prefix}member as M1 on C.send = M1.id left join {$prefix}member as M2 on C.receive = M2.id WHERE ( (C.send ={$uid1} and C.receive ={$uid2}) or (C.send ={$uid2} and C.receive ={$uid1}) ) and (mark=1) and(C.delid <> {$uid2}) ORDER BY C.id desc LIMIT {$limit}";
		$data = $this->query($sql);
		return $data;
	}
	
	function getData($map,$limit){
		if(!empty($map)){
			$map = addPre($map,'C');
		}
		
	    $prefix = C('DB_PREFIX');
		$data = $this->Table("{$prefix}chat_log as C")->
			   join("{$prefix}member as M1 on C.send = M1.id")->
			   join("{$prefix}member as M2 on C.receive = M2.id")->
			   where($map)->field('C.*,M1.name as send_name,M2.name as receive_name')->
			   order('C.id desc')->limit($limit)->
			   findAll();
		return $data;
	}
	
	//获取单个的所有数据
	function getOne($id){
		if($id){
			if(is_array($id)){
				$data = $this->where($id)->getData();
			}else{
				$map['id'] = array('eq',$id);
				$data = $this->getData($map);
			}
		}else{
			$data = array();
		}
		return $data[0];
	}
	
}
?>