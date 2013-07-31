<?php
//系统配置
class Mail_logModel extends CommonModel {
	protected $_filter = array(
			'id'=>array('GetNum'),
			'receive'=>array('Char_cv'),
			'content'=>array('h'),
			'sendtime'=>array('strtotime','toDate'),
			'status'=>array('GetNum'),
	);

}
?>