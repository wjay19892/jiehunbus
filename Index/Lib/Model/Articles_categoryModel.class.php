<?php
// 节点模型
class Articles_categoryModel extends CommonModel {

	function getChild($where){
		$prefix = C('DB_PREFIX');
		if(!empty($where)){
			if(!is_array($where)){
				$map[$this->getPk()] = array('eq',$where);
			}else{
				$map = $where;
			}
			$map = addPre($map,'AC1');
		}
    	$data = $this->Table("{$prefix}articles_category as AC1")->
					  join("{$prefix}articles_category as AC2 ON LOCATE(AC1.id,AC2.path) > 0")->
					  field('AC1.id,group_concat(CAST(AC2.id as char)) as child')->
					  where($map)->
					  group('AC1.id')->
					  findAll();
		return $data;
	}
	
	function getNumCount($map,$effective = 0){
		$join = ($effective == 0)?'INNER':'RIGHT';
		$and = $map?' AND '.$this->db->_parseWhere($map):'';
		$prefix = C('DB_PREFIX');
    	$data = $this->Table("{$prefix}articles as A")->
					  join("{$join} JOIN (SELECT AC1 . * , AC2.id AS child FROM {$prefix}articles_category AS AC1 LEFT JOIN {$prefix}articles_category AS AC2 ON LOCATE( AC1.id, AC2.path ) >0 ) AS C ON A.cid = C.child{$and}")->
					  field('C.*,count( A.cid ) AS count')->
					  group('C.id')->
					  order('C.`path`,C.`sort` desc')->
					  findAll();
		return $data;
	}
	
}
?>