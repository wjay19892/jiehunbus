<?php
class Member_labelModel extends CommonModel {
	public function getUserLabel($map,$limit=""){
		if(!is_array($map)){
			$map['uid'] = array('eq',$map);
		}
		$map = addPre($map, 'ML');
		$prefix = C('DB_PREFIX');
		$data = $this->Table("{$prefix}member_label as ML")->
		join("{$prefix}label as L ON ML.lid = L.id")->
		field('L.*')->
		where($map)->
		limit($limit)->
		findAll();
		return $data;
	}
}
?>