<?php
class OrderAction extends CommonAction {
	public function down(){
  		$model = D('Order');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT O.id,M.name,O.sn,O.num,O.addtime,O.paytype,O.status 
  				FROM `{$dbpre}order` as O 
  				left join `{$dbpre}member` as M on O.uid = M.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'name'=>'会员',
  			'sn'=>'订单号',
  			'phone'=>'手机',
	  		'fee'=>array('手续费','num'),
  			'incharge'=>array('已支付','num'),
  			'total'=>array('总价','num'),
  			'money_status'=>array('状态','','',array(0=>'未支付',1=>'部分支付',2=>'全部支付',3=>'部分退款',4=>'全部退款')),
	  		'paytype'=>'支付方式',
	  		'addtime'=>array('下单时间','','toDate'),
  			'status'=>array('状态','','',array(0=>'未支付',1=>'已支付')),
  		);
  		
  		exportExcel($data,$keynames,'订单列表_'.date("Y-m-d"));
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