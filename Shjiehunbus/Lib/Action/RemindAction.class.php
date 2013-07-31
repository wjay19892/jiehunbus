<?php
class RemindAction extends CommonAction {
  	public function down(){
  		$model = D('Remind');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT R.id,M1.name as uid,M2.name as opposite,R.content,R.type,R.addtime 
  				FROM `{$dbpre}remind` as R left join `{$dbpre}member` as M1 on R.uid = M1.id
  				left join `{$dbpre}member` as M2 on R.opposite = M2.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'uid'=>'会员',
	  		'opposite'=>'对方',
  			'content'=>'内容',
  			'type'=>array('类型','','getMessageType'),
  			'addtime'=>array('提醒时间','','toDate'),
  		);
  		
  		exportExcel($data,$keynames,'会员提醒_'.date("Y-m-d"));
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