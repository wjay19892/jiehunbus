<?php
//系统配置
class CollectionModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'remark'=>array('Char_cv'),
				'addtime'=>array('strtotime','toDate'),
				'ispublic'=>array('GetNum'),
				'isfail'=>array('GetNum'),
			);

}
?>