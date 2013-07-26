<?php
class RefundsAction extends CommonAction {
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
	public function index(){
		$map = $this->_search ("Order_details");
		if(empty($map['refund_state'])){
			$map['refund_state'] = array('gt',0);
		}
		$map['status'] = array('eq',1);
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$model	=	D("Order_details");
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
		
	}
	function edit() {
		$model	=	D("Order_details");
		$id = $_REQUEST [$model->getPk ()];
		$vo = $model->getById ( $id );
		$map['uid'] = array('eq',$vo['uid']);
		$map['gid'] = array('eq',$vo['gid']);
		$map['oid'] = array('eq',$vo['id']);
		$coupon = D('Coupon');
		$couponsdata = $coupon->where($map)->findAll();
	
		$this->assign ( 'vo', $vo );
		$this->assign ( 'couponsdata', $couponsdata );
		$this->display ();
	}

	function update() {
	    $data = Init_GP(array('id','uid','cid','refundtype'));
		if(empty($data['cid']))$this->error('请选择要退款的'.C('sysconfig.site_couponname'));
		if(empty($data['refundtype']))$this->error('请选择退款方式');
		$model	=	D("Order_details");
		$id = intval($data['id']);
		$vo = $model->getById ( $id );
		if(empty($vo))$this->error('操作错误');
		if($vo['uid'] != $data['uid'])$this->error('操作错误');
		if($vo['refund_state'] > 1)$this->error('此退款申请已处理');
		
		$refundamount =count($data['cid'])*$vo['price'];
		if($data['refundtype'] == "norefund"){
			$data['refund_state'] = 3;
		}elseif($data['refundtype'] == "cash"){
		    $data['refund_state'] = 2;
			$data['refundamount'] = $refundamount;
			$data['refundtime'] = time();
		}elseif($data['refundtype'] == "other"){
		    $data['refund_state'] = 2;
			$data['refundamount'] = $refundamount;
			$data['refundtime'] = time();
		}
		
		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}
		$data = $model->create ($data);

		// 更新数据
		$list = $model->save ($data);
		if (false !== $list) {
		    if($data['refundtype'] == "cash"){
				$member = D('Member');
				$member->setInc('cash',"id={$vo['uid']}",toPrice($refundamount));
			}
			//成功提示
			$this->assign ( 'jumpUrl', U('Refunds/index'));
			$this->success ('操作成功!');
		} else {
			//错误提示
			$this->error ('操作失败!');
		}
	}

	public function _filter(&$map){
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
				$map ['refund_applytime'] = array('between',"{$mintime},{$maxtime}");
		}
  	}
  	
}
?>