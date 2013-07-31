<?php
//系统配置
class GoodsModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'cid'=>array('GetNum'),
				'rid'=>array('GetNum'),
				'egid'=>array('GetNum'),
				'promulgator'=>array('GetNum'),
				'commission_type'=>array('GetNum'),
				'commission'=>array('GetNum'),
				'sort'=>array('GetNum'),
				'title'=>array('Char_cv'),
				'detail'=>array('h'),
				'keywords'=>array('Char_cv'),
				'description'=>array('Char_cv'),
				'longitude'=>array('Char_cv'),
				'latitude'=>array('Char_cv'),
				'original'=>array('toPrice','toPrice'),
				'price'=>array('toPrice','toPrice'),
				'deposit'=>array('toPrice','toPrice'),
				'payment'=>array('GetNum'),
				'num'=>array('GetNum'),
				'onenum'=>array('GetNum'),
				'pre'=>array('Char_cv'),
				'status'=>array('GetNum'),
				'audit'=>array('GetNum'),
				'starttime'=>array('strtotime','toDateYmd'),
				'endtime'=>array('strtotime','toDateYmd'),
	);
			  
	protected $_validate         =         array(
				array('title','require','标题必须！'), //默认情况下用正则进行验证
			  );
	protected $_auto = array (
		array('addtime','time',1,'function') , // 对password字段在新增的时候使md5函数处理
	);

			  

}
?>