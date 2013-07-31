<?php
// 用户模型
class UserModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'account'=>array('Char_cv'),
		'nickname'=>array('Char_cv'),
		'email'=>array('Char_cv'),
		'remark'=>array('Char_cv'),
		'group_id'=>array('GetNum'),
		'status'=>array('GetNum'),
		'type_id'=>array('GetNum'),
	);
	
	public $_validate	=	array(
		array('account','require','帐号必须'),
		array('password','require','密码必须'),
		array('nickname','require','昵称必须'),
		array('repassword','require','确认密码必须'),
		array('repassword','password','确认密码不一致',self::EXISTS_VAILIDATE,'confirm'),
		array('account','','帐号已经存在',self::EXISTS_VAILIDATE,'unique',self::MODEL_INSERT),
		);

	public $_auto		=	array(
		array('password','pwdHash',self::MODEL_BOTH,'callback'),
		array('create_time','time',self::MODEL_INSERT,'function'),
		array('update_time','time',self::MODEL_UPDATE,'function'),
		);

	protected function pwdHash() {
		if(isset($_POST['password'])) {
			return pwdHash($_POST['password']);
		}else{
			return false;
		}
	}
}
?>