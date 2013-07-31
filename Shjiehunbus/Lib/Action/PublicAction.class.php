<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

class PublicAction extends Action {
	// 检查用户是否登录

	protected function checkUser() {
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			if ($this->isAjax()){ // zhanghuihua@msn.com
				$this->ajaxReturn(true,"",301);
			}else{
				$this->assign('jumpUrl','Public/login');
				$this->error('没有登录');
			}
		}
	}

	// 菜单页面
	public function menu() {
        $this->checkUser();
		$data = Init_GP(array("id"));
		$topmenuid = GetNum($data['id']);
		$this->assign('topmenuid',$topmenuid);
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
			$Group	=	D("Group");
			$groupdata	=	$Group->where('status=1 and groups_nav_id='.$topmenuid)->order('sort')->select();
			
			//读取数据库模块列表生成菜单项
			$node = D ( "Node" );
			foreach($groupdata  as $k => $value){
			    $menu = array ();
				$id = $node->getField ( "id" );
				$where ['level'] = 2;
				$where ['status'] = 1;
				$where ['pid'] = $id;
				$where ['group_id'] = $value['id'];
				$list = $node->where ( $where )->field ( 'id,name,group_id,title' )->order ( 'sort desc' )->select ();
				$accessList = $_SESSION ['_ACCESS_LIST'];
				foreach ( $list as $key => $module ) {
					if (isset ( $accessList [strtoupper ( APP_NAME )] [strtoupper ( $module ['name'] )] ) || $_SESSION ['administrator'] ||  !C('USER_AUTH_ON')) {
						//设置模块访问权限
						$module ['access'] = 1;
						$menu [$key] = $module;
					}
				}
				
				if (! empty ( $_GET ['tag'] )) {
					$this->assign ( 'menuTag', $_GET ['tag'] );
				}
				$groupdata[$k]['menu'] = $menu;
				//dump($menu);
				//$this->assign ( 'menu', $menu );
			}
			$groupdata[$k]['menu'] = $menu;
			//var_dump($groupdata);
			$this->assign ( 'groupdata', $groupdata );
		}
		C('SHOW_RUN_TIME',false);			// 运行时间显示
		C('SHOW_PAGE_TRACE',false);
		$this->display();
	}
	
    // 后台首页 查看系统信息
    public function main() {
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
            );
        $this->assign('info',$info);
        $this->display();
    }

	// 用户登录页面
	public function login() {
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->display();
		}else{
			$this->redirect('Index/index');
		}
	}

	public function index()
	{
		//如果通过认证跳转到首页
		redirect(__APP__);
	}

	// 用户登出
    public function logout()
    {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
            $this->assign("jumpUrl",__URL__.'/login/');
            $this->success('登出成功！');
        }else {
            $this->error('已经登出！');
        }
    }

	// 登录检测
	public function checkLogin() {
		if(empty($_POST['account'])) {
			$this->error('帐号错误！');
		}elseif (empty($_POST['password'])){
			$this->error('密码必须！');
		}elseif (empty($_POST['verify'])){
			$this->error('验证码必须！');
		}
        //生成认证条件
        $map            =   array();
		// 支持使用绑定帐号登录
		$map['account']	= $_POST['account'];
        $map["status"]	=	array('gt',0);
		if($_SESSION['verify'] != md5($_POST['verify'])) {
			$this->error('验证码错误！');
		}
		import ( 'ORG.Util.RBAC' );
        $authInfo = RBAC::authenticate($map);
        //使用用户名、密码和状态的方式进行认证
        if(false === $authInfo) {
            $this->error('帐号不存在或已禁用！');
        }else {
            if($authInfo['password'] != md5($_POST['password'])) {
            	$this->error('密码错误！');
            }
            $_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['id'];
            $_SESSION['email']	=	$authInfo['email'];
            $_SESSION['loginUserName']		=	$authInfo['nickname'];
            $_SESSION['lastLoginTime']		=	$authInfo['last_login_time'];
			$_SESSION['login_count']	=	$authInfo['login_count'];
			$admin=C('DEFAULT_ADMIN');
            if($authInfo['account']==$admin) {
            	$_SESSION['administrator']		=	true;
            }
            //保存登录信息
			$User	=	D('User');
			$ip		=	get_client_ip();
			$time	=	time();
            $data = array();
			$data['id']	=	$authInfo['id'];
			$data['last_login_time']	=	$time;
			$data['login_count']	=	array('exp','login_count+1');
			$data['last_login_ip']	=	$ip;
			$User->save($data);

			// 缓存访问权限
            RBAC::saveAccessList();
			$this->success('登录成功！');

		}
	}
    // 更换密码
    public function changePwd()
    {
		$this->checkUser();
        //对表单提交处理进行处理或者增加非表单数据
		if(md5($_POST['verify'])	!= $_SESSION['verify']) {
			$this->error('验证码错误！');
		}
		$map	=	array();
        $map['password']= pwdHash($_POST['oldpassword']);
        if(isset($_POST['account'])) {
            $map['account']	 =	 $_POST['account'];
        }elseif(isset($_SESSION[C('USER_AUTH_KEY')])) {
            $map['id']		=	$_SESSION[C('USER_AUTH_KEY')];
        }
        //检查用户
        $User    =   D("User");
        if(!$User->where($map)->field('id')->find()) {
            $this->error('旧密码不符或者用户名错误！');
        }else {
			$User->password	=	pwdHash($_POST['password']);
			$User->save();
			$this->success('密码修改成功！');
         }
    }
	public function profile() {
		$this->checkUser();
		$User	 =	 D("User");
		$vo	=	$User->getById($_SESSION[C('USER_AUTH_KEY')]);
		$this->assign('vo',$vo);
		$this->display();
	}
	public function verify()
    {
		$type	 =	 isset($_GET['type'])?$_GET['type']:'jpeg';
        import("ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
    }
// 修改资料
	public function change() {
		$this->checkUser();
		$User	 =	 D("User");
		if(!$User->create()) {
			$this->error($User->getError());
		}
		$result	=	$User->save();
		if(false !== $result) {
			$this->success('资料修改成功！');
		}else{
			$this->error('资料修改失败!');
		}
	}

	//清空缓存
	function clearCache(){
		$dir = ROOT_PATH."/Runtime/";
		if(!is_dir($dir)) {
			$this->success('缓存已清空!');
		}
		$v = $this->cacheClear();
		if($v) {
			$this->success('清空缓存成功!');
		} else {
			$this->error('清空缓存失败!');
		}
	}
	//清空缓存
	function cacheClear(){
		
		$dir = ROOT_PATH."/Runtime/";
		if(!is_dir($dir)) {
			return false;
		}		
		$info = deleteAll($dir);
		$v = @rmdir($dir);
		return true;
	}

}
?>