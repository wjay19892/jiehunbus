<?php
//系统配置
class Advertising_positionModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'tagname'=>array('Char_cv'),
		'name'=>array('Char_cv'),
		'width'=>array('GetNum'),
		'height'=>array('GetNum'),
		'is_flash'=>array('GetNum'),
	);
}
?>