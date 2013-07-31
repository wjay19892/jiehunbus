<?php
//系统配置
class OrderModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'sn'=>array('Char_cv'),
				'uid'=>array('GetNum'),
				'phone'=>array('Char_cv'),
				'fee'=>array('toPrice','toPrice'),
				'incharge'=>array('toPrice','toPrice'),
				'total'=>array('toPrice','toPrice'),
				'money_status'=>array('GetNum'),
				'paytype'=>array('Char_cv'),
				'addtime'=>array('strtotime','toDate'),
				'status'=>array('GetNum'),
			);
			  
	protected $_validate         =         array(
				array('sn','','订单号不能重复！',self::EXISTS_VAILIDATE,'unique',self::MODEL_BOTH), //默认情况下用正则进行验证
			);

}
?>