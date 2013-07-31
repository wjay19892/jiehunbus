<?php
//系统配置
class Talk_aboutModel extends CommonModel {
	protected $_filter = array(
			'id'=>array('GetNum'),
			'uid'=>array('GetNum'),
			'content'=>array('Char_cv'),
			'comment'=>array('GetNum'),
			'forwarding'=>array('GetNum'),
			'gid'=>array('GetNum'),
			'addtime'=>array('strtotime','toDate'),
			'likes'=>array('GetNum'),
	);
	
}
?>