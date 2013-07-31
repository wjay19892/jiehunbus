<?php
// 配置类型模型
class GroupModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'title'=>array('Char_cv'),
		'status'=>array('GetNum'),
		'sort'=>array('GetNum'),
		'show'=>array('GetNum'),
		'groups_nav_id'=>array('GetNum'),
	);
	protected $_validate = array(
		array('name','require','名称必须'),
		);

	protected $_auto		=	array(
        array('status',1,self::MODEL_INSERT,'string'),
		array('create_time','time',self::MODEL_INSERT,'function'),
		);
}
?>