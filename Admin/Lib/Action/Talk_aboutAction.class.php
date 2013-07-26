<?php
class Talk_aboutAction extends CommonAction {
		
	public function _filter(&$map){
  		if(!empty($map['content'])){
  			$map['content'] = array('like',"%{$map['content']}%");
  		}
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
  			$map ['addtime'] = array('between',"{$mintime},{$maxtime}");
  		}
  	}
}
?>