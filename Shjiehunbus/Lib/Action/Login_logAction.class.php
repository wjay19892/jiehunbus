<?php
class Login_logAction extends CommonAction {
  	public function down(){
  		$model = D('Login_log');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT L.id,M.name,L.ip,L.address,L.addtime 
  				FROM `{$dbpre}login_log` as L left join `{$dbpre}member` as M on L.uid = M.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'name'=>'用户',
  			'ip'=>'IP',
  			'address'=>'真实地址',
  			'addtime'=>array('登录时间','','toDate'),
  		);
  		
  		exportExcel($data,$keynames,'登录日志_'.date("Y-m-d"));
  	}
  	
	public function _filter(&$map){
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
				$map ['addtime'] = array('between',"{$mintime},{$maxtime}");
		}
		if(!empty($map['ip'])){
  			$map['ip'] = array('like',"%{$map['ip']}%");
  		}
		if(!empty($map['address'])){
  			$map['address'] = array('like',"%{$map['address']}%");
  		}
  	}
}
?>