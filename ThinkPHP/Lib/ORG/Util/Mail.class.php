<?php 
//邮件发送类
class Mail{
	
	private $phpmailer; //phpmailer 
	
	public function __construct($data){
		include_once 'phpmailer/class.phpmailer.php';
		$this->phpmailer = new PHPMailer(true);
		//$this->setMailer($data);
	}
	
	//设置发件人
	public function setMailer($data){
		if (empty($data)){
			return false;
		}else {
			//验证数组键名是否存在
			$info = array_key_exists('name',$data);
			$info = array_key_exists('password',$data) && $info;
			$info = array_key_exists('smtp',$data) && $info;
			$info = array_key_exists('mail',$data) && $info;
			$info = array_key_exists('port',$data) && $info;
			$info = array_key_exists('auth',$data) && $info;
			$info = array_key_exists('ssl',$data) && $info;
			if ($info){
				$this->phpmailer->CharSet = 'utf-8';
				$this->phpmailer->SetLanguage('zh_cn');//设置语言为简体中文
		   		$this->phpmailer->IsSMTP();
		   		$this->phpmailer->IsHTML(true);
		   		$this->phpmailer->ClearAddresses();
		   		$this->phpmailer->ClearReplyTos();
		   		$this->phpmailer->ClearAllRecipients();
		   		$this->phpmailer->ClearCustomHeaders();

				$this->phpmailer->From = $data['mail'];
				$this->phpmailer->FromName = $data['mail'];
				$this->phpmailer->Host = $data['smtp'];
				$this->phpmailer->Port = $data['port'];
				$this->phpmailer->Username = $data['name'];
				$this->phpmailer->Password = $data['password'];
				$this->phpmailer->AddReplyTo($data['mail']);
				
				if ($data['auth']){
					$this->phpmailer->SMTPAuth = true;
				}else {
					$this->phpmailer->SMTPAuth = false;
				}
				
				if ($data['ssl']){
					$this->phpmailer->SMTPSecure = 'ssl';
				}else {
					$this->phpmailer->SMTPSecure = '';
				}
				return true;
			}else{
			    return false;	
			}
		}
	}
	
	//发送邮件
	public function send($address,$header,$body){
		$this->phpmailer->ClearAddresses();
   		$this->phpmailer->ClearAllRecipients();
   		$this->phpmailer->ClearCustomHeaders();
   		
		$this->phpmailer->Subject = $header;
		$this->phpmailer->Body = $body;
		if(is_array($address)){
			foreach($address as $val){
				$this->phpmailer->AddAddress($val);
			}
		}else{
			$this->phpmailer->AddAddress($address);
		}
		try {
			$info = $this->phpmailer->Send();
		} catch (Exception $e) {
			return $e->getMessage();
		}
		if ($info){
			return true;
		}else {
			return false;
		}
	}
}
?>