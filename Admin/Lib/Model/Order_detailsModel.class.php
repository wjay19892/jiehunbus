<?php
//系统配置
class Order_detailsModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'oid'=>array('GetNum'),
				'num'=>array('GetNum'),
				'price'=>array('toPrice','toPrice'),
				'total'=>array('toPrice','toPrice'),
				'attr'=>array('Char_cv'),
				'comment_id'=>array('GetNum'),
				'member_comment_id'=>array('GetNum'),
				'refund_state'=>array('GetNum'),
				'refund_reason'=>array('Char_cv'),
				'refund_applytime'=>array('','toDate'),
				'refundamount'=>array('toPrice','toPrice'),
				'refundtime'=>array('','toDate'),
				'addtime'=>array('strtotime','toDate'),
				'status'=>array('GetNum'),
			);

}
?>