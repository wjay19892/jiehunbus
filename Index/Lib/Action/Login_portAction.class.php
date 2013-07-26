<?php
// 本文档自动生成，仅供测试运行
class Login_portAction extends CommonAction
{
	public function index(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);

		$loginport = D('Login_port');
		$loginportdata = $loginport->find($id);
		if(empty($loginportdata)){
			$this->redirect('Index/index');
		}else{
			import("@.ORG.Loginport");
			$returnUrl = HOST.U('Login_port/callback/id/'.$id);
			$port = new Loginport($loginportdata['appkey'],$loginportdata['appsecret'],$returnUrl);
			$url = $port->$loginportdata['remark']();
			redirect($url);
		}
	}

	public function callback(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);

		$loginport = D('Login_port');
		$loginportdata = $loginport->find($id);
		if(empty($loginportdata)){
			$this->redirect('Index/index');
		}else{
			import("@.ORG.Loginport");
			$returnUrl = HOST.U('Login_port/callback/id/'.$id);
			$port = new Loginport($loginportdata['appkey'],$loginportdata['appsecret'],$returnUrl);
			$void = $loginportdata['remark'].'Auth';
			$me = $port->$void();
			if(!empty($me)){
				$member = D('Member');
				if(!empty($this->memberinfo)){
                    $member->setField("{$loginportdata['remark']}_id",$me,"id={$this->memberinfo['id']}");
					$this->redirect('Index/index');
				}
				$map[$loginportdata['remark'].'_id'] = array('eq',$me);
				$memberinfo = $member->where($map)->find();
				if(empty($memberinfo)){
					$_SESSION['logport']['port'] = $loginportdata['remark'];
					$_SESSION['logport']['portid'] = $me;
					$this->assign('port',$loginportdata['remark']);
					$this->assign('portid',$me);
					$this->display();
				}else{
					setMemberLogin($memberinfo['id']);
					$this->assign('jumpUrl','Member/index');
					$this->success(L('login_port_callback_success'));
				}
			}else{
				$this->redirect('Index/index');
			}
		}
	}

	public function bind_register(){		
		$data = Init_GP(array('name','password','email','port','portid','password_confirmation','inviteid'));
		$id = 0;
		$json = null;
		$status = 0;
		if($data['port'] == $_SESSION['logport']['port'] && $data['portid'] == $_SESSION['logport']['portid']){
			$data[$data['port'].'_id'] = $data['portid'];
			$useraction = A('User');
			$member = D('Member');
			if($useraction->_checkName($data['name'])){//注册时验证用户名是否可用
				if($useraction->_checkEmail($data['email'])){//注册时验证邮箱是否可用
					if($data['password']==$data['password_confirmation']){
						$data = $member->create($data);
						if(empty($data) || $data === false) {
							$json = L('register_error');
						}else {
							$id = $member->add($data);
							if($id) { //注册成功
								$config = C('sysconfig');
								if($config['site_mb_autoreg']==1){
									$info = $useraction->sendconfirm_mail($data['email']);
									if($info){
										$json = L('register_success_auto_verification');
										$status = 2;
									}else{
										$json = L('register_success_manual_verification');
										$status = 3;
									}
								}else{
									$useraction->sendregistered_mail($data['email']); 
									$json = L('register_success');
									$status = 1;
									setMemberLogin($id);
								}
							}else $json = L('register_error');
						}
					}else $json = L('passwords_not_equal');
				}else $json = L('email_used');
			}else $json = L('username_used');
			
		}else{
			$json = L('please_try_again');
		}
		
		$this->ajaxReturn($id,$json,$status);
	}
	
	public function bind_login(){
		$data = Init_GP(array('port','portid','email','password'));
		$id = 0;
		$json = null;
		$status = 0;
		if($data['port'] == $_SESSION['logport']['port'] && $data['portid'] == $_SESSION['logport']['portid']){
		
			$useraction = A('User');
			$state = $useraction->_checkLogin($data['email'],$data['password']);
			$member = D('Member');
			if ($state===true){
				$map['mail'] = array('eq',$data['email']);
				$memberdata = $member->where($map)->find();
				$id = $memberdata['id'];
				$tmpdata = array(
					'id'=>$id,
					$data['port'].'_id'=>$_SESSION['logport']['portid'],
				);
				$member->save($tmpdata);
				$json = L('login_port_bind_login_success');
				$status = 1;
				setMemberLogin($id);
			}else {
				if($state==4){
					$map['mail'] = array('eq',$data['email']);
					$memberdata = $member->where($map)->find();
					$id = $memberdata['id'];
					$json = L('email_not_verified');
					$status = 2; //电子邮件未验证！
				}else{
					$id = 0;
					if($state==1) {
						$json = L('email_not_exist');
					}elseif($state==2){
						$json = L('passwords_invalid');
					}elseif($state==3){
						$json = L('account_disabled');
					}
					$status = 0;
				}
			}
			
		}else{
			$json = L('please_try_again');
		}
		
		$this->ajaxReturn($id,$json,$status);
	}

}
?>