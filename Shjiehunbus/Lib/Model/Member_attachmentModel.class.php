<?php
//系统配置
class Member_attachmentModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'aid'=>array('GetNum'),
	);
}
?>