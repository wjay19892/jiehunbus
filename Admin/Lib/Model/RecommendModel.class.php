<?php
// 用户模型
class RecommendModel extends CommonModel {

	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'reviewer'=>array('GetNum'),
				'content'=>array('h'),
				'type'=>array('GetNum'),
				'addtime'=>array('strtotime','toDate'),
		  );

}
?>