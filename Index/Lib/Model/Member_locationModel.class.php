<?php
//系统配置
class Member_locationModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'address'=>array('Char_cv'),
				'lat'=>array('Char_cv'),
				'lng'=>array('Char_cv'),
				'type'=>array('GetNum'),
	);
}
?>