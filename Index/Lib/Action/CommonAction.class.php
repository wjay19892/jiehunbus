<?php
class CommonAction extends Action
{
	public $memberinfo = null;
	function _initialize() {
		if(C('sysconfig.site_closed') == 1){
			$this->display('Public:site_closed');
			exit();
		}else{ 
		    if(C('sysconfig.site_wap_open') == 1 && C('sysconfig.site_wap_forward') == 1){
			    if(checkmobile()){
					redirect(HTTP_URL."/wap.php");
					exit();
				}
		    }
			import('@.ORG.ShoppingCart');
			//公用函数
			$this->_shoppingCart();
			$this->_islogin();
			$this->_link();
			$this->_navigation();
			$this->locateInit();
			$this->_switchRegion();
			$this->_collection();
			$this->_footerArticle();
			if(C('sysconfig.is_open_chat') == 1){
				$this->_setMemberStatus();
			}
		}
	}
	
	protected function _collection(){
		if(!empty($this->memberinfo)){
			$collection = D('Collection');
			$collectionmap = array(
					'uid'=>array('eq',$this->memberinfo['id']),
			);
			$collection_arr = $collection->getGatherArr($collectionmap,'gid');
			$this->assign('collection_arr',$collection_arr);
		}
	}
	protected function _shoppingCart(){
		$data = ShoppingCart::getVal();
		$num = 0;
		if(!empty($data)){
			foreach ($data as $value){
				$num +=$value['num'];
				$cart[] = $value['id'];
			}
		}
		$this->assign('shoppingCartId',$cart);
		$this->assign('shoppingCartNum',$num);
	}
	
	protected function _link(){
		$link = D('Link');
		$map['status'] = array('eq',1);
		$linkdata = $link->getData($map);
		$this->assign('linkdata',$linkdata);
	}
	
	protected function _navigation(){
		$navigation = D('Navigation');
		$map['status'] = array('eq',1);
		$map['type'] = array('eq',3);
		$footernav = $navigation->getData($map);
		$this->assign('footernav',$footernav);
		$map['status'] = array('eq',1);
		$map['type'] = array('eq',1);
		$mainnav = $navigation->getData($map);
		$this->assign('mainnav',$mainnav);
	}
	
	protected function _setMemberStatus(){
		$check = isOnlineCheck();
		if($check){
			$online = S('online');
			if(!empty($online)){
				foreach($online as $key=>$value){
					if($value < $check){
						$tmp[] = $key;
					}
				}
				if(empty($tmp)){
				   $tmp =  array_keys($online);
				}
				removeOnline($tmp,false);
			}
			S('online_check',time());
		}
	}
	//检查登录并把会员信息输出
	protected function _islogin(){
	    $member = D('Member');
		if(isset($_COOKIE['islogin']) && isset($_COOKIE['mb_id'])){
		    $islogin = intval($_COOKIE['islogin']);
		    if($islogin==1){
				$memberdata = $member->getOne(getMemberId());
				if(!empty($memberdata)){
					$memberdata['favorites'] = $member->getFavoritesNum($memberdata['id']);
					$memberdata['message'] = $member->getMessageNum($memberdata['id']);
					$memberdata['attention_ids'] = $member->getAttentionIds($memberdata['id']);
					$memberdata['friends_ids'] = $member->getFriendsIds($memberdata['id']);
					if(C('sysconfig.site_mb_autoreg')==1 && $memberdata['mailstatus']==0){
						$memberdata['step'] = 1;
					}
					if(C('sysconfig.is_open_chat') == 1){
						setOnline($memberdata['id']);
					}
				}
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
		$this->assign('memberdata',$memberdata);
	}
	
	protected function page($count,$listRows = false,$map = array()){
		$limit = '';
		if ($count > 0) {
			import ( "ORG.Util.Page" );
			if(!$listRows){
				$listRows = C('sysconfig.site_page_listrows');
				if(!$listRows){
					$listRows = '';
				}
			}
			$p = new Page ( $count, $listRows );
			$p->setConfig('theme','%first% %upPage% %prePage% %linkPage% %nextPage% %downPage% %end%');
			$p->setConfig('prev','<');
			$p->setConfig('next','>');
			$p->setConfig('first','|<<');
			$p->setConfig('last','>>|');
			$limit = $p->firstRow.','.$p->listRows;
			foreach ( $map as $key => $val ) {
				if (! is_array ( $val )) {
					$p->parameter .= "$key=" . urlencode ( $val ) . "&";
				}
			}
			//分页显示
			$page = $p->show ();
			//模板赋值显示
			$this->assign ( 'para', $p->parameter );
			$this->assign ( "page", $page );
		}
		return $limit;
	}
	
	protected function onPayment(){
		//支付方式
 		$payment = D('Payment');
		$paymentmap['status'] = array('eq',1);
		$paymentdata = $payment->getData($paymentmap);
 		$this->assign('paymentdata',$paymentdata);
	}
	
	public function verify()
    {
        import("ORG.Util.Image");
        Image::buildImageVerify(4,1);
    }
    
    protected function checkVerify(){
    	if(empty($_REQUEST['verify'])){
    		$this->error(L('verification_code_not_null'));
    	}
    	
    	if(md5($_REQUEST['verify']) != $_SESSION['verify']){
    		$this->error(L('verification_code_error'));
    	}
    }
	//生成二位码
	public function qrcode(){
		/* end */
	    header('Content-Type: text/html; charset=UTF-8'); 
	    ob_get_clean();
		$sn = $_REQUEST['sn'];
		$pw = $_REQUEST['pw'];
		$date = L('voucher_sn').':'.$sn.L('voucher_pass').':'.$pw;
		
	    import('@.ORG.PHPQRcode');
		PHPQRcode::png($date,$path);
	}
	
	protected function locateInit(){
		$locate = getCrrLatlng();
		if(!empty($this->memberinfo)){
			//设置用户的位置
			$member_location = D ('Member_location');
			$map['uid'] = array('eq',$this->memberinfo['id']);
			$map['type'] = array('eq',1);
			$locationdata = $member_location->getOne($map);
			if(empty($locationdata)){
				$map['type'] = array('eq',0);
				$locationdata = $member_location->getOne($map);
			}
			if($locate['address'] != $locationdata["address"]){
				$latlng["lat"] = floatval($locationdata["lat"]);
				$latlng["lng"] = floatval($locationdata["lng"]);
				$latlng["address"] = $locationdata["address"];
				setCrrLatlng($latlng);
				$locate = $latlng;
			}
		}
		if(empty($locate)){
			$latlng = getIpLatlng();
			setCrrLatlng($latlng);
			$this->assign('locate',$latlng);
		}else{
			$this->assign('locate',$locate);
		}		
	}
	protected function _nearby(){
		$locate = getCrrLatlng();
		if(!empty($locate)){
			$goods = D('Goods');
			$map = $goods->_defaultWhere();
			$nerbygoods = $goods->getNearby($locate,$map,7);
			$this->assign('nerbygoods',$nerbygoods);
		}
	}
	
	protected function _newGoods(){
		$goods = D('Goods');
		$map = $goods->_defaultWhere();
		$newgoods = $goods->getDataAll($map,10,'id desc');
		$this->assign('newgoods',$newgoods);
	}
	
	protected function _newComment(){
		$comment = D('Comment');
		$goods = D('Goods');
		$member = D('Member');
		$newcomment = $comment->getNewComment(10);
		foreach ($newcomment as &$value){
			$value['reviewer'] = $member->getOne($value['reviewer']);
			$value['evaluate'] = $goods->getEvaluate($value['gid']);
		}
		$this->assign('newcomment',$newcomment);
	}
	
	protected function _sortGoods(){
		$goods = D('Goods');
		$map = $goods->_defaultWhere();
		$sortgoods = $goods->getRecommend($map);
		$this->assign('sortgoods',$sortgoods);
	}
	
	protected function _weekRanking(){
		$order_details = D('Order_details');
		$week = aweek();
		$order_detailsmap['addtime'] = array('gt',$week['start']);
		$order_detailsdata = $order_details->field('sum(num) as sumnum,gid')->group('gid')->order('sumnum desc')->limit(5)->findAll();
		foreach ($order_detailsdata as $value){
			$ids[] = $value['gid'];
		}
		$goods = D('Goods');
		$map = $goods->_defaultWhere();
		$map['id']=array('in',$ids);
		$weekrankingdata = $goods->getDataAll($map);
		$this->assign('weekrankingdata',$weekrankingdata);
	}
	
	protected function _categoryDefault(){
		$goods_category = D('Goods_category');
		$default_category = $goods_category->getDefault();
		$this->assign('default_category',$default_category);
	}
	
	protected function _categoryRegion(){
		if(!C('sysconfig.is_switch_region')){
			$region = D('Region');
			$default_region = $region->getDefault();
			$this->assign('default_region',$default_region);
		}
	}
	
	protected function _switchRegion(){
		if(C('sysconfig.is_switch_region')){
		    $data = Init_GP(array('spelling'));
			$region = D('Region');
			//$data['default'] = $region->getDefault();
			//$data['all'] = $region->getData('','','`letter` asc');
			if(!empty($data['spelling'])){
				$map['spelling'] = array('eq',$data['spelling']);
				$arr = $region->field('id,name,spelling')->where($map)->find();
				$arr = setDefaultRegion($arr);
			}
			if(empty($arr)){
				$arr = getDefaultRegion();
				if(empty($arr)){
					$arr['name'] = IP($ip);
					$map['level'] = array('eq',1);
					$arr = $region->field("id,name,spelling,LOCATE(`name`,'{$arr['name']}') as c")->where($map)->order('c desc')->find();
					$arr = setDefaultRegion($arr);
				}
			}
			$data['crr'] =  $arr; 
			$this->assign('switch_region',$data);
		}
	}
	
	protected function _recentlyTalk_about(){
		$talk_about = D('Talk_about');
		$recentlyTalk_about = $talk_about->getDataAll(null,3);
		$this->assign('recentlyTalk_about',$recentlyTalk_about);
	}
	
	protected function _announcement(){
		$article = D('Article');
		$announcement = $article->getCategoryArticle(2,4);
		$this->assign('announcement',$announcement);
	}
	
	protected function _footerArticle(){
		$articles_category = D('Articles_category');
		$article = D('Article');
		$articles_categorymap['pid'] = array('eq',1);
		$footerArticle = $articles_category->getData($articles_categorymap,10);
		foreach ($footerArticle as &$value){
			$map['cid'] = array('eq',$value['id']);
			$value['article'] = $article->getdata($map);
		}
		$this->assign('footerArticle',$footerArticle);
	}

	protected function _check_business(){
		if($this->memberinfo['isbusiness'] == 0){
			$this->error('请申请商家后操作');
		}
	}
	
}