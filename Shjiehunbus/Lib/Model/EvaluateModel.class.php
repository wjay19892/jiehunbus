<?php
//系统配置
class EvaluateModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'gid'=>array('GetNum'),
		'uid'=>array('GetNum'),
		'odid'=>array('GetNum'),
		'item'=>array('GetNum'),
		'value'=>array('GetNum'),
	);
}
?>