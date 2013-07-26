<?php
class AttentionAction extends CommonAction {
  	public function down(){
  		$model = D('Attention');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT A.id,M1.name as main,M2.name as was,A.updatetime 
  				FROM `{$dbpre}attention` as A left join `{$dbpre}member` as M1 on A.send = M1.id
  				left join `{$dbpre}member` as M2 on A.receive = M2.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'main'=>'关注者',
	  		'was'=>'被关注者',
  			'updatetime'=>array('最新关注时间','','toDate'),
  		);
  		
  		exportExcel($data,$keynames,'会员关注_'.date("Y-m-d"));
  	}
  	
	public function _filter(&$map){
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
				$map ['updatetime'] = array('between',"{$mintime},{$maxtime}");
		}
  	}
}
?>