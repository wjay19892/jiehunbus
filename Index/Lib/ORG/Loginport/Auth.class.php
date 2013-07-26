<?php
class Auth{
    protected $appid = '';
    protected $appkey = '';
    public function Auth($appid,$appkey){
        $this->__construct($appid,$appkey);
    }

    public function __construct($appid,$appkey){
        $this->appid = $appid;
        $this->appkey = $appkey;
    }

    protected  function toUrlString($params)
    {
        ksort($params);
        $normalized = array();
        foreach($params as $key => $val)
        {
            $normalized[] = $key."=".rawurlencode($val);
        }
        return implode("&", $normalized);
    }

    protected function https($url,$params,$method = 'post'){
        if(is_array($params)){
            $params = $this->toUrlString($params);
        }
        if($method != 'post'){
            $url = $url.'?'.$params;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if($method == 'post'){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch) ;
        return $response;
    }
}
?>