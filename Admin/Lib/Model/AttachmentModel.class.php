<?php
//系统配置
class AttachmentModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'key'=>array('Char_cv'),
		'default'=>array('Char_cv'),
		'type'=>array('GetNum'),
		'enum'=>array('trim'),
	);
	//获取数据
	public function getdata($uid){
		$data = $this->order('id asc')->findAll();
		$member_attachment = D ('Member_attachment');
		foreach($data as &$v){
		    $where = "uid=".$uid." and aid=".$v['id'];
		    $list =	$member_attachment->where($where)->getField('val');
			$v['val'] = $list;
			unset( $where, $list);
		}
		return $data;
	}
}
?>