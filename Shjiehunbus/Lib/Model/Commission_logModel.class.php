<?php
//系统配置
class Commission_logModel extends CommonModel {
	protected $_filter = array(
			'id'=>array('GetNum'),
			'gid'=>array('GetNum'),
			'oid'=>array('GetNum'),
			'value'=>array('GetNum'),
			'addtime'=>array('strtotime','toDate'),
	);

}
?>