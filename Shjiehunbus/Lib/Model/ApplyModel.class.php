<?php
//系统配置
class ApplyModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'name'=>array('Char_cv'),
		'fz_name'=>array('Char_cv'),
		'companyname'=>array('GetNum'),
		'logo'=>array('Char_cv'),
		'tel'=>array('Char_cv'),
		'opening'=>array('Char_cv'),
		'type'=>array('Char_cv'),
		'characteristic'=>array('Char_cv'),
		'services'=>array('Char_cv'),
		'address'=>array('Char_cv'),
		'longitude'=>array('Char_cv'),
		'latitude'=>array('Char_cv'),
		'zoom'=>array('Char_cv'),
		'addtime'=>array('','toDate'),
		'status'=>array('Char_cv'),
	);
}
?>