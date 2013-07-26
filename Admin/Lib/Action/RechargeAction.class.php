<?php
class RechargeAction extends CommonAction {
  	public function down(){
  		$model = D('Recharge');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT W.*,M.name 
  				FROM `{$dbpre}recharge` as W left join `{$dbpre}member` as M on W.uid = M.id";
  		$data = $model->query($sql);
  		
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'sn'=>'充值单号',
  			'name'=>'用户',
  			'cash'=>array('充值金额','num'),
  			'bank_id'=>'充值方式',
  			'addtime'=>array('充值时间','','toDate'),
  			'status'=>array('是否成功','','getWhether'),
  		);
  		
  		exportExcel($data,$keynames,'充值记录_'.date("Y-m-d"));
  	}
  	
	public function _filter(&$map){
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
			$map ['addtime'] = array('between',"{$mintime},{$maxtime}");
		}
  	}
  	
	public function complete(){
  		$data = Init_GP(array('id'));
  		$id = intval($data['id']);
  		$model = D('Recharge');
  		$modeldata = array(
  			'id'=>$id,
  			'status'=>1,
  		);
  		$info = $model->save($modeldata);
  		if($info){
  			$data = $model->find($id);
  			$member = D('Member');
  			$member->setInc('cash',"id={$data['uid']}",toPrice($data['cash']));
  			$log = D('Cash_log');
  			$logdata = array(
  				'uid'=>$data['uid'],
  				'val'=>$data['cash'],
  				'content'=>'充值',
  				'addtime'=>toDate(time()),
  			);
  			$log->add($logdata);
  			$this->success('操作成功');
  		}else{
  			$this->success('操作失败');
  		}
  	}
}
?>