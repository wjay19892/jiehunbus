<?php
class CommonAction extends Action
{	
	//检查登录并把会员信息输出
	protected function _islogin(){
	    $member = D('Member');
		if(isset($_COOKIE['islogin']) && isset($_COOKIE['mb_id'])){
		    $islogin = intval($_COOKIE['islogin']);
		    if($islogin==1){
				$memberdata = $member->getOne(getMemberId());
			}
		}else {
			if(empty($memberdata) && isset($_COOKIE['email']) && isset($_COOKIE['password'])){
				$auto_data = getAutoLogin();
				$map = array(
					'mail' =>array('eq',$auto_data['email']),
					'password'=>array('eq',$auto_data['password'])
				);
				$memberdata = $member->where($map)->find();
				if(!empty($memberdata)){
					setMemberLogin($memberdata['id']);
					$memberdata = $member->getOne($memberdata['id']);
				}
			}else{
			   	$memberdata = array();
			}
		}
		$this->memberinfo = $memberdata;
	}

}