<?php
class OrderModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'sn'=>array('Char_cv'),
				'uid'=>array('GetNum'),
				'phone'=>array('Char_cv'),
				'fee'=>array('toPrice','toPrice'),
				'incharge'=>array('toPrice','toPrice'),
				'total'=>array('toPrice','toPrice'),
				'money_status'=>array('GetNum'),
				'paytype'=>array('Char_cv'),
				'addtime'=>array('',''),
				'status'=>array('GetNum'),
			);
	//获取订单所有信息
	function getDataAll($map,$limit){
		$member = D('Member');
		$order_details = D('Order_details');
		$data = $this->getData($map,$limit,'id desc');
		foreach($data as &$value){
			$value['orderer'] = $member->getOne($value['uid']);
			$value['order_details'] = $order_details->getDetails($value['id']);
		}
		return $data;
	}
	
	//获取单个的所有数据
	function getOne($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$member = D('Member');
				$order_details = D('Order_details');
				$data['orderer'] = $member->getOne($data['uid']);
				$data['order_details'] = $order_details->getDetails($data['id']);
			}
		}else{
			$data = array();
		}
		return $data;
	}
	//获取单个的所有数据
	function getInfo($id){
		if($id){
			$data = $this->find($id);
			if(!empty($data)){
				$member = D('Member');
				$data['orderer'] = $member->getOne($data['uid']);
			}
		}else{
			$data = array();
		}
		return $data;
	}
	
	//生成订单号
	public function produceSn(){
		do {
			$string = rand_string(4);
			$sn = 'PA'.$string.date('Ymd');
			$sn = str_replace('.', '', $sn);
			$map['sn'] = array('eq',$sn);
			$tmp = $this->isExist($map);
		}while ($tmp);
		return $sn;
	}
	
	public function succPay($info){
		if(is_array($info)){
			$map = array(
				'sn'=>array('eq',$info['sn']),
				'status'=>array('eq',0),
			);
			$orderdata = $this->where($map)->find();
			//商品存在
			if($orderdata){
				//应付金额也正确
				if($orderdata['cope'] == $info['cope']){
					$updata = array(
						'id'=>$orderdata['id'],
						'incharge'=>$orderdata['incharge'] + $orderdata['cope'],
						'cope'=>0,
						'money_status'=>2,
						'status'=>1,
					);
					$this->save($updata);
					$this->order_addval($orderdata['id']);
					$this->payment_sms($orderdata['id']);
					$this->payment_mail($orderdata['id']);
					$order_details = D('Order_details');
					$order_details->succPay($orderdata['id']);
					
				}
			}
		}
	}
	
	public function invalid($oid){
		$orderdata = $this->find($oid);
		if($orderdata['incharge'] > 0){
			$member = D('Member');
	 		$member->setInc('cash',"id={$orderdata['uid']}",toPrice($orderdata['incharge']));
	 		$cash_log = D('Cash_log');
	 		$cash_logdata = array(
				'uid'=>$orderdata,
				'val'=>$orderdata['incharge'],
				'content'=>"[invalid]{$orderdata['sn']}",
	 			'rel_id'=>$oid,
				'rel_module'=>'Order',
	 			'addtime'=>time(),
			);
			$cash_log->insert($cash_logdata);
		}
		$data = array(
			'id'=>$oid,
			'status'=>2,
			'money_status'=>4,
		);
		$order_details = D('Order_details');
		$order_details->invalid($oid);
		$this->save($data);
	}
	//收款短信通知
	function payment_sms($oid) {
		$config = C('sysconfig');
		if($config['site_sendsms_pay'] == 1){
		    $orderdata = $this->getOne($oid);
			if($orderdata['money_status'] == 2 && $orderdata['status'] == 1) {
			    $username = $orderdata['orderer']['name'];
				$message_tpl = D('Message_tpl');
				$msg = $message_tpl->getBody('paymentsms'); //选择模板
				$msg = str_replace('[user]',$username, $msg);
				$msg = str_replace('[webname]',$config['site_name'], $msg);
				$msg = str_replace('[order_sn]',$orderdata['sn'], $msg);
				$msg = str_replace('[money]',$orderdata['total'], $msg);
		        if(empty($orderdata['phone'])){
				    $phone = $orderdata['orderer']['phone'];
				}else{
					$phone = $orderdata['phone'];
				}
				if(!isPhone($phone)) return true;//没手机
				$info = sendsms($phone,$msg);
				return $info;
			}else{
		        return true;//订单状态不对。
		    }
		
		}else{
		    return true;//网站关闭了收款短信通知功能。
		}
	}
    //收款邮箱通知
	function payment_mail($oid) {
		$config = C('sysconfig');
		if($config['site_sendmail_pay'] == 1){
		    $orderdata = $this->getOne($oid);
			if($orderdata['money_status'] == 2 && $orderdata['status'] == 1) {
				$mail = $orderdata['orderer']['mail'];
				$username = $orderdata['orderer']['name'];
				
				$header = '订单支付成功邮件通知';
				$header = $config['site_name'].$header;
				
				$message_tpl = D('Message_tpl');
				$body = $message_tpl->getBody('paymentmail'); //选择模板
				$body = str_replace('[user]',$username, $body);
				$body = str_replace('[webname]',$config['site_name'], $body);
				$body = str_replace('[order_sn]',$orderdata['sn'], $body);
				$body = str_replace('[money]',$orderdata['total'], $body);
				$body = str_replace('[website]',$config['site_url'], $body);
	
				$info = sendMail($mail,$header,$body);
				return $info;
			}else{
		        return true;//订单状态不对。
		    }
			
		}else{
		    return true;//网站关闭了收款邮箱通知功能。
		}
	}
	//邀请的好友首次购买成功送积分操作
	function order_addval($oid){
	    $config = C('sysconfig');
	    $member = D('Member');
		$value_log = D('Value_log');
		$orderdata = $this->getOne($oid);
		if($orderdata['money_status'] == 2 && $orderdata['status'] == 1) {
			if(!empty($orderdata['orderer']['inviteid'])){
				$iv_lmap['uid'] = array('eq',$orderdata['orderer']['inviteid']);
				$iv_lmap['content'] = array('eq',"[invite_buy]");
				$iv_lmap['rel_id'] = array('eq',$orderdata['uid']);
				$iv_lmap['rel_module'] = array('eq',"invite_buy");
				$ivalue_logdata = $value_log->getDataAll($iv_lmap);
				if(empty($ivalue_logdata)){
					$itip = $member->addVal($orderdata['orderer']['inviteid'],$config['site_mb_invitebuycredits'],"[invite_buy]",$orderdata['uid'],"invite_buy");
					return $itip;
				}else{
					return true;
				}
			}else{
				return true;//没有邀请人
			}
		}else{
		    return true;//订单状态不对。
	    }
	}
}
?>