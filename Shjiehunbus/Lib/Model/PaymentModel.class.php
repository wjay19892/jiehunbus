<?php
//系统配置
class PaymentModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'name'=>array('Char_cv'),
				'mark'=>array('Char_cv'),
				'description'=>array('Char_cv'),
				'logo'=>array('Char_cv'),
				'fee'=>array('toPrice','toPrice'),
				'feetype'=>array('GetNum'),
				'merchant'=>array('Char_cv'),
				'account'=>array('Char_cv'),
				'key'=>array('Char_cv'),
				'sort'=>array('GetNum'),
				'status'=>array('GetNum'),
			);
	protected $_validate         =         array(
				array('name','require','名称必须！'), //默认情况下用正则进行验证
				array('mark','require','英文标识必须！'), //默认情况下用正则进行验证
			  );
}
?>