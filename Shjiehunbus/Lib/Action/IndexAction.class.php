<?php
class IndexAction extends CommonAction {
	
	// 框架首页
	public function index() {
		if (isset ( $_SESSION [C ( 'USER_AUTH_KEY' )] )) {
			//显示菜单项
			$topmenu = array ();
			
			$Groups_nav	=	D("Groups_nav");
			$topmenu	=	$Groups_nav->where('status=1')->order('sort')->select();
			$this->assign('topmenu',$topmenu);
			$topmenuid = $topmenu[0]['id'];
			$this->assign('topmenuid',$topmenuid);
			
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
			
			//显示提示信息
			//未处理的投诉
			$complaint = D('Complaint');
			$complaintmap['status'] = array('eq',0);
			$complaintCount = $complaint->where($complaintmap)->count();
			$this->assign ( 'complaintCount', $complaintCount );
			
			//未处理的发布信息
			$goods = D('Goods');
			$releasemap['audit'] = array('eq',1);
			$releaseCount = $goods->where($releasemap)->count();
			$this->assign ( 'releaseCount', $releaseCount );
			
			//未处理的提现
			$withdraw = D('Withdraw');
			$withdrawmap['status'] = array('eq',0);
			$withdrawCount = $withdraw->where($withdrawmap)->count();
			$this->assign ( 'withdrawCount', $withdrawCount );
			
			//未处理的退款
			$refunds = D('Order_details');
			$refundsmap['refund_state'] = array('eq',1);
			$refundsCount = $refunds->where($refundsmap)->count();
			$this->assign ( 'refundsCount', $refundsCount );
		}
		$this->display ();
	}

}
?>