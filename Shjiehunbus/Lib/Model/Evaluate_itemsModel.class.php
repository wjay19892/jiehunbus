<?php
//系统配置
class Evaluate_itemsModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'sort'=>array('GetNum'),
	);
}
?>