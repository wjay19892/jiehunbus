<?php
// 节点模型
class RegionModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'pid'=>array('GetNum'),
		'level'=>array('GetNum'),
		'path'=>array('Char_cv'),
		'sort'=>array('GetNum'),
	);
	
	public function _after_insert($data,$options){
		if(empty($data['pid'])){
			$data['level'] = 0;
			$data['path'] = '0,'.$data['id'];
		}else{
			$parent = $this->find($data['pid']);
			if(empty($parent)){
				$data['level'] = 0;
				$data['path'] = '0,'.$data['id'];
			}else{
				$data['level'] = $parent['level'] + 1;
				$data['path'] = $parent['path'].','.$data['id'];
			}
		}
		
		$this->save($data);
	}
}
?>