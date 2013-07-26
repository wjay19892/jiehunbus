<?php 
class Loginport{	
	private $appkey='';
	private $appsecret='';
	private $returnUrl='';
	public function Loginport($appkey,$appsecret,$returnUrl){
		$this->appkey = $appkey;
		$this->appsecret = $appsecret;
		$this->returnUrl = $returnUrl;
	}

	public function sina(){
        require_once('Loginport/WeiboAuth.class.php');
        $weiboAuth = new WeiboAuth($this->appkey,$this->appsecret);
        $url= $weiboAuth->getLoginUrl($this->returnUrl);
        return $url;
	}

	public function sinaAuth(){
        require_once('Loginport/WeiboAuth.class.php');
        $weiboAuth = new WeiboAuth($this->appkey,$this->appsecret);
        $access_token = $weiboAuth->getAccessToken($_REQUEST["code"],$this->returnUrl);
        if(!empty($access_token['access_token'])){
            $_SESSION['sina']['access_token'] = $access_token['access_token'];
            if($access_token['uid']){
                $_SESSION['sina']['openid'] = $access_token['uid'];
				$_SESSION['sina']['bind'] = true;
                return $access_token['uid'];
            }
            return false;
        }
        return false;
	}

	public function renren(){
        require_once('Loginport/RenrenAuth.class.php');
        $renrenAuth = new RenrenAuth($this->appkey,$this->appsecret);
        $url= $renrenAuth->getLoginUrl($this->returnUrl);
        return $url;
	}
	
	public function renrenAuth(){
        require_once('Loginport/RenrenAuth.class.php');
        $renrenAuth = new RenrenAuth($this->appkey,$this->appsecret);
        $access_token = $renrenAuth->getAccessToken($_REQUEST["code"],$this->returnUrl);
        if(!empty($access_token['access_token'])){
            $_SESSION['renren']['access_token'] = $access_token['access_token'];
            if($access_token['user']['id']){
                $_SESSION['renren']['openid'] = $access_token['user']['id'];
                return $access_token['user']['id'];
            }
            return false;
        }
        return false;
	}


	public function kaixin(){
        require_once('Loginport/KaixinAuth.class.php');
        $kaixinAuth = new KaixinAuth($this->appkey,$this->appsecret);
        $url= $kaixinAuth->getLoginUrl($this->returnUrl);
        return $url;
	}

	public function kaixinAuth(){
        require_once('Loginport/KaixinAuth.class.php');
        $kaixinAuth = new KaixinAuth($this->appkey,$this->appsecret);
        $access_token = $kaixinAuth->getAccessToken($_REQUEST["code"],$this->returnUrl);
        if(!empty($access_token['access_token'])){
            $_SESSION['kaixin']['access_token'] = $access_token['access_token'];
            $openid = $kaixinAuth->getOpenId($access_token['access_token']);
            if($openid){
                $_SESSION['kaixin']['openid'] = $openid;
                return $openid;
            }
            return false;
        }
        return false;
	}

	public function taobao(){
        require_once('Loginport/TaobaoAuth.class.php');
        $taobaoAuth = new TaobaoAuth($this->appkey,$this->appsecret);
        $url= $taobaoAuth->getLoginUrl($this->returnUrl);
        return $url;
	}
	
	public function taobaoAuth(){
        require_once('Loginport/TaobaoAuth.class.php');
        $taobaoAuth = new TaobaoAuth($this->appkey,$this->appsecret);
        $access_token = $taobaoAuth->getAccessToken($_REQUEST["code"],$this->returnUrl);
        if(!empty($access_token['access_token'])){
            $_SESSION['taobao']['access_token'] = $access_token['access_token'];
            if($access_token['taobao_user_id']){
                $_SESSION['taobao']['openid'] = $access_token['taobao_user_id'];
                return $access_token['taobao_user_id'];
            }
            return false;
        }
        return false;
	}
	
	public function qq(){
        require_once('Loginport/QQAuth.class.php');
        $qqAuth = new QQAuth($this->appkey,$this->appsecret);
        $url= $qqAuth->getLoginUrl($this->returnUrl);
		return $url;
	}
	
	public function qqAuth(){
        require_once('Loginport/QQAuth.class.php');
        $qqAuth = new QQAuth($this->appkey,$this->appsecret);
        $access_token = $qqAuth->getAccessToken($_REQUEST["code"],$this->returnUrl);
        if($access_token){
            $_SESSION['qq']['access_token'] = $access_token;
        }
        $openid = $qqAuth->getOpenId($access_token);
        if($openid){
            $_SESSION['qq']['openid'] = $openid;
			$_SESSION['qq']['bind'] = true;
        }
		return $openid;
	}

    public function baidu(){
        require_once('Loginport/BaiduAuth.class.php');
        $baiduAuth = new BaiduAuth($this->appkey,$this->appsecret);
        $url= $baiduAuth->getLoginUrl($this->returnUrl);
        return $url;
    }

    public function baiduAuth(){
        require_once('Loginport/BaiduAuth.class.php');
        $baiduAuth = new BaiduAuth($this->appkey,$this->appsecret);
        $access_token = $baiduAuth->getAccessToken($_REQUEST["code"],$this->returnUrl);
        if($access_token){
            $_SESSION['baidu']['access_token'] = $access_token;
        }
        $openid = $baiduAuth->getOpenId($access_token);
        if($openid){
            $_SESSION['baidu']['openid'] = $openid;
        }
        return $openid;
    }

    public function wangyi(){
        require_once('Loginport/WangyiAuth.class.php');
        $wangyiAuth = new WangyiAuth($this->appkey,$this->appsecret);
        $url= $wangyiAuth->getLoginUrl($this->returnUrl);
        return $url;
    }

    public function wangyiAuth(){
        require_once('Loginport/WangyiAuth.class.php');
        $wangyiAuth = new WangyiAuth($this->appkey,$this->appsecret);
        $access_token = $wangyiAuth->getAccessToken($_REQUEST["code"],$this->returnUrl);
        if($access_token){
            $_SESSION['wangyi']['access_token'] = $access_token;
        }
        $openid = $wangyiAuth->getOpenId($access_token);
        if($openid){
            $_SESSION['wangyi']['openid'] = $openid;
        }
        return $openid;
    }

	public function alipay(){
		$_SESSION["appid"] = $this->appkey;
		$_SESSION["appkey"] = $this->appsecret;
		$_SESSION["callback"] = $this->returnUrl;
		$aliapy_config['partner']      = $this->appkey;
		$aliapy_config['key']          = $this->appsecret;;
		$aliapy_config['return_url']   = $this->returnUrl;
		$aliapy_config['sign_type']    = 'MD5';
		$aliapy_config['input_charset']= 'utf-8';
		$aliapy_config['transport']    = 'http';
		require_once('Loginport/lib/alipay_service.class.php');
		$anti_phishing_key  = '';
		$exter_invoke_ip = '';
		$parameter = array(
				"service"			=> "alipay.auth.authorize",
				"target_service"	=> 'user.auth.quick.login',
				
				"partner"			=> trim($aliapy_config['partner']),
				"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
				"return_url"		=> trim($aliapy_config['return_url']),
		
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip
		);
		$alipayService = new AlipayService($aliapy_config);
        $html_text = $alipayService->alipay_auth_authorize($parameter);
		$url = $html_text;
		return $url;
	}
	public function alipayAuth(){
		$_SESSION["appid"] = $this->appkey;
		$_SESSION["appkey"] = $this->appsecret;
		$_SESSION["callback"] = $this->returnUrl;
		$aliapy_config['partner']      = $this->appkey;
		$aliapy_config['key']          = $this->appsecret;;
		$aliapy_config['return_url']   = $this->returnUrl;
		$aliapy_config['sign_type']    = 'MD5';
		$aliapy_config['input_charset']= 'utf-8';
		$aliapy_config['transport']    = 'http';
		require_once("Loginport/lib/alipay_notify.class.php");
		$alipayNotify = new AlipayNotify($aliapy_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {//验证成功
			$user_id	= $_GET['user_id'];	//支付宝用户id
			$token		= $_GET['token'];	//授权令牌
		}else {//验证失败
		}
        $result['id'] = $user_id;
		$result['token'] = $token;
		$_SESSION["token"]   = $result["token"];
		
		return $user_id;
	}
}
?>