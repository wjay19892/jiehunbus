<?php
include_once('Auth.class.php');
class WeiboAuth extends Auth{
    public function getLoginUrl($callback){
        $url = 'https://api.weibo.com/oauth2/authorize';
        $params = array(
            'client_id'=>$this->appid,
            'redirect_uri'=>$callback,
        );
        return $url.'?'.$this->toUrlString($params);
    }

    public function getAccessToken($code,$callback){
        $url = 'https://api.weibo.com/oauth2/access_token';
        $params = array(
            'client_id'=>$this->appid,
            'client_secret'=>$this->appkey,
            'grant_type'=>'authorization_code',
            'code'=>$code,
            'redirect_uri'=>$callback,
        );
        $re = $this->https($url,$params);
        $arr = json_decode($re,true);
        if(!empty($arr['access_token'])){
            return $arr;
        }
        return false;
    }

	public function sendWeibo($content,$access_token){
		$url = 'https://api.weibo.com/2/statuses/update.json';
		$params = array(
            'access_token'=>$access_token,
            'status'=>$content,
        );
        $re = $this->https($url,$params);
        $arr = json_decode($re,true);
        return $arr;
	}

}
?>