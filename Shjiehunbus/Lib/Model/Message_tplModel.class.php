<?php
//系统配置
class Message_tplModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'name'=>array('Char_cv'),
	);
}
?>