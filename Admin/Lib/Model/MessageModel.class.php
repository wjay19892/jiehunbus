<?php
//系统配置
class MessageModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'send'=>array('GetNum'),
				'receive'=>array('GetNum'),
				'content'=>array('Char_cv'),
				'type'=>array('GetNum'),
				'mark'=>array('GetNum'),
				'addtime'=>array('strtotime','toDate'),
	);

}
?>