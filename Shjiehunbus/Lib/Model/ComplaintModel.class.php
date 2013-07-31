<?php
//系统配置
class ComplaintModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'gid'=>array('GetNum'),
		'uid'=>array('GetNum'),
		'item'=>array('GetNum'),
		'status'=>array('GetNum'),
	);
}
?>