<?php
class MessageAction extends CommonAction {
  	public function down(){
  		$model = D('Message');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT MS.id,M1.name as send,M2.name as receive,MS.content,MS.type,MS.mark,MS.addtime 
  				FROM `{$dbpre}message` as MS left join `{$dbpre}member` as M1 on MS.send = M1.id
  				left join `{$dbpre}member` as M2 on MS.receive = M2.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'send'=>'发送者',
	  		'receive'=>'接收者',
  			'content'=>'内容',
  			'type'=>array('类型','','getMessageType'),
  			'mark'=>array('标记','','getMessageMark'),
  			'addtime'=>array('发送时间','','toDate'),
  		);
  		
  		exportExcel($data,$keynames,'会员消息_'.date("Y-m-d"));
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