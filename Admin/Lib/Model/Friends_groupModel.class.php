<?php
//系统配置
class Friends_groupModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'name'=>array('Char_cv'),
			);
}
?>