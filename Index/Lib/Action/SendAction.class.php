<?php
class SendAction extends CommonAction
{
    public function sendSms(){
    	set_time_limit (0);
    	ignore_user_abort(true);
    	$bool = S('sendSms');
		S('sendSms',null);
	    if(!C('sysconfig.site_sms_open')){
		 	return true;
		}
		if($bool){
			$tel = $_REQUEST['tel'];
		 	$msg = $_REQUEST['msg'];
		 	$config = C('sysconfig');
		 	$sms_log = D('Sms_log');
		    import("ORG.Net.Http");
			$msg = urlencode($msg);
			$url = $config['site_sms_sendhttp'];
			$url = str_replace('[tel]', $tel, $url);
			$url = str_replace('[msg]', $msg, $url);
			$data = Http::fsockopen_download($url);
			if (preg_match('/'.$config['site_sms_success'].'/i',$data)){
				$sms_log_data = array(
			 		'receive'=>$tel,
			 		'content'=>urldecode($msg),
			 		'sendtime'=>time(),
			 		'status'=>1,
			 	);
			}else {
				$sms_log_data = array(
			 		'receive'=>$tel,
			 		'content'=>urldecode($msg),
			 		'sendtime'=>time(),
			 		'status'=>0,
			 	);
			}
			$sms_log->insert($sms_log_data);
		}else{
		 	$this->error(L('illegal_operational'));
		}
    }
    
    public function sendMail(){
    	 set_time_limit (0);
    	 ignore_user_abort(true);
    	 $bool = S('sendMail');
		 S('sendMail',null);
    	 if(!C('sysconfig.site_mail_on')){
		 	return false;
		 }
		 if($bool){
		 	 $address = $_REQUEST['address'];
		 	 $header = $_REQUEST['header'];
		 	 $body = $_REQUEST['body'];
		 	 
		 	 $mail_log = D('Mail_log');
			 import ( "ORG.Util.Mail" );
			 $data = array(
			 	'name'=>C('sysconfig.site_smtp_account'),
			 	'password'=>C('sysconfig.site_services_password'),
			 	'smtp'=>C('sysconfig.site_smtp_server'),
			 	'mail'=>C('sysconfig.site_reply_address'),
				'port'=>C('sysconfig.site_smtp_port'),
				'auth'=>C('sysconfig.site_smtp_auth'),
				'ssl'=>C('sysconfig.site_smtp_is_ssl'),
			 );
			 $mail = new Mail();
			 $issmtp=$mail->setMailer($data);
			 if(is_array($address)){
				$receive = implode(',',$address);
			 }else{
				$receive = $address;
			 }
			 if($issmtp){
				 $info = $mail->send($address,$header,$body);
				 
				 if($info){
				 	$mail_log_data = array(
				 		'receive'=>$receive,
				 		'content'=>$body,
				 		'sendtime'=>time(),
				 		'status'=>1,
				 	);
				 }else{
				 	$mail_log_data = array(
				 		'receive'=>$address,
				 		'content'=>$body,
				 		'sendtime'=>time(),
				 		'status'=>0,
				 	);
				 }
			 }else{
			 	$mail_log_data = array(
			 		'receive'=>$receive,
			 		'content'=>$body,
			 		'sendtime'=>time(),
			 		'status'=>0,
			 	);
			 };
			 $mail_log->insert($mail_log_data);
		 }else{
		 	$this->error(L('illegal_operational'));
		 }
    }
}
?>