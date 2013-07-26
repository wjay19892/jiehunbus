<?php
//系统配置
class Sysconf_groupModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'status'=>array('GetNum'),
		'sort'=>array('GetNum'),
	);
}
?>