<?php
class Cash_logAction extends CommonAction {
  	public function down(){
  		$model = D('Cash_log');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT V.id,M.name,V.val,V.content,V.addtime 
  				FROM `{$dbpre}cash_log` as V left join `{$dbpre}member` as M on V.uid = M.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'name'=>'用户',
  			'val'=>array('现金','num'),
  			'content'=>array('内容','','getCashContent'),
  			'addtime'=>array('记录时间','','toDate'),
  		);
  		
  		exportExcel($data,$keynames,'现金日志_'.date("Y-m-d"));
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