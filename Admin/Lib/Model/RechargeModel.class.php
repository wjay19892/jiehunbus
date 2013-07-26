<?php
//系统配置
class RechargeModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'uid'=>array('GetNum'),
		'cash'=>array('toPrice','toPrice'),
		'bank_id'=>array('Char_cv'),
		'addtime'=>array('strtotime','toDate'),
		'status'=>array('GetNum'),
	);
}
?>