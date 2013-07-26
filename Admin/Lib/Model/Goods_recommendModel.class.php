<?php
// 用户模型
class Goods_recommendModel extends CommonModel {

	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'sort'=>array('GetNum'),
		  );

}
?>