<?php
class RechargeModel extends CommonModel {
	protected $_filter = array(
		'id'=>array('GetNum'),
		'uid'=>array('GetNum'),
		'cash'=>array('toPrice'),
		'bank_id'=>array('Char_cv'),
		'addtime'=>array('','toDate'),
		'status'=>array('GetNum'),
	);
	function getData($map='',$limit='',$order='`id` desc'){
		if(empty($order))$order = '`id` desc';
		return $this->where($map)->limit($limit)->order($order)->findAll();
	}
	//生成订单号
	public function produceSn(){
		do {
			$string = rand_string(8);
			$sn = 'RE'.$string.date('Ymd');
			$sn = str_replace('.', '', $sn);
			$map['sn'] = array('eq',$sn);
			$tmp = $this->isExist($map);
		}while ($tmp);
		return $sn;
	}
	
	public function succPay($info){
		if(is_array($info)){
			$map = array(
				'sn'=>array('eq',$info['sn']),
				'status'=>array('eq',0),
			);
			$rechargedata = $this->where($map)->find();
			//商品存在
			if($rechargedata){
				//应付金额也正确
				if($rechargedata['cope'] == $info['cope']){
					$updata = array(
						'id'=>$rechargedata['id'],
						'cope'=>0,
						'status'=>1,
					);
					$this->save($updata);
					$member = D('Member');
		 			$member->setInc('cash',"id={$rechargedata['uid']}",toPrice($rechargedata['cash']));
		 			$cash_log = D('Cash_log');
		 			$cash_logdata = array(
						'uid'=>$rechargedata['id'],
						'val'=>$rechargedata['cash'],
						'content'=>"[recharge]{$rechargedata['sn']}",
		 				'rel_id'=>$rechargedata['id'],
						'rel_module'=>'Recharge',
		 				'addtime'=>time(),
					);
					$cash_log->insert($cash_logdata);
				}
			}
		}
	}
}
?>