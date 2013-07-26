<?php
// 用户模型
class CommentModel extends CommonModel {

	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'reviewer'=>array('GetNum'),
				'content'=>array('contentFilter'),
				'type'=>array('GetNum'),
				'addtime'=>array('strtotime','toDate'),
		  );

}
?>