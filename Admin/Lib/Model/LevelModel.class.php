<?php
//系统配置
class LevelModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'max'=>array('GetNum'),
		'min'=>array('GetNum'),
		'status'=>array('GetNum'),
	);
	
	protected $_validate         =         array(
				array('name','require','级别名称必须！'), //默认情况下用正则进行验证
	);
}
?>