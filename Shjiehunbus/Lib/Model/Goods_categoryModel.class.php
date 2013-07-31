<?php
// 节点模型
class Goods_categoryModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'pid'=>array('GetNum'),
		'level'=>array('GetNum'),
		'path'=>array('Char_cv'),
		'sort'=>array('GetNum'),
		'label'=>array('Char_cv'),
	);
	protected $_validate	=	array(
		array('name','','分类名称已经存在',self::EXISTS_VAILIDATE,'unique',self::MODEL_INSERT),
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
	
	public function _before_update(&$data,$options){
		$labelarr = explode(',', str_replace('，', ',', $data['label']));
		$label = D('label');
		foreach($labelarr as $value){
			$value = trim($value);
			if(!empty($value)){
				$map['name'] = array('eq',$value);
				$d = $label->where($map)->find();
				if(empty($d)){
					$labeldata = array(
							'name'=>$value,
						);
					$lids[] = $label->add($labeldata);
				}else{
					$lids[] = $d['id'];
				}
			}
			unset($map,$d);
		}
		$data['lids'] = implode(',', $lids);
	}
	
}
?>