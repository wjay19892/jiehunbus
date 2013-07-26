<?php
//系统配置
class Login_logModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'ip'=>array('Char_cv'),
				'address'=>array('Char_cv'),
				'addtime'=>array('strtotime','toDate'),
			);

}
?>