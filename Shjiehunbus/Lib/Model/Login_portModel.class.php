<?php
//系统配置
class Login_portModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'name'=>array('Char_cv'),
				'remark'=>array('Char_cv'),
				'logo'=>array('Char_cv'),
				'appkey'=>array('Char_cv'),
				'appsecret'=>array('Char_cv'),
				'description'=>array('h'),
				'status'=>array('GetNum'),
			);
	protected $_validate         =         array(
				array('name','require','名称必须！'), //默认情况下用正则进行验证
				array('remark','require','英文标识必须！'), //默认情况下用正则进行验证
			  );
}
?>