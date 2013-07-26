<?php
// 角色模块
class Accessory_relationModel extends CommonModel {
	public function getData($map){
		$prefix = C('DB_PREFIX');
    	$data = $this->Table("{$prefix}accessory_relation as AR")->
					  join("{$prefix}accessory as A ON AR.accessoryid = A.id")->
					  field('AR.*,A.type,A.type,A.origin,A.path,A.thumbnail,A.size,A.uploadtime')->where($map)->
					  order('AR.id asc')->
					  findAll();
		return $data;
	}
}
?>