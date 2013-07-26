<?php

class Lately extends Think {//类定义开始
	  //获取值
	  
	  static function getVal(){
	  	  $lately = cookie('lately');
	 	  $lately = unserialize($lately);
	 	  return $lately;
	  }
	  
	  static function setVal($lately){
	  	  $lately = serialize($lately);
	 	  cookie('lately',$lately);
	  }
	  
	  static function addVal($id){
	  	  $val = self::getVal();
	  	  if(!in_array($id, $val)){
		  	  $val[] = $id;
		  	  self::setVal($val);
	  	  }
	  }
	  
	  static function delOne($id){
	  	  $val = self::getVal();
	  	  foreach($val as $k => $v){
	  	  	 if($v == $id){
	  	  	 	unset($val[$k]);
	  	  	 }
	  	  }
	  	  self::setVal($val);
	  }
	  
	  static function clear(){
	  	   cookie('lately',null);
	  }

}

?>