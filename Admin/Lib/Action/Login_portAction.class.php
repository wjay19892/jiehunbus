<?php
class Login_portAction extends CommonAction{
	// 框架首页
	public function _filter(&$map){
  		if(!empty($map['name'])){
  			$map['name'] = array('like',"%{$map['name']}%");
  		}
  	}
	
	
}
?>