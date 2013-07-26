<?php
include_once('Auth.class.php');
class TaobaoAuth extends Auth{
    public function getLoginUrl($callback){
        $url = 'https://oauth.taobao.com/authorize';
        $params = array(
            'client_id'=>$this->appid,
            'response_type'=>'code',
            'redirect_uri'=>$callback,
        );
        return $url.'?'.$this->toUrlString($params);
    }

    public function getAccessToken($code,$callback){
        $url = 'https://oauth.taobao.com/token';
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

    public function getOpenId($access_token){
        $url = 'https://api.kaixin001.com/users/me.json';
        $params = array(
            'access_token'=>$access_token,
        );
        $openid = $this->https($url,$params,'get');
        $arr = json_decode($openid,true);
        if(!empty($arr['uid'])){
            return $arr['uid'];
        }
        return false;
    }

}
?>