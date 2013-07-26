<?php
class Commission_logAction extends CommonAction {
	public function down(){
  		$model = D('Commission_log');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT C.id,G.title,O.sn,C.addtime,C.value
  		FROM `{$dbpre}commission_log` as C
  		left join `{$dbpre}goods` as G on C.gid = G.id
  		left join `{$dbpre}order` as O on C.oid = O.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'title'=>'商品名称',
  			'sn'=>'订单号',
  			'value'=>'佣金',
  			'addtime'=>array('产生时间','','toDate'),
  		);
  		
  		exportExcel($data,$keynames,'佣金日志_'.date("Y-m-d"));
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