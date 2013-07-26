<?php
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
				'refund_state'=>array('GetNum'),
				'refund_reason'=>array('Char_cv'),
				'refund_applytime'=>array(''),
				'refundamount'=>array('','toPrice'),
				'refundtime'=>array(''),
				'addtime'=>array('',''),
				'status'=>array('GetNum'),
			);
	//获取订单所有信息
	function getDataAll($map,$limit = ''){
	    $order = D('Order');
	    $goods = D('Goods');
		$comment = D('Comment');
		$member_comment = D('Member_comment');
		$data = $this->getData($map,$limit);
		if($data){
			foreach($data as &$value){
				$value['order_info'] = $order->getInfo($value['oid']);
				$value['good'] = $goods->getOne($value['gid']);
				$value['comment'] = $comment->getOne($value['comment_id']);
				$value['member_comment'] = $member_comment->getOne($value['member_comment_id']);
			}
		}
		return $data;
	}
	
	function getData($map='',$limit='',$order='`id` desc'){
		return parent::getData($map,$limit,$order);	
	}
	function getDetails($oid){
	    $map['oid'] = array('eq',$oid);
	    $goods = D('Goods');
		$comment = D('Comment');
		$member_comment = D('Member_comment');
		$data = $this->getData($map,'','id desc');
		foreach($data as &$value){
		    $value['good'] = $goods->getOne($value['gid']);
			$value['comment'] = $comment->getOne($value['comment_id']);
			$value['member_comment'] = $member_comment->getOne($value['member_comment_id']);
		}
		return $data;
	}
	//获取单个的所有数据
	function getOne($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$order = D('Order');
				$goods = D('Goods');
				$comment = D('Comment');
				$member_comment = D('Member_comment');
				$data['order_info'] = $order->getInfo($data['oid']);
				$data['good'] = $goods->getOne($data['gid']);
				$data['comment'] = $comment->getOne($data['comment_id']);
				$data['member_comment'] = $member_comment->getOne($data['member_comment_id']);
			}
		}else{
			$data = array();
		}
		return $data;
	}
	
	//成功支付后操作
	function succPay($oid){
		$this->setSuccSratus($oid);
		$this->updateCrrnum($oid);
	}
	
	//设置详单的成功状态
	function setSuccSratus($oid){
		$map['oid'] = array('eq',$oid);
		$info = $this->where($map)->setField('status',1);
		if($info === false){
			return false;
		}else{
			return true;
		}
	}
	
	//设置库存
	function updateCrrnum($oid){
		$map['oid'] = array('eq',$oid);
		$data = $this->getDataAll($map);
		$goods = D('Goods');
		$remind = D('Remind');
		$coupon = D('Coupon');
		$member_feed = D('Member_feed');
		foreach ($data as $value){
			//提醒
			$uid = getParent('Goods',$value['gid'],'promulgator');
			$reinfo = $remind->addRemind($uid,$value['uid'],'order',$value['gid']);
			//动态
			$tip = $member_feed->addFeed($value['uid'],'order',$value['gid'],'Goods');
			//发送优惠券
			$coupon->addCoupons($value);
			$goods->setInc('crrnum',"id={$value['gid']}",$value['num']);
			$this->addval($value['id']);
		}
	}
	
	//取消订单
	function invalid($oid){
		$map['oid']=array('eq',$oid);
		$info = $this->where($map)->setField('status',2);
		if($info === false){
			return false;
		}else{
			return true;
		}
	}
	function addval($oid){
	    $config = C('sysconfig');
		$value_log = D('Value_log');
		$member = D('Member');
		$data = $this->getOne($oid);
		if(!empty($data) && $data['status'] == 1){
			$v_lmap['uid'] = array('eq',$data['uid']);
			$v_lmap['content'] = array('eq',"[buy]");
			$v_lmap['rel_id'] = array('eq',$oid);
			$v_lmap['rel_module'] = array('eq',"buy");
			$value_logdata = $value_log->getDataAll($v_lmap);
			if(empty($value_logdata)){
				$tip = $member->addVal($data['uid'],intval($config['site_mb_buycredits'])*$data['num'],"[buy]",$oid,"buy");//购买送积分
			}
			if(!empty($data['good']['promulgator'])){
			    $seller = $data['good']['promulgator'];
				$sv_lmap['uid'] = array('eq',$seller['id']);
				$sv_lmap['content'] = array('eq',"[sell]");
				$sv_lmap['rel_id'] = array('eq',$oid);
				$sv_lmap['rel_module'] = array('eq',"sell");
				$svalue_logdata = $value_log->getDataAll($sv_lmap);
				if(empty($svalue_logdata)){
					$tip = $member->addVal($seller['id'],intval($config['site_mb_sellcredits'])*$data['num'],"[sell]",$oid,"sell");//购买送积分
				}
				if(!empty($seller['inviteid'])){
					$iv_lmap['uid'] = array('eq',$seller['inviteid']);
					$iv_lmap['content'] = array('eq',"[invite_sell]");
					$iv_lmap['rel_id'] = array('eq',$seller['id']);
					$iv_lmap['rel_module'] = array('eq',"invite_sell");
					$ivalue_logdata = $value_log->getDataAll($iv_lmap);
					if(empty($ivalue_logdata)){
						$itip = $member->addVal($seller['inviteid'],$config['site_mb_invitesellcredits'],"[invite_sell]",$seller['id'],"invite_sell");//邀请的好友首次出售成功送积分操作
						return $itip;
					}else return true;
				}
				return true;
			}
			return true;
		}else return true;
	}
}
?>