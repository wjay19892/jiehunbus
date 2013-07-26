<?php
include_once('Auth.class.php');
class RenrenAuth extends Auth{
    public function getLoginUrl($callback){
        $url = 'https://graph.renren.com/oauth/authorize';
        $params = array(
            'client_id'=>$this->appid,
            'redirect_uri'=>$callback,
            'response_type'=>'code',
        );
        return $url.'?'.$this->toUrlString($params);
    }

    public function getAccessToken($code,$callback){
        $url = 'https://graph.renren.com/oauth/token';
        $params = array(
            'grant_type'=>'authorization_code',
            'client_id'=>$this->appid,
            'client_secret'=>$this->appkey,
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


}
?>