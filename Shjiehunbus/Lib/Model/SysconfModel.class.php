<?php
//系统配置
class SysconfModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'key'=>array('Char_cv'),
		'name'=>array('Char_cv'),
		'is_show'=>array('GetNum'),
		'group_id'=>array('GetNum'),
		'list_type'=>array('GetNum'),
		'status'=>array('GetNum'),
		'sort'=>array('GetNum'),
	);
}
?>