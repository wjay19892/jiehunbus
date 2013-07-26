<?php
class PaymentAction extends CommonAction {
	public function _filter(&$map){
  		if(!empty($map['name'])){
  			$map['name'] = array('like',"%{$map['name']}%");
  		}
  	}
}
?>