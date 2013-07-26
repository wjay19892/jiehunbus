<?php
class Complaint_itemAction extends CommonAction {
 	public function _filter(&$map){
  		if(!empty($map['name'])){
  			$map['name'] = array('like',"%{$map['name']}%");
  		}
  	}
}
?>