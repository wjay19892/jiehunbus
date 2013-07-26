<?php
//系统配置
class Cash_logModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'content'=>array('Char_cv'),
				'val'=>array('toPrice','toPrice'),
                'rel_id'=>array('GetNum'),
				'rel_module'=>array('Char_cv'),
				'addtime'=>array('strtotime','toDate'),
			);

}
?>