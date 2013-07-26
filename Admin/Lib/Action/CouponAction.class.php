<?php
class CouponAction extends CommonAction {
	public function down(){
  		$model = D('Coupon');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT C.id,G.title,M1.name as promulgator,M2.name as owner,O.sn as ordersn,C.sn,C.pass,C.starttime,C.endtime,C.addtime,C.status 
  				FROM `{$dbpre}coupon` as C left join `{$dbpre}goods` as G on C.gid = G.id 
  				left join `{$dbpre}member` as M1 on C.promulgator = M1.id 
  				left join `{$dbpre}member` as M2 on C.uid = M2.id 
  				left join `{$dbpre}order` as O on C.oid = O.id";
  		$data = $model->query($sql);
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'title'=>'商品',
  			'promulgator'=>'发布者',
  			'owner'=>'所属者',
  			'ordersn'=>'订单号',
	  		'sn'=>'序号',
	  		'pass'=>'密码',
	  		'starttime'=>array('有效期开始时间','','toDateYmd'),
  			'endtime'=>array('有效期结束时间','','toDateYmd'),
  			'status'=>array('状态','','',array(0=>'未使用',1=>'已使用')),
  		);
  		
  		exportExcel($data,$keynames,'消费凭证_'.date("Y-m-d"));
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