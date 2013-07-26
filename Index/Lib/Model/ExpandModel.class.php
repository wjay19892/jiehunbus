<?php
//系统配置
class ExpandModel extends CommonModel {
	//获取扩展数据
	public function getExpand($map,$gid){	
		if(!empty($map)){
			$map = addPre($map,'E');
		}
		if(!empty($gid)){
			$map['GE.gid'] = array('eq',$gid);
		}
		$prefix = C('DB_PREFIX');
		$data = $this->Table("{$prefix}expand as E")->
				join("{$prefix}goods_expand as GE ON GE.aid = E.id")->
				field('E.*,GE.val as val')->
				where($map)->findAll();
		return $data;
	}
}
?>