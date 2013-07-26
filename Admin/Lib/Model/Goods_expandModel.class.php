<?php
//系统配置
class Goods_expandModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'aid'=>array('GetNum'),
	);
}
?>