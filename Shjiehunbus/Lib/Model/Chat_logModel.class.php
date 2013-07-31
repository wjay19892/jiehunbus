<?php
//系统配置
class Chat_logModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'send'=>array('GetNum'),
				'receive'=>array('GetNum'),
				'content'=>array('contentFilter'),
				'addtime'=>array('strtotime','toDate'),
			);

}
?>