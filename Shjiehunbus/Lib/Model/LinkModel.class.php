<?php
//系统配置
class LinkModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'url'=>array('Char_cv'),
		'type'=>array('GetNum'),
		'logo'=>array('Char_cv'),
		'status'=>array('GetNum'),
		'sort'=>array('GetNum'),
		'desc'=>array('Char_cv'),
	);
}
?>