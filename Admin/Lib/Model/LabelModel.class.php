<?php
//系统配置
class LabelModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'count'=>array('GetNum'),
		'addtime'=>array('strtotime','toDate'),
	);
}
?>