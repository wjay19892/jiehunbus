<?php
//系统配置
class ReleaseModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'promulgator'=>array('GetNum'),
				'title'=>array('Char_cv'),
				'category'=>array('GetNum'),
				'region'=>array('GetNum'),
				'num'=>array('GetNum'),
				'price'=>array('toPrice','toPrice'),
				'description'=>array('Char_cv'),
				'name'=>array('Char_cv'),
				'phone'=>array('Char_cv'),
				'mail'=>array('Char_cv'),
				'addtime'=>array('strtotime','toDate'),
				'status'=>array('GetNum'),
			  );
			  
	protected $_validate         =         array(
				array('title','require','标题必须！'), //默认情况下用正则进行验证
			  );

			  

}
?>