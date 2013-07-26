<?php
class Sms_logAction extends CommonAction {
	public function down(){
  		$model = D('Sms_log');
  		$dbpre = C('DB_PREFIX');
  		$data = $model->findAll();
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'receive'=>'发送对象',
  			'content'=>'发送内容',
  			'sendtime'=>array('发送时间','','toDate'),
  			'status'=>array('是否成功','','getWhether'),
  		);
  		
  		exportExcel($data,$keynames,'短信日志_'.date("Y-m-d"));
  	}
  	
	public function _filter(&$map){
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
				$map ['addtime'] = array('between',"{$mintime},{$maxtime}");
		}
		
		if(!empty($map['content'])){
  			$map['content'] = array('like',"%{$map['content']}%");
  		}
  		
		if(!empty($map['receive'])){
  			$map['receive'] = array('like',"%{$map['receive']}%");
  		}
  	}
}
?>