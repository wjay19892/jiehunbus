<?php
class Prepaid_cardAction extends CommonAction {
	
	public function down(){
  		$model = D('Coupon');
  		$data = $model->findAll();
  		$keynames = array(
  			'id'=>array('ID','num'),
	  		'sn'=>'序号',
	  		'pwd'=>'密码',
  			'cash'=>'金额',
	  		'starttime'=>array('有效期开始时间','','toDateYmd'),
  			'endtime'=>array('有效期结束时间','','toDateYmd'),
  			'status'=>array('状态','','',array(0=>'未使用',1=>'已使用')),
  		);
  		
  		exportExcel($data,$keynames,C('sysconfig.site_prepaid_card_name').'_'.date("Y-m-d"));
  	}
	
	public function _filter(&$map){
  		if(!empty($map['sn'])){
  			$map['sn'] = array('like',"%{$map['sn']}%");
  		}
  	}
  	
  	public function insert(){
  		$data = Init_GP(array('pre','sn_format','start','end','num','sn_num','sn_type','pwd_num','pwd_type','starttime','endtime','cash'));
  		$cash = toPrice($data['cash']);
  		$starttime = strtotime($data['starttime']);
  		$endtime = strtotime($data['endtime']);
  		$prepaid_card = D('Prepaid_card');
  		$prepaid_carddata = array();
  		if($data['sn_format']){
  			//自定义
  			if($data['start'] == ''){
  				$this->error('开始不能为空');
  			}
  			if($data['start'] == ''){
  				$this->error('结束不能为空');
  			}
  			
  			$start_len = strlen($data['start']);
  			$end_len = strlen($data['end']);
  			$start = intval($data['start']);
  			$end = intval($data['end']);
  			$len = $start_len > $end_len?$start_len:$end_len;
  			if($end < $start){
  				$this->error('结束值不能小于开始值');
  			}else{
  				if($end - $start > 10000){
  					$this->error('一次最多生成10000个');
  				}
  			}
  			$reg_len = $len - strlen($end);
  			$reg_nums_str = regRange($start,$end);
  			$regstr ='^'.$data['pre'].'[0]{'.$reg_len.'}'.$reg_nums_str.'$';
  			$map['sn'] = array('exp',"REGEXP '{$regstr}'");
  			$chunzai = $prepaid_card->where($map)->find();
  			if(!empty($chunzai)){
  				$this->error("序号{$chunzai['sn']}已存在");
  			}
  			$crr = $start;
  			$n = 0;
  			while ($crr <= $end){
  				$n ++;
  				$sn = $data['pre'].str_pad($crr,$len,'0',STR_PAD_LEFT);
  				$prepaid_carddata[] = array(
  					'sn'=>$sn,
  					'pwd'=>rand_string($data['pwd_num'],$data['pwd_type']),
  					'cash'=>$cash,
  					'starttime'=>$starttime,
  					'endtime'=>$endtime,
  				);
  				
  				if($n >= 2000){
  					$prepaid_card->addAll($prepaid_carddata);
  					$prepaid_carddata = array();
  					$n = 0;
  				}
  				$crr ++;
  			}
  			if($n > 0){
  				$prepaid_card->addAll($prepaid_carddata);
  				unset($prepaid_carddata);
  				unset($n);
  			}
  		}else{
  			//随机
  			$num = intval($data['num']);
  			if(!$num){
  				$this->error('数量必须大于0');
  			}
  			
  			$n = 0;
  			$crr = 0;
  			$sn_arr = array();
  			while($crr < $num){
  				$sn = $data['pre'].rand_string($data['sn_num'],$data['sn_type']);
  				$map['sn'] = array('eq',$sn);
  				$info = $prepaid_card->where($map)->find();
  				if(!empty($info) && !in_array($sn, $sn_arr)){
  					break;
  				}
  				$sn_arr[] = $sn;
  				$n ++;
  				$prepaid_carddata[] = array(
  					'sn'=>$sn,
  					'pwd'=>rand_string($data['pwd_num'],$data['pwd_type']),
  					'cash'=>$cash,
  					'starttime'=>$starttime,
  					'endtime'=>$endtime,
  				);
  				if($n >= 2000){
  					$prepaid_card->addAll($prepaid_carddata);
  					$prepaid_carddata = array();
  					$n = 0;
  				}
  				$crr ++;
  			}
  			if($n > 0){
  				$prepaid_card->addAll($prepaid_carddata);
  				unset($prepaid_carddata);
  				unset($n);
  			}
  		}
  		
  		$this->success('生成成功');
  	}
}
?>