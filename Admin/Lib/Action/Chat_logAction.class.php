<?php
class Chat_logAction extends CommonAction {
  	public function down(){
  		$model = D('Chat_log');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT C.id,M1.name as send,M2.name as receive,C.content,C.addtime 
  				FROM `{$dbpre}chat_log` as C left join `{$dbpre}member` as M1 on C.send = M1.id
  				left join `{$dbpre}member` as M2 on C.receive = M2.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'send'=>'发送者',
	  		'receive'=>'接收者',
  			'content'=>'内容',
  			'addtime'=>array('发送时间','','toDate'),
  		);
  		
  		exportExcel($data,$keynames,'聊天日志_'.date("Y-m-d"));
  	}
  	
	public function _filter(&$map){
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
				$map ['addtime'] = array('between',"{$mintime},{$maxtime}");
		}
  	}
}
?>