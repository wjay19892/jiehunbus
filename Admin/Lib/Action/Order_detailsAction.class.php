<?php
class Order_detailsAction extends CommonAction {
	public function down(){
  		$model = D('Order_details');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT O.id,G.title,M.name,O.sn,O.num,O.addtime,O.paytype,O.status 
  				FROM `{$dbpre}order_details` as O 
  				left join `{$dbpre}goods` as G on O.gid = G.id 
  				left join `{$dbpre}member` as M on O.uid = M.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'title'=>'商品',
  			'name'=>'会员',
	  		'num'=>array('数量','num'),
	  		'price'=>array('单价','num'),
  			'total'=>array('总价','num'),
	  		'addtime'=>array('下单时间','','toDate'),
  			'status'=>array('状态','','',array(0=>'未付款',1=>'已付款',2=>'已完成')),
  		);
  		
  		exportExcel($data,$keynames,'订单详情_'.date("Y-m-d"));
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