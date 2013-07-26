<?php
class CommissionModel extends CommonModel {
	public function distribution($coupondata){
		$config = C('sysconfig');
		//开启了自动分配
		if($config['distribution_auto'] == 1){
			$member = D('Member');
			$goods = D('Goods');
			$goodsdata = $goods->getOne($coupondata['gid']);
			$goodsvalue = GetNum($goodsdata['commission']);
			$goodstype = intval($goodsdata['commission_type']);
			//开启了商品自动分配
			
			if($config['distribution_goods_open'] == 1 && !empty($goodsvalue)){
				$value = $goodsvalue;
				$type = $goodstype;
			}else{
				
				$memberdata = $member->getOne($coupondata['promulgator']);
				
				$map['lid'] = array('eq',$memberdata['level']);
				$data = $this->getOne($map);
				if(isset($data['value'])){
					$membervalue = GetNum($data['value']);
					$membertype = intval($data['type']);
				}
				//开启了用户级别
				if($config['distribution_level_open'] == 1 && !empty($membervalue)){
					$value = $membervalue;
					$type = $membertype;
				}else{
					$unityvalue = $config['distribution_unity_value'];
					$unitytype = $config['distribution_unity_type'];
					if($config['distribution_unity_open'] == 1 && !empty($unitytype)){
						$value = $unityvalue;
						$type = $unitytype;
					}
				}
			}
			//进行分配
			$value = GetNum($value);
			$order_details = D('Order_details');
			$order_detailsdata = $order_details->getOne($coupondata['oid']);
			$total = $order_detailsdata['total'];
			if($type == 0){
				$commission = $value;
			}else{
				$commission = $total * $value / 100;
			}
			
			$surplus = $total - $commission;
			
			//如果佣金大于0则记录
			if($commission > 0){
				$commission_log = D('Commission_log');
				$commission_logdata = array(
						'gid'=>$coupondata['gid'],
						'oid'=>$order_detailsdata['oid'],
						'value'=>$commission,
						'addtime'=>time(),
				);
				$commission_log->insert($commission_logdata);
			}
			
			//如果剩余大于0则返还
			if($surplus > 0){
				$member->setInc('cash',"id={$coupondata['promulgator']}",$surplus);
				$cash_log = D('Cash_log');
				$cash_logdata = array(
						'uid'=>$coupondata['promulgator'],
						'val'=>$surplus,
						'content'=>'[distribution]',
						'rel_id'=>$coupondata['id'],
						'rel_module'=>'Coupon',
						'addtime'=>time(),
				);
				$cash_log->insert($cash_logdata);
			}
		
		}
	}
}
?>