<?php
//系统配置
class ExpandModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'key'=>array('Char_cv'),
		'default'=>array('Char_cv'),
		'type'=>array('GetNum'),
		'enum'=>array('trim'),
	);
	
    //获取数据
	public function getdata($map,$gid){
		$data = $this->where($map)->order('id asc')->findAll();
		$goods_expand = D('Goods_expand');
		foreach($data as &$v){
		    $where = "gid=".$gid." and aid=".$v['id'];
		    $list =	$goods_expand->where($where)->getField('val');
			$v['val'] = $list;
			unset( $where, $list);
		}
		return $data;
	}
}
?>