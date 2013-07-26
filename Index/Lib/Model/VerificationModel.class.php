<?php
// 用户模型

class VerificationModel extends CommonModel {
	//设置邮箱验证码
	public function setCode($mail,$type,$count=1,$len = 16){
		$data['mail'] = $mail;
		$data['type'] = $type;
		$data['addtime'] = time();
		$data['count'] = $count;
		do {
			$string = rand_string($len);
			$map['code'] = array('eq',$string);
			$arr = $this->where($map)->find();
		}while (!empty($arr));
		
		$data['code'] = $string;
		$this->add($data);
		return $string;
	}
	//设置短信验证码
	public function setPhoneCode($mail,$type,$count=1,$len = 6){
		$data['mail'] = $mail;
		$data['type'] = $type;
		$data['addtime'] = time();
		$data['count'] = $count;
		do {
			$string = rand_string($len,1);
			$map['code'] = array('eq',$string);
			$arr = $this->where($map)->find();
		}while (!empty($arr));
		
		$data['code'] = $string;
		$this->add($data);
		return $string;
	}
	public function delCode($mail,$type){
		$map = array(
			'mail'=>array('eq',$mail),
			'type'=>array('eq',$type)
		);
		$this->where($map)->delete();
	}
	//设置验证码发送次数
	public function getCount($mail,$type){
		$start = strtotime(date('Y-m-d',time()));
		$end = $start+86400;
		$where = array(
			'mail' => array('eq',$mail),
			'type' => array('eq',$type),
			'addtime'=>array('between',"{$start},{$end}")
		);
		$vlaue = $this->where($where)->find();
		if(empty($vlaue))$vlaue['count']=0;
		return $vlaue['count'];
	}
	
}
?>