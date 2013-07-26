<?php
//系统配置
class AdvertisingModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'position_id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'type'=>array('GetNum'),
		'status'=>array('GetNum'),
		'url'=>array('Char_cv'),
		'click_count'=>array('GetNum'),
		'desc'=>array('Char_cv'),
		'sort'=>array('GetNum'),
		'is_vote'=>array('GetNum'),
	);
}
?>