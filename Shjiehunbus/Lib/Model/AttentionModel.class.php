<?php
//系统配置
class AttentionModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'main'=>array('GetNum'),
				'was'=>array('GetNum'),
				'updatetime'=>array('strtotime','toDate'),
			);

}
?>