<?php
// 用户模型
class Comment_replyModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'cid'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'reviewer'=>array('GetNum'),
				'content'=>array('contentFilter'),
				'type'=>array('GetNum'),
				'addtime'=>array('strtotime','toDate'),
		  );

}
?>