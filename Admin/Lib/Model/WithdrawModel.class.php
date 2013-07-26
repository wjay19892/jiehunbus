<?php
//系统配置
class WithdrawModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'uid'=>array('GetNum'),
		'cash'=>array('toPrice','toPrice'),
		'bank_id'=>array('Char_cv'),
		'realname'=>array('Char_cv'),
		'bank_card'=>array('Char_cv'),
		'remark'=>array('Char_cv'),
		'addtime'=>array('strtotime','toDate'),
		'status'=>array('GetNum'),
	);
}
?>