<?php
//系统配置
class RemindModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'opposite'=>array('GetNum'),
				'content'=>array('Char_cv'),
				'type'=>array('GetNum'),
				'addtime'=>array('strtotime','toDate'),
			);

}
?>