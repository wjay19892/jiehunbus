<?php
//系统配置
class Expand_groupModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'expand_ids'=>array('Char_cv'),
		'sort'=>array('GetNum'),
		'status'=>array('GetNum'),
	);
}
?>