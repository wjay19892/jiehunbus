<?php
//系统配置
class CouponModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'gid'=>array('GetNum'),
				'promulgator'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'oid'=>array('GetNum'),
				'sn'=>array('Char_cv'),
				'pass'=>array('Char_cv'),
				'starttime'=>array('GetNum'),
				'endtime'=>array('GetNum'),
				'consume_time'=>array('GetNum'),
				'addtime'=>array('','toDate'),
			);
	protected $_auto = array ( 
	    array('bout','0'),  // 新增的时候把bout字段设置为0
		array('addtime','time',1,'function'), // 对addtime字段在新增的时候写入当前时间戳
		array('status','0'),  // 新增的时候把status字段设置为1
	);
	//获取多个
	function getDataAll($map=array(),$limit=''){
	    $goods = D('Goods');
		$member = D('Member');
		$data = $this->getData($map,$limit,'id desc');
		foreach($data as &$value){
		    $value['good'] = $goods->getOne($value['gid']);
			$value['seller'] = $member->getOne($value['promulgator']);
			$value['buyer'] = $member->getOne($value['uid']);
		}
		return $data;
	}
	//获取用户好友请求数量
	function getCount($map=array()){
		return $this->where($map)->count();
	}
	//获取单个
	function getOne($id){
		if($id){
			if(is_array($id)){
				$data = $this->where($id)->find();
			}else{
				$data = $this->find($id);
			}
			if(!empty($data)){
				$goods = D('Goods');
				$member = D('Member');
				$data['good'] = $goods->getOne($data['gid']);
				$data['seller'] = $member->getOne($data['promulgator']);
				$data['buyer'] = $member->getOne($data['uid']);	
			}
		}else{
			$data = array();
		}
		return $data;
	}
	/**
	 * 增加优惠券
	 * @param array $data  订单详情数组数据
	*/
	function addCoupons($data){
	    $config = C('sysconfig');
		$count =$data['num'];
		for ($i = 0; $i < $count; $i++){
		    $coupondata =array();
			$coupondata['gid'] = $data['gid'];
			$coupondata['promulgator'] = $data['good']['promulgator']['id'];
			$coupondata['uid'] = $data['uid'];
			$coupondata['oid'] = $data['id'];
			$coupondata['sn'] = $this->produceSn($data['gid'],$data['good']['pre']);
			$coupondata['pass'] = rand_string(6,1);
			$coupondata['starttime'] = $data['good']['starttime'];
			$coupondata['endtime'] = $data['good']['endtime'];
			$tip = $this->insert($coupondata);
			if($tip){
				if($config['site_sendsms_coupon_auto']==1 && $config['site_sendsms_coupon']==1)$this->sms_coupon($coupondata);
				if($config['site_sendmail_coupon']==1)$this->mail_coupon($coupondata);
			}
		}
	
	}
	//生成放优惠券券号
	public function produceSn($gid,$prefix=""){
		do {
			$string = rand_string(8);
			$sn = $prefix.$string;
			$map['sn'] = array('eq',$sn);
			$map['gid'] = array('eq',$gid);
			$tmp = $this->isExist($map);
		}while ($tmp);
		return $sn;
	}
	//短信发送优惠券
	function sms_coupon($data, $phone=null) {
		$config = C('sysconfig');
		if($config['site_sendsms_coupon'] == 1){
			if($data['status'] == 1 || $data['endtime'] < strtotime(date('Y-m-d'))) {
				return -2;//此优惠券已失效。
			}
		    if($data['bout']>intval($config['site_sendsms_coupon_num'])){
			    return -3;//此优惠券发送次数过多，请联系管理员。
			}
			if(!isPhone($phone)){
			    $order_details = D('Order_details');
				$o_dsdata = $order_details->getOne($data['oid']);
				$phone = getParent('Order',$o_dsdata['oid'],'phone');
				if (!isPhone($phone)) {
					$phone = getParent('Member',$data['uid'],'phone');
				}
			}
			if (!isPhone($phone)) {
				return -4;//请设置合法的手机号码，以便接受短信。
			}
			$username = getParent('Member',$data['uid'],'name');
			$goodname = getParent('Goods',$data['gid'],'short_title');
			$starttime =toDate($data['starttime'],'Y-m-d');
			$endtime = toDate($data['endtime'],'Y-m-d');
			
			$message_tpl = D('Message_tpl');
			$msg = $message_tpl->getBody('smscoupon'); //选择模板
			$msg = str_replace('[webname]',$config['site_name'], $msg);
			$msg = str_replace('[user]',$username, $msg);
			$msg = str_replace('[goodname]',$goodname, $msg);
			$msg = str_replace('[bondname]',$config['site_couponname'], $msg);
			$msg = str_replace('[sn]',$data['sn'], $msg);
			$msg = str_replace('[pw]',$data['pass'], $msg);
			$msg = str_replace('[starttime]',$starttime, $msg);
			$msg = str_replace('[endtime]',$endtime, $msg);
			
			$info = sendsms($phone,$msg);
			if($info)$this->setInc('bout',"sn ='".$data['sn']."' and gid =".$data['gid'],1);
			return $info;
		}else{
		    return -1;//网站关闭了优惠券短信通知功能。
		}
	}
    //邮箱发送优惠券
	function mail_coupon($data) {
		$config = C('sysconfig');
		if($config['site_sendmail_coupon'] == 1){
			if($data['status'] == 1 || $data['endtime'] < strtotime(date('Y-m-d'))) {
				return -2;//此优惠券已失效。
			}
			$mail = getParent('Member',$data['uid'],'mail');
			$username = getParent('Member',$data['uid'],'name');
			$starttime =toDate($data['starttime'],'Y-m-d');
			$endtime = toDate($data['endtime'],'Y-m-d');
			
	        $goods = D('Goods');
			$gooddata = $goods->getOne($data['gid']);
			
			$header = $config['site_couponname'].L('coupon_mail_coupon_header');
		    $header = $config['site_name'].$header;
			
			$message_tpl = D('Message_tpl');
			$body = $message_tpl->getBody('mailcoupon'); //选择模板
			$body = str_replace('[webname]',$config['site_name'], $body);
			$body = str_replace('[user]',$username, $body);
			$body = str_replace('[goodname]',$gooddata['title'], $body);
			$body = str_replace('[bondname]',$config['site_couponname'], $body);
			$body = str_replace('[sn]',$data['sn'], $body);
			$body = str_replace('[pw]',$data['pass'], $body);
			$body = str_replace('[tel]',$gooddata['tel'], $body);
			$body = str_replace('[address]',$gooddata['address'], $body);
			$body = str_replace('[starttime]',$starttime, $body);
			$body = str_replace('[endtime]',$endtime, $body);

			$info = sendMail($mail,$header,$body);
			return $info;
		}else{
		    return -1;//网站关闭了优惠券邮件通知功能。
		}
	}
	//优惠券消费短信通知
	function consume_sms($id) {
		$config = C('sysconfig');
		if($config['site_sendsms_usecoupon'] == 1){
		    $data = $this->getOne($id);
			if($data['status'] == 1 && !empty($data['consume_time'])) {
			    $username = $data['buyer']['name'];
				$consume_time = toDate($data['consume_time']);
				$message_tpl = D('Message_tpl');
				$msg = $message_tpl->getBody('couponuse_sms'); //选择模板
				$msg = str_replace('[user]',$username, $msg);
				$msg = str_replace('[webname]',$config['site_name'], $msg);
				$msg = str_replace('[bondname]',$config['site_couponname'], $msg);
				$msg = str_replace('[sn]',$data['sn'], $msg);
				$msg = str_replace('[time]',$consume_time, $msg);
		        
				$order_details = D('Order_details');
				$o_dsdata = $order_details->getOne($data['oid']);
				$phone = getParent('Order',$o_dsdata['oid'],'phone');
				if(!isPhone($phone)){
					$phone = $data['buyer']['phone'];
				}
				if(!isPhone($phone)) return true;//没手机
				$info = sendsms($phone,$msg);
				return $info;
			}else{
		        return true;//优惠券状态不对。
		    }
		
		}else{
		    return true;//网站关闭了优惠券消费短信通知功能。
		}
	}
    //优惠券消费邮箱通知
	function consume_mail($id) {
		$config = C('sysconfig');
		if($config['site_sendmail_usecoupon'] == 1){
		    $data = $this->getOne($id);
			if($data['status'] == 1 && !empty($data['consume_time'])) {
				$mail = $data['buyer']['mail'];
				$username = $data['buyer']['name'];
				$consume_time = toDate($data['consume_time']);
				
				$header = $config['site_couponname'].'消费邮件通知';
				$header = $config['site_name'].$header;
				
				$message_tpl = D('Message_tpl');
				$body = $message_tpl->getBody('couponuse_mail'); //选择模板
				$body = str_replace('[user]',$username, $body);
				$body = str_replace('[webname]',$config['site_name'], $body);
				$body = str_replace('[bondname]',$config['site_couponname'], $body);
				$body = str_replace('[sn]',$data['sn'], $body);
				$body = str_replace('[time]',$consume_time, $body);
				$body = str_replace('[website]',$config['site_url'], $body);
	
				$info = sendMail($mail,$header,$body);
				return $info;
			}else{
		        return true;//优惠券状态不对。
		    }
		
		}else{
		    return true;//网站关闭了优惠券消费邮箱通知功能。
		}
	}
}
?>