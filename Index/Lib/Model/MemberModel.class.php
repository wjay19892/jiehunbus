<?php
class MemberModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'name'=>array('Char_cv'),
				'mail'=>array('Char_cv'),
				'phone'=>array('Char_cv'),
				'address'=>array('Char_cv'),
				'self_introduction'=>array('h'),
				'header'=>array('GetNum'),
				'inviteid'=>array('GetNum'),
				'regip'=>array('Char_cv'),
				'regtime'=>array('',''),
				'value'=>array('','GetNum'),
				'mailstatus'=>array('GetNum'),
				'phonestatus'=>array('GetNum'),
				'online'=>array('GetNum'),
				'cash'=>array('','toPrice'),
				'sina_id'=>array('Char_cv'),
				'renren_id'=>array('Char_cv'),
				'kaixin_id'=>array('Char_cv'),
				'taobao_id'=>array('Char_cv'),
				'qq_id'=>array('Char_cv'),
				'alipay_id'=>array('Char_cv'),
				'status'=>array('GetNum'),	
			  );
	protected $_map = array(
		'email'=>'mail',
	);
	protected $_auto = array ( 
		array('password','md5',1,'function') , // 对password字段使md5函数处理
		array('regip','get_client_ip',1,'function'),
		array('regtime','time',1,'function'), // 对regtime字段在更新的时候写入当前时间戳
		array('value','0'),  // 新增的时候把value字段设置为0
		array('status','1'),  // 新增的时候把status字段设置为1
	);
	//获取所有详细数据
	function getDataAll($map,$limit,$order = 'id desc'){
		$data = $this->getData($map,$limit,$order);
		foreach($data as &$value){
			$value['header'] = $this->getHeader($value['header']);
			$value['level'] = $this->getLevel($value['value']);
			$value['lastlog'] = $this->getLastlog($value['id']);
		}
		return $data;
	}
	
	//获取头像
	function getHeader($id){
		static $member_header = array();
		if (isset($member_header['_'.$id])){
			return $member_header['_'.$id];
		}
		$accessory = D('Accessory');
		if(empty($id)){
			$data = array(
		        "origin"=>__ROOT__.C('sysconfig.site_mb_bigavatar'),
		        "path"=>__ROOT__.C('sysconfig.site_mb_bigavatar'),
		        "thumbnail"=>__ROOT__.C('sysconfig.site_mb_smallavatar'),
			);
		}else{
			$data = $accessory->getOne($id);
		}
		$member_header['_'.$id] = $data;
		return $data;
	}
	
	//获取单个的所有数据
	function getOne($id){
		$k = md5(serialize($id));
		static $member_one = array();
		if (isset($member_one['_'.$k])){
			return $member_one['_'.$k];
		}
		if($id){
			if(is_array($id)){
				$data = $this->where($id)->find();
			}else{
				$data = $this->find($id);
			}
			if(!empty($data)){
				$data['header'] = $this->getHeader($data['header']);
				$data['level'] = $this->getLevel($data['value']);
				$data['lastlog'] = $this->getLastlog($data['id']);
				if($data['isbusiness'] == 1){
					$apply = D('Apply');
					$data['business'] = $apply->getOne(array('uid'=>array('eq',$data['id']),'status'=>array('eq',1)));
				}
			}
		}else{
			$data = array();
		}
		$member_one['_'.$k] = $data;
		return $data;
	}
	
	//获取等级名称
	function getLevel($val){
		static $member_level = array();
		if (isset($member_level['_'.$val])){
			return $member_level['_'.$val];
		}
		$level = D('Level');
		$data = $level->valueToLevel($val);
		$member_level['_'.$val] = $data;
		return $data;
	}
	//获取最后登录日志
	function getLastlog($uid){
		static $member_lastlog = array();
		if (isset($member_lastlog['_'.$uid])){
			return $member_lastlog['_'.$uid];
		}
	    $login_log = D('Login_log');
		$logmap['uid'] = array('eq',$uid);
		$lastlogdata = $login_log->getLastLog($logmap);
		$member_lastlog['_'.$uid] = $lastlogdata;
		return $lastlogdata;
	}
	
	function getExpand($id){
		static $member_expand = array();
		if (isset($member_expand['_'.$id])){
			return $member_expand['_'.$id];
		}
		$attachment = D('Attachment');
		$data = $attachment->getExpand($id);
		$member_expand['_'.$id] = $data;
		return $data;
	}
	//$bool = true 正向移除 false 反向移除
	function setOnline($id,$val,$bool = true){
		$val = intval($val);
		if(!empty($id)){
			if(is_array($id)){
				if($bool){
					$map['id'] = array('in',$id);
				}else{
					$map['id'] = array('not in',$id);
				}
			}else{
				$map['id'] = array('eq',$id);
			}
			$this->where($map)->setField('online', $val);
		}
	}
	function addVal($uid,$val,$content,$rel_id,$rel_module){
	    $uid = intval($uid);
		$val = intval($val);
		$data = $this->getOne($uid);
		if(!empty($data) && $val>0){
		    $map['id'] = array('eq',$uid);
			$info =  $this->setInc('value','id='.$uid,$val);
			if($info){
			    $value_log = D('Value_log');
				$data = array(
					'uid'=>$uid,
					'val'=>$val,
					'content'=>$content,
					'rel_id'=>$rel_id,
					'rel_module'=>$rel_module,
				);
				$id = $value_log->insert($data);
				return $id;
			}else return false;
		}else return false;
	}
	
	function getUser($uid){
		$prefix = C('DB_PREFIX');
		$thumbnail = __ROOT__.C('sysconfig.site_mb_smallavatar');
		$data = $this->query("SELECT M.*,A.thumbnail as header,L.name as level,count(distinct TA.id) as talkcount,count(distinct ATT.id) as listencount FROM `{$prefix}member` as M left join `{$prefix}accessory` as A on M.header = A.id left join `{$prefix}level` as L on M.value < L.max and M.value >= L.min left join `{$prefix}talk_about` as TA on M.id = TA.uid left join `{$prefix}attention` as ATT on M.id = ATT.was where M.id = {$uid} group by M.id limit 0,1");
		$data = $data[0];
		if(!empty($data['id'])){
			if($data['header']){
				$data['header'] = __ROOT__.$data['header'];
			}else{
				$data['header'] = $thumbnail;
			}
		}else{
			$data = false;
		}
		return $data;
	}
	
	function getAttentionNum($uid){
		$attention = D('Attention');
		$attentionmap['main'] = array('eq',$uid);
		return $attention->getCount($attentionmap);
	}
	
	function getWasAttentionNum($uid){
		$attention = D('Attention');
		$attentionmap['was'] = array('eq',$uid);
		return $attention->getCount($attentionmap);
	}
	
	function getTalk_aboutNum($uid){
		$talk_about = D('Talk_about');
		$talk_aboutmap['uid'] = array('eq',$uid);
		return $talk_about->getCount($talk_aboutmap);
	}
	
	function getFavoritesNum($uid){
		$collection = D('Collection');
		$collectionmap['uid'] = array('eq',$uid);
		return $collection->getCount($collectionmap);
	}
	
	function getLikeNum($uid){
		$talk_about_like = D('Talk_about_like');
		$talk_about_likemap['uid'] = array('eq',$uid);
		return $talk_about_like->getCount($talk_about_likemap);
	}
	
	function getOrderNum($uid){
		$order = D('Order');
		$ordermap['uid'] = array('eq',$uid);
		return $order->getCount($ordermap);
	}
	
	function getMessageNum($uid){
		$message = D('Message');
		$messagemap['receive'] = array('eq',$uid);
		$messagemap['mark'] = array('eq',0);
		$messagemap['type'] = array('eq',0);
		return $message->getCount($messagemap);
	}
	
	function getAllNum($uid){
		$data['attention'] = $this->getAttentionNum($uid);
		$data['was_attention'] = $this->getWasAttentionNum($uid);
		$data['talk_about'] = $this->getTalk_aboutNum($uid);
		$data['favorites'] = $this->getFavoritesNum($uid);
		$data['like'] = $this->getLikeNum($uid);
		$data['order'] = $this->getOrderNum($uid);
		return $data;
	}
	
	function getRecommendNum($uid){
		$recommend = D('Recommend');
		$recommendmap['reviewer'] = array('eq',$uid);
		return $recommend->getCount($recommendmap);
	}
	
	function getEvaluateNum($uid){
		$evaluate = D('Evaluate');
		$evaluatemap['uid'] = array('eq',$uid);
		$data = $evaluate->field('count(distinct gid) as count')->where($evaluatemap)->find();
		return $data['count'];
	}
	
	function getLocation($uid){
		$member_location = D('Member_location');
		$member_locationmap['uid'] = array('eq',$uid);
		$member_locationmap['type'] = array('eq',1);
		return $member_location->getOne($member_locationmap);
	}
	
	function getFriendsNum($uid){
		$friends = D('Friends');
		$friendsmap['main'] = array('eq',$uid);
		return $friends->getCount($friendsmap);
	}
	//获取关注人的集合
	function getAttentionIds($uid){
		$attention = D('Attention');
		$attentionmap['main'] = array('eq',$uid);
		return explode(',', $attention->getGather($attentionmap,'was'));
	}
	
	//获取好友的集合
	function getFriendsIds($uid){
		$friends = D('Friends');
		$friendsmap['main'] = array('eq',$uid);
		return explode(',', $friends->getGather($attentionmap,'friend'));
	}
	
	function getNearby($latlng,$map = '',$limit = ''){
		$field = 'M.* , (round(6378.137 * 2 * sin(sqrt(pow(sin((radians('.$latlng['lat'].')-radians(ML.`lat`))/2),2) + cos(radians('.$latlng['lat'].'))*cos(radians(ML.`lat`))*pow(sin(((radians('.$latlng['lng'].')-radians(ML.`lng`))/2)),2)))*10000)/10000) as distance';
		$prefix = C('DB_PREFIX');
		if(!empty($map)){
			$map = addPre($map,'M');
			$map['_string'] = '!isNULL(ML.lat)';
			$map['ML.type'] = array('eq',1);
		}
		$data = $this->Table("{$prefix}member as M")->
		join("{$prefix}member_location as ML ON M.id = ML.uid")->
		field($field)->
		where($map)->
		order('distance asc')->
		limit($limit)->
		findAll();
		if(!empty($data)){
			foreach ($data as &$value){
				$value['header'] = $this->getHeader($value['header']);
				$value['attention'] = $this->getAttentionNum($value['id']);
				$value['was_attention'] = $this->getWasAttentionNum($value['id']);
				$value['talk_about'] = $this->getTalk_aboutNum($value['id']);
			}
		}
		return $data;
	}
	
	public function _defaultWhere($map = array()){
		$map['status'] = array('eq',1);
		return $map;
	}

	public function getGoodsNum($uid){
		$goods = D('Goods');
		$goodsmap['promulgator'] = array('eq',$uid);
		$goodsmap['status'] = array('eq',1);
		$goodsmap['audit'] = array('eq',0);
		return $goods->getCount($goodsmap);
	}
}
?>