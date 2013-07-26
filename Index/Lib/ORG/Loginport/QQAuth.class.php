<?php
include_once('Auth.class.php');
class QQAuth extends Auth{
    public function getLoginUrl($callback){
        $url = 'https://graph.qq.com/oauth2.0/authorize';
        $params = array(
            'response_type'=>'code',
            'client_id'=>$this->appid,
            'redirect_uri'=>$callback,
            'scope'=>'get_user_info,add_share,add_t,add_pic_t',
        );
        return $url.'?'.$this->toUrlString($params);
    }

    public function getAccessToken($code,$callback){
        $url = 'https://graph.qq.com/oauth2.0/token';
        $params = array(
            'grant_type'=>'authorization_code',
            'client_id'=>$this->appid,
            'client_secret'=>$this->appkey,
            'code'=>$code,
            'state'=>'1',
            'redirect_uri'=>$callback,
        );
        $re = $this->https($url,$params);
        $arr = explode('&',$re);
        $access_token = explode('=',$arr[0]);
        if(!empty($access_token[1])){
            return $access_token[1];
        }
        return false;
    }

    public function getOpenId($access_token){
        $url = 'https://graph.qq.com/oauth2.0/me';
        $params = array(
            'access_token'=>$access_token,
        );
        $openid = $this->https($url,$params);
        preg_match('/"openid":"(\w+)"/i',$openid,$reg);
        if(!empty($reg[1])){
            return $reg[1];
        }
        return false;
    }

	public function sendWeibo($content,$access_token,$openid){
		$url = 'https://graph.qq.com/t/add_t';
		$params = array(
            'access_token'=>$access_token,
			'oauth_consumer_key'=>$this->appid,
			'openid'=>$openid,
            'content'=>$content,
        );
        $re = $this->https($url,$params);
        $arr = json_decode($re,true);
        return $arr;
	}

}
?>