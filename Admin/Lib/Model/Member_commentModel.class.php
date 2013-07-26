<?php
// 用户模型
class Member_commentModel extends CommonModel {

	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'reviewer'=>array('GetNum'),
				'content'=>array('h'),
				'type'=>array('GetNum'),
				'addtime'=>array('strtotime','toDate'),
		  );

}
?>