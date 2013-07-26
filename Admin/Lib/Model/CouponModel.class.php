<?php
//系统配置
class CouponModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'promulgator'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'oid'=>array('GetNum'),
				'sn'=>array('Char_cv'),
				'pass'=>array('Char_cv'),
				'status'=>array('GetNum'),
				'starttime'=>array('strtotime','toDateYmd'),
				'endtime'=>array('strtotime','toDateYmd'),
				'addtime'=>array('strtotime','toDate'),
			);
			  
	protected $_validate         =         array(
				array('gid','require','商品ID必须！'), //默认情况下用正则进行验证
				array('sn','','序号不能重复！',self::EXISTS_VAILIDATE,'unique',self::MODEL_BOTH), //默认情况下用正则进行验证
			);

}
?>