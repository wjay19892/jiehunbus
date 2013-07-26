<?php
include_once('Auth.class.php');
class BaiduAuth extends Auth{
    public function getLoginUrl($callback){
        $url = 'https://openapi.baidu.com/oauth/2.0/authorize';
        $params = array(
            'client_id'=>$this->appid,
            'response_type'=>'code',
            'redirect_uri'=>$callback,
        );
        return $url.'?'.$this->toUrlString($params);
    }

    public function getAccessToken($code,$callback){
        $url = 'https://openapi.baidu.com/oauth/2.0/token';
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
        $url = 'https://openapi.baidu.com/rest/2.0/passport/users/getLoggedInUser';
        $params = array(
            'access_token'=>$access_token,
        );
        $openid = $this->https($url,$params);
        $arr = json_decode($openid,true);
        if(!empty($arr['uid'])){
            return $arr['uid'];
        }
        return false;
    }

}
?>