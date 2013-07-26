<?php
class Talk_aboutModel extends CommonModel {
	
	public function getDataAll($map,$limit,$order = 'id desc'){
		$prefix = C('DB_PREFIX');
		$map = addPre($map,'TA');
		$and = $map?'where '.$this->db->_parseWhere($map):'';
		$limit = $limit?'LIMIT '.$limit:'';
		$sql = "SELECT TA.*,G.title,M.name,A.thumbnail as header FROM `{$prefix}talk_about` as TA left join `{$prefix}goods` as G on TA.gid = G.id left join `{$prefix}member` as M on TA.uid = M.id left join `{$prefix}accessory` as A on M.header = A.id {$and} order by {$order} {$limit}";
		$data = $this->query($sql);
		$thumbnail = __ROOT__.C('sysconfig.site_mb_smallavatar');
		foreach ($data as &$value){
			if($value['header']){
				$value['header'] = __ROOT__.$value['header'];
			}else{
				$value['header'] = $thumbnail;
			}
			$value['accessory'] = $this->getAccessory($value['id']);
			$value['content'] = contentFilter($value['content']);
			if($value['gid']){
				$value['goods_accessory'] = $this->getGoodsAccessory($value['gid']);
			}
			if($value['tid']){
				$value['source'] = $this->getOne($value['tid']);
			}
			$value['member'] = $this->getMember($value['id']);
			$value['label'] = $this->getLable($value['id']);
		}
		
		return $data;
	}
	
	public function getGoodsAccessory($gid){
		$goods = D('Goods');
		return $goods->getAccessory($gid,true);
	}
	
	public function getMember($tid){
		$prefix = C('DB_PREFIX');
		$sql = "SELECT TAR.*,M.name FROM `{$prefix}talk_about_relation` as TAR inner join `{$prefix}member` as M on TAR.uid = M.id and TAR.tid = {$tid}";
		$data = $this->query($sql);
		return $data;
	}
	
	public function getLable($tid){
		$prefix = C('DB_PREFIX');
		$sql = "SELECT LR.*,L.name FROM `{$prefix}label_relation` as LR inner join `{$prefix}label` as L on LR.lid = L.id and LR.tid = {$tid}";
		$data = $this->query($sql);
		return $data;
	}
	
	public function getOne($id){
		if(!is_array($id)){
			$map[$this->getPk()]=array('eq',$id);
		}else{
			$map = $id;
		}
		$data = $this->getDataAll($map,'0,1');
		return $data[0];
	}
	
	//获取商品的附件
	/*
	 * $one = true 只获取一个附件
	* $one = false 获取全部附件
	* */
	function getAccessory($id,$one = false){
		static $talk_about_accessory = array();
		if (isset($talk_about_accessory[$one.'_'.$id])){
			return $talk_about_accessory[$one.'_'.$id];
		}
		$accessory_relation = D('Accessory_relation');
		$map = array(
				'AR.relationid' =>array('eq',$id),
				'AR.table' =>array('eq','Talk_about'),
		);
		$limit = $one?'0,1':'';
		$data = $accessory_relation->getData($map,$limit);
		$data = $one?$data[0]:$data;
		$talk_about_accessory[$one.'_'.$id] = $data;
		return $data;
	}
	
	public function insert($data){
		$time = time();
		$lids = array();
		$labels = array();
		$gid = intval($data['gid']);
		$imgs = $data['imgs'];
		$content = $data['content'];
		preg_match_all("/@([^@^\s^#]+)/i",$content,$arr);
		$member = D('Member');
		foreach ($arr[0] as $key=>$val){
			$content = str_replace($val, '', $content);
			$where['name'] = array('eq',$arr[1][$key]);
			$uids[] = $member->where($where)->getField('id');
		}
		
		$uids = array_unique($uids);
		preg_match_all("/#([^#]+)#/i",$content,$arr);
		$label = D('Label');
		foreach ($arr[0] as $key=>$val){
			$content = str_replace($val, '', $content);
			$tmp['name'] = array('eq',$arr[1][$key]);
			$tmplid = $label->where($tmp)->getField('id');
			if(!$tmplid){
				$labeldata = array(
						'name'=>$arr[1][$key],
						'addtime'=>$time,
				);
				$tmplid = $label->add($labeldata);
			}
			$labels[] = $tmplid;
			unset($tmp,$tmplid,$labeldata);
		}
		
		if(empty($labels)){
			$tmp['name'] = array('eq',L('mood'));
			$tmplid = $label->where($tmp)->getField('id');
			if(!$tmplid){
				$labeldata = array(
						'name'=>L('mood'),
						'addtime'=>$time,
				);
				$tmplid = $label->add($labeldata);
			}
			$labels[] = $tmplid;
			unset($tmp,$tmplid,$labeldata);
		}
		
		$data['content'] = trim($content);
		$data['addtime'] = $time;
		$id = parent::insert($data);
		if($id){
			if(!empty($imgs)){
				$accessory_relation = D('Accessory_relation');
				foreach($imgs as $value){
					$value = intval($value);
					if($value){
						$accessory_relationdata[] = array(
								'accessoryid'=>$value,
								'relationid'=>$id,
								'table'=>'Talk_about',
						);
					}
				}
				if(!empty($accessory_relationdata)){
					$accessory_relation->addAll($accessory_relationdata);
				}
			}
			if(!empty($uids)){
				$talk_about_relation = D('Talk_about_relation');
				foreach($uids as $value){
					$value = intval($value);
					if($value){
						$talk_about_relationdata[] = array(
								'uid'=>$value,
								'tid'=>$id,
						);
					}
				}
				$talk_about_relation->addAll($talk_about_relationdata);
			}
			$prefix = C('DB_PREFIX');
			
			if($gid){
				$c_labels = $this->query("SELECT GC.lids FROM `{$prefix}goods` as G inner join `{$prefix}goods_category` as GC on G.id={$gid} and G.cid = GC.id");
				if(!empty($c_labels[0]['lids'])){
					$lids = explode(',',$c_labels[0]['lids']);
				}
				$labels = $lids;
			}
			
			if(!empty($labels)){
				$label_relation = D('Label_relation');
				foreach ($labels as $value){
					$value = intval($value);
					if($value){
						$label_relation_arr[] = array(
								'lid'=>$value,
								'tid'=>$id,
								);
						$label->setInc('count',"id={$value}");
					}
				}
				$label_relation->addAll($label_relation_arr);
			}
			return $id;
		}else{
			return false;
		}
	}
	
	public function forwarding($data){
		$time = time();
		$tid = $data['tid'];
		$data['addtime'] = $time;
		$source = $this->find($tid);
		if(!empty($source)){
			$data['gid'] = $source['gid'];
			$info = parent::insert($data);
			if($info){
				$this->setInc('forwarding',"id={$tid}");
				$label_relation = D('Label_relation');
				$map['tid'] = array('eq',$tid);
				$label_relationdata = $label_relation->where($map)->findAll();
				if(!empty($label_relationdata)){
					foreach($label_relationdata as &$value){
						$value['tid'] = $info;
					}
					$label_relation->addAll($label_relationdata);
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
		return $info;
	}
}
?>