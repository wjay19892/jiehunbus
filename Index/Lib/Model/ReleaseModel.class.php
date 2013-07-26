<?php
class ReleaseModel extends CommonModel {
	
	protected $_filter = array(
		'id'=>array('GetNum'),
		'promulgator'=>array('GetNum'),
		'category'=>array('GetNum'),
		'region'=>array('GetNum'),
		'num'=>array('GetNum'),
		'price'=>array('toPrice'),
		'status'=>array('GetNum'),
	);
	
	protected $_validate =  array(
		array('title','require',release_validate_title), //默认情况下用正则进行验证
		array('description','require',release_validate_description), //默认情况下用正则进行验证
		array('name','require',release_validate_name), //默认情况下用正则进行验证
		array('mail','require',release_validate_mail), //默认情况下用正则进行验证
		array('phone','require',release_validate_phone), //默认情况下用正则进行验证
		array('phone','isPhone',release_validate_isphone,0,'function'), //默认情况下用正则进行验证
		array('mail','email',Lrelease_validate_email), //默认情况下用正则进行验证
	);
	
	protected $_auto = array (
		array('addtime','time',1,'function') , // 对password字段在新增的时候使md5函数处理
	);
}
?>