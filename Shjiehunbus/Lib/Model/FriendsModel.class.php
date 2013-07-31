<?php
//系统配置
class FriendsModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'main'=>array('GetNum'),
				'friend'=>array('GetNum'),
				'remark'=>array('Char_cv'),
				'addtime'=>array('strtotime','toDate'),
			);

}
?>