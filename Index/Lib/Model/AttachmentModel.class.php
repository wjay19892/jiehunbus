<?php
//系统配置
class AttachmentModel extends CommonModel {
	//获取数据
	public function getExpand($uid){
		if(!empty($uid)){
			$map['MA.uid'] = array('eq',$uid);
		}
		$and = $map?' AND '.$this->db->_parseWhere($map):'';
		$prefix = C('DB_PREFIX');
		$data = $this->Table("{$prefix}attachment as A")->
		join("{$prefix}member_attachment as MA ON MA.aid = A.id {$and}")->
		field('A.*,MA.val as val')->findAll();
		return $data;
	}
}
?>