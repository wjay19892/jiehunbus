<?php
//系统配置
class CollectionModel extends CommonModel {
	protected $_auto = array (
		array('addtime','time',1,'function') , // 对password字段在新增的时候使md5函数处理
	);
	
	
}
?>