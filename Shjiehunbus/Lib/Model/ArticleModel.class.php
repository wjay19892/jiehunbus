<?php
//系统配置
class ArticleModel extends CommonModel {
	protected $_filter = array(
			'id'=>array('GetNum'),
			'title'=>array('Char_cv'),
			'cid'=>array('GetNum'),
			'sort'=>array('GetNum'),
			'content'=>array('h'),
			'keywords'=>array('Char_cv'),
			'description'=>array('Char_cv'),
			'link'=>array('Char_cv'),
			'type'=>array('GetNum'),
			'addtime'=>array('strtotime','toDate'),
			'status'=>array('GetNum'),
	);
}
?>