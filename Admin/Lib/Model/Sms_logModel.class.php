<?php
//系统配置
class Sms_logModel extends CommonModel {
	protected $_filter = array(
			'id'=>array('GetNum'),
			'receive'=>array('Char_cv'),
			'content'=>array('Char_cv'),
			'sendtime'=>array('strtotime','toDate'),
			'status'=>array('GetNum'),
	);

}
?>