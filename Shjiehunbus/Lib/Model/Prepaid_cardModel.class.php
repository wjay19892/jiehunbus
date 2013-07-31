<?php
//系统配置
class Prepaid_cardModel extends CommonModel {
	protected $_filter = array(
			'id'=>array('GetNum'),
			'sn'=>array('Char_cv'),
			'pwd'=>array('Char_cv'),
			'cash'=>array('toPrice','toPrice'),
			'starttime'=>array('strtotime','toDateYmd'),
			'endtime'=>array('strtotime','toDateYmd'),
			'status'=>array('GetNum'),
		);
}
?>