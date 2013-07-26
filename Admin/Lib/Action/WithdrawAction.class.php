<?php
class WithdrawAction extends CommonAction {
  	public function down(){
  		$model = D('Withdraw');
  		$dbpre = C('DB_PREFIX');
  		$sql = "SELECT W.*,M.name 
  				FROM `{$dbpre}withdraw` as W left join `{$dbpre}member` as M on W.uid = M.id";
  		$data = $model->query($sql);
  		
  		$keynames = array(
  			'id'=>array('ID','num'),
  			'name'=>'用户',
  			'cash'=>array('现金','num'),
  			'bank_id'=>'提现方式',
  			'bank_card'=>'提现帐号',
  			'addtime'=>array('提现时间','','toDate'),
  			'status'=>array('状态','','getWithdraw'),
  		);
  		
  		exportExcel($data,$keynames,'提现记录_'.date("Y-m-d"));
  	}
  	
	public function _filter(&$map){
  		$data = Init_GP(array('mintime','maxtime'));
  		$mintime = strtotime($data['mintime']);
  		$maxtime = strtotime($data['maxtime']);
  		if ($mintime && $maxtime) {
			$map ['addtime'] = array('between',"{$mintime},{$maxtime}");
		}
  	}
  	
  	public function handle(){
  		$data = Init_GP(array('id'));
  		$id = intval($data['id']);
  		$model = D('Withdraw');
  		$modeldata = array(
  			'id'=>$id,
  			'status'=>1,
  		);
  		$info = $model->save($modeldata);
  		if($info){
  			$this->success('设为已处理成功');
  		}else{
  			$this->error('设为已处理失败');
  		}
  	}
  	
	public function complete(){
  		$data = Init_GP(array('id'));
  		$id = intval($data['id']);
  		$model = D('Withdraw');
  		$modeldata = array(
  			'id'=>$id,
  			'status'=>2,
  		);
  		$info = $model->save($modeldata);
  		if($info){
  			$this->success('设为已完成成功');
  		}else{
  			$this->error('设为已完成失败');
  		}
  	}
  	
	public function revocation(){
  		$data = Init_GP(array('id'));
  		$id = intval($data['id']);
  		$model = D('Withdraw');
  		$modeldata = array(
  			'id'=>$id,
  			'status'=>3,
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
  				'content'=>'撤销提现单',
  				'addtime'=>toDate(time()),
  			);
  			$log->add($logdata);
  			$this->success('设为已撤销成功');
  		}else{
  			$this->error('设为已撤销失败');
  		}
  	}
}
?>