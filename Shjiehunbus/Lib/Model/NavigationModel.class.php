<?php
//系统配置
class NavigationModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'title'=>array('Char_cv'),
				'type'=>array('GetNum'),
				'url'=>array('Char_cv'),
				'sort'=>array('GetNum'),
				'action'=>array('Char_cv'),
				'void'=>array('Char_cv'),
				'rid'=>array('GetNum'),
				'isblank'=>array('GetNum'),
				'isdefault'=>array('GetNum'),
				'status'=>array('GetNum'),
	);
	protected $_validate         =         array(
				array('title','require','导航名称必须！'), //默认情况下用正则进行验证
			  );
}
?>