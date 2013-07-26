<?php
class GoodsModel extends CommonModel {
	
	protected $_filter = array(
			'id'=>array('GetNum'),
			'cid'=>array('GetNum'),
			'rid'=>array('GetNum'),
			'egid'=>array('GetNum'),
			'promulgator'=>array('GetNum'),
			'commission_type'=>array('GetNum'),
			'commission'=>array('GetNum'),
			'sort'=>array('GetNum'),
			'title'=>array('Char_cv'),
			'detail'=>array('h'),
			'keywords'=>array('Char_cv'),
			'description'=>array('Char_cv'),
			'longitude'=>array('Char_cv'),
			'latitude'=>array('Char_cv'),
			'original'=>array('toPrice','toPrice'),
			'price'=>array('toPrice','toPrice'),
			'payment'=>array('GetNum'),
			'num'=>array('GetNum'),
			'onenum'=>array('GetNum'),
			'pre'=>array('Char_cv'),
			'status'=>array('GetNum'),
			'audit'=>array('GetNum'),
			'starttime'=>array('strtotime'),
			'endtime'=>array('strtotime'),
	);
		
	protected $_validate         =         array(
			array('title','require','{%please_input_title}'), //默认情况下用正则进行验证
			array('short_title','require','{%please_input_short_title}'), //默认情况下用正则进行验证
			array('num','require','{%please_input_nums}'), //默认情况下用正则进行验证
			array('tel','require','{%please_input_phone}'), //默认情况下用正则进行验证
			array('tel','isPhone','{%release_validate_isphone}',0,'function'), //默认情况下用正则进行验证
			array('address','require','{%please_input_address}'), //默认情况下用正则进行验证
	);
	
	protected $_auto = array (
			array('addtime','time',1,'function') , // 对password字段在新增的时候使md5函数处理
	);
	
	//获取商品所有信息
	public function getDataAll($map='',$limit='',$order='',$field = '',$having = ''){
		if(empty($order))$order = 'sort desc';
		$expand_group =	D("Expand_group");
		$expand = D('Expand');
		$member = D('Member');
		$data = $this->field($field)->where($map)->order($order)->having($having)->limit($limit)->findAll();
		if(is_array($data)){
			foreach($data as &$value){
				$value['accessory'] = $this->getAccessory($value['id'],true);
				$expand_groupdata =	$expand_group->getOne($value['egid']);
				if(isset($expand_groupdata['expand_ids'])){
					$expandmap['id'] =array('in',$expand_groupdata['expand_ids']);
					$value['expand'] = $expand->getExpand($expandmap,$value['id']);
				}
				$value['promulgator'] = $member->getOne($value['promulgator']);
				$value['comment'] = $this->getCommentNum($value['id']);
				$value['recommend'] = $this->getRecommendNum($value['id']);
				$value['order'] = $this->getOrderNum($value['id']);
			}
		}
		return $data;
	}
	
	public function getData($map,$limit = '',$order = '`sort` desc',$field = ''){
		if(empty($order))$order = '`sort` desc';
		$this->resetMap($map);
		$data = $this->field($field)->where($map)->limit($limit)->order($order)->findAll();
		return $data;
	}
	
	//获取统计值
	function getCount($map,$field = '',$having = ''){
		$this->resetMap($map);
		$data = $this->field($field)->where($map)->having($having)->findAll();
		return count($data);
	}
	
	function getOne($id){
		static $goods_one = array();
		if (isset($goods_one['_'.$id])){
			return $goods_one['_'.$id];
		}
		if($id){
			$map['id'] = array('eq',$id);
			$data = $this->getDetails($map);
			$data = isset($data[0])?$data[0]:false;
			if(!empty($data)){
			    $expand_group =	D("Expand_group");
				$expand = D('Expand');
				$member = D('Member');
				$data['accessory'] = $this->getAccessory($data['id']);
				$expand_groupdata =	$expand_group->getOne($data['egid']);
				if(isset($expand_groupdata['expand_ids'])){
					$expandmap['id'] =array('in',$expand_groupdata['expand_ids']);
					$data['expand'] = $expand->getExpand($expandmap,$data['id']);
				}
				$data['promulgator'] = $member->getOne($data['promulgator']);
				$data['comment'] = $this->getCommentNum($data['id']);
				$data['recommend'] = $this->getRecommendNum($data['id']);
				$data['order'] = $this->getOrderNum($data['id']);
			}
		}
		$goods_one['_'.$id] = $data;
		return $data;
	}
	
	function getDetails($map='',$limit='',$sort='sort desc'){
		static $goods_details = array();
		$k = md5(serialize(array($map,$limit,$sort)));
		if (isset($goods_details['_'.$k])){
			return $goods_details['_'.$k];
		}
		$prefix = C('DB_PREFIX');
		if(!empty($map)){
			$map = addPre($map,'G');
		}
    	$data = $this->Table("{$prefix}goods as G")->
					  join("{$prefix}goods_category as GC ON G.cid = GC.id > 0")->
					  join("{$prefix}region as R ON G.rid = R.id")->
					  field('G.*,GC.name as category_name,R.name as region_name')->
					  where($map)->
					  order($sort)->
					  limit($limit)->
					  findAll();
    	$data = $data?$data:false;
    	$goods_details['_'.$k] = $data;
		return $data;
	}
	//获取条件ID集；
	public function getIds($map){
		$data = $this->where($map)->field('id')->findAll();
		foreach ($data as $val){
			$tem[] = $val['id'];
		}
		$string = implode(',', $tem);
		return $string;
	}
	//获取商品的附件
	/*
	 * $one = true 只获取一个附件
	 * $one = false 获取全部附件
	 * */
	function getAccessory($id,$one = false){
		static $goods_accessory = array();
		if (isset($goods_accessory[$one.'_'.$id])){
			return $goods_accessory[$one.'_'.$id];
		}
		$accessory_relation = D('Accessory_relation');
		$map = array(
			'AR.relationid' =>array('eq',$id),
			'AR.table' =>array('eq','Goods'),
		);
		$limit = $one?'0,1':'';
		$data = $accessory_relation->getData($map,$limit);
		$data = $one?$data[0]:$data;
		$goods_accessory[$one.'_'.$id] = $data;
		return $data;
	}
	
	//获取商品的评价数量
	public function getCommentNum($id){
		static $goods_comment_num = array();
		if (isset($goods_comment_num['_'.$id])){
			return $goods_comment_num['_'.$id];
		}
		$map['gid'] = array('eq',$id);
		$comment = D('Comment');
		$data = $comment->getCount($map);
		$goods_comment_num['_'.$id] = $data;
		return $data;
	}
	
	//获取商品的推荐数量
	public function getRecommendNum($id){
		static $goods_recommend_num = array();
		if (isset($goods_recommend_num['_'.$id])){
			return $goods_recommend_num['_'.$id];
		}
		$map['gid'] = array('eq',$id);
		$recommend = D('Recommend');
		$data = $recommend->getCount($map);
		$goods_recommend_num['_'.$id] = $data;
		return $data;
	}
	
	//获取商品的订单数量
	public function getOrderNum($id){
		static $goods_order_num = array();
		if (isset($goods_order_num['_'.$id])){
			return $goods_order_num['_'.$id];
		}
		$map['gid'] = array('eq',$id);
		$order_details = D('Order_details');
		$data = $order_details->getCount($map);
		$goods_order_num['_'.$id] = $data;
		return $data;
	}
	
	public function getEvaluate($id){
		static $goods_evaluate = array();
		if (isset($goods_evaluate['_'.$id])){
			return $goods_evaluate['_'.$id];
		}
		//获取此商品的 评价
    	$evaluate = D('Evaluate');
    	$evaluate_data = $evaluate->getEvaluateVal($id);
    	$total = intval(C('sysconfig.evaluate_total'));
    	$diff = $total / 10;
    	foreach ($evaluate_data as &$value){
    		$value['avg'] = intval($value['avg']);
    		if(empty($value['avg']))$value['avg'] = $total;
    		$value['star'] = intval($value['avg']/$diff);
    		$total_arr[] = $value['avg'];
    	}
    	$evaluate_total['avg'] = intval(array_sum($total_arr)/count($total_arr));
    	$evaluate_total['star'] = intval($evaluate_total['avg'] / $diff);
    	$data['data'] = $evaluate_data;
    	$data['total'] = $evaluate_total;
    	$goods_evaluate['_'.$id] = $data;
    	return $data;
	}
	
	//获取用户对某产品的购买数量
	public function getUserQuantity($gid,$uid){
		if($gid && $uid){
			$order_details = D('Order_details');
			$order_detailsmap = array(
				'gid'=>array('eq',$gid),
				'uid'=>array('eq',$uid),
				'status'=>array('eq',1),
			);
			$num = $order_details->where($order_detailsmap)->sum('num');
		}else{
			$num = 0;
		}
		return $num;
	}
	
	public function _defaultWhere(){
		$map['audit'] = array('eq',0);
		$map['status'] = array('eq',1);
		return $map;
	}
	
	public function getNearby($latlng,$map = '',$limit = ''){
		$member = D('Member');
		$field = '* , (round(6378.137 * 2 * sin(sqrt(pow(sin((radians('.$latlng['lat'].')-radians(`latitude`))/2),2) + cos(radians('.$latlng['lat'].'))*cos(radians(`latitude`))*pow(sin(((radians('.$latlng['lng'].')-radians(`longitude`))/2)),2)))*10000)/10000) as distance';
		$data = $this->getData($map,$limit,'distance asc',$field);
		if(is_array($data)){
			foreach($data as &$value){
				$value['accessory'] = $this->getAccessory($value['id'],true);
				$value['promulgator'] = $member->getOne($value['promulgator']);
				$value['comment'] = $this->getCommentNum($value['id']);
				$value['recommend'] = $this->getRecommendNum($value['id']);
				$value['evaluate'] = $this->getEvaluate($value['id']);
			}
		}
		return $data;
	}
	
	public function getRecommend($map = array(),$limit = ''){
		$prefix = C('DB_PREFIX');
		if(!empty($map)){
			$map = addPre($map,'G');
		}
		$data = $this->Table("{$prefix}goods_recommend as R")->
		join("{$prefix}goods as G ON G.id = R.gid")->
		field('G.*')->
		where($map)->
		order('`sort` desc')->
		limit($limit)->
		findAll();
		$member = D('Member');
		if(is_array($data)){
			foreach($data as &$value){
				$value['accessory'] = $this->getAccessory($value['id'],true);
				$value['promulgator'] = $member->getOne($value['promulgator']);
				$value['comment'] = $this->getCommentNum($value['id']);
				$value['recommend'] = $this->getRecommendNum($value['id']);
			}
		}
		return $data;
	}
	
	public function price_rangeCount($map){
		$this->resetMap($map);
		$prefix = C('DB_PREFIX');
		$map = addPre($map,'G');
		$and = $map?' AND '.$this->db->_parseWhere($map):'';
		$sql = "SELECT PR.*,count(G.id) as count FROM `{$prefix}price_range` as PR left join `{$prefix}goods` as G on G.price >= PR.min and G.price < PR.max{$and} group by PR.id order by PR.sort desc";
		$data = $this->query($sql);
		return $data;
	}
	
	public function categoryCount($map,$level = 0,$where = array()){
		$this->resetMap($map);
		$goods_category = D('Goods_category');
		$map = addPre($map,'G');
		$where['level'] = array('eq',$level);
		$data = $goods_category->getNumCount($map,1,$where);
		return $data;
	}
	
	public function regionCount($map){
		$this->resetMap($map);
		$region = D('Region');
		$map = addPre($map,'G');
		$data = $region->getNumCount($map,1);
		return $data;
	}
	
	public function resetMap(&$map){
		static $goods_reset = false;
		if(!$goods_reset && empty($map['rid'])){
			$default_region = getDefaultRegion();
			if($default_region){
				$region = D('Region');
				$arr = $region->getChild($default_region['id']);
				$map['rid'] = array('in',$arr[0]['child']);
				$data = $this->where($map)->count();
				if(empty($data)){
					unset($map['rid']);
				}
				$goods_reset = true;
			}
		}
	}
	
}
?>