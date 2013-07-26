<?php

class ShoppingCart extends Think {//类定义开始
	  //获取值
	  static function getVal(){
	  	  $shoppingcart = cookie('shoppingcart');
	 	  $shoppingcart = unserialize(stripslashes($shoppingcart));
	 	  return $shoppingcart;
	  }
	  
	  static function setVal($shoppingcart){
	  	  $shoppingcart = serialize($shoppingcart);
	 	  cookie('shoppingcart',$shoppingcart,86400 * 100);
	  }
	  
	  static function addVal($id){
	  	  $val = self::getVal();
	  	  $k = self::getOneKey($id);
	  	  if($k === false){
	  	  	 $val[] = array(
	  	  	 	'id'=>$id,
	  	  	 	'num'=>1,
	  	  	 );
	  	  }else{
	  	  	 $val[$k]['num']++;
	  	  }
	  	  self::setVal($val);
	  }
	  
	  static function editVal($id,$data){
	  	  $val = self::getVal();
	  	  $k = self::getOneKey($id);
	  	  if($k === false){
	  	  	 $val[] = $data;
	  	  }else{
	  	  	 $val[$k] = $data;
	  	  }
	  	  self::setVal($val);
	  }
	  
	  static function getOneKey($id){
	 	  $val = self::getVal();
	  	  foreach ($val as $k=>$v){
	  	  	 if($v['id'] == $id){
	  	  	 	return $k;
	  	  	 }
	  	  }
	  	  return false;
	  }
	  
	  static function getOne($id){
	 	  $val = self::getVal();
	  	  foreach ($val as $k=>$v){
	  	  	 if($v['id'] == $id){
	  	  	 	return $v;
	  	  	 }
	  	  }
	  	  return false;
	  }
	  
	  static function delOne($id){
	  	  $val = self::getVal();
	  	  $k = self::getOneKey($id);
	  	  if($k === false){
	  	  	
	  	  }else{
	  	  	 unset($val[$k]);
	  	  }
	  	  self::setVal($val);
	  }
	  
	  static function clear(){
	  	   cookie('shoppingcart',null);
	  }

}

?>