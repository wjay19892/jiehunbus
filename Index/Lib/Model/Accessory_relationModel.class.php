<?php
// 角色模块
class Accessory_relationModel extends CommonModel {
	//获取关系附件
	public function getData($map,$limit){
		$prefix = C('DB_PREFIX');
    	$data = $this->Table("{$prefix}accessory_relation as AR")->
					  join("{$prefix}accessory as A ON AR.accessoryid = A.id")->
					  field("AR.*,A.type,A.title,CONCAT('".__ROOT__."',A.origin) as origin,CONCAT('".__ROOT__."',A.path) as path,CONCAT('".__ROOT__."',A.thumbnail) as thumbnail,A.size,A.uploadtime,A.thumbnail_width,A.thumbnail_height,A.path_width,A.path_height,A.origin_width,A.origin_height")->where($map)->
					  limit($limit)->
					  order('AR.id asc')->
					  findAll();
		
		return $data;
	}
}
?>