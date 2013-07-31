<?php
//系统配置
class CommissionModel extends CommonModel {
	protected $_filter = array(
			'id'=>array('GetNum'),
			'lid'=>array('GetNum'),
			'type'=>array('GetNum'),
			'value'=>array('GetNum'),
	);
	
}
?>