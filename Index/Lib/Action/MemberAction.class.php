<?php
// 本文档自动生成，仅供测试运行
class MemberAction extends CommonAction
{
	public function _initialize() {
		parent::_initialize();
		if(empty($this->memberinfo)){
			if($this->isAjax()){
				$this->error(L('not_logged'));
			}else{
				$this->redirect('User/signin');
			}
		}else{
			if(C('sysconfig.site_mb_autoreg')==1 && $this->memberinfo['mailstatus']==0){
				$this->redirect('User/noverifymail');
			}
		}
		$this->getAllNum();
		$this->oftenLabel();
		$this->_apply_business();
	}

	protected function _apply_business(){
		if($this->memberinfo['isbusiness'] == 0){
			$apply = D('Apply');
			$map = array(
				'uid'=>array('eq',$this->memberinfo['id']),
				'status'=>array('eq',0),
			);
			if($apply->isExist($map)){
				$this->assign('applying',true);
			}
		}
	}
	
	//获取常用标签
	protected function oftenLabel(){
		//获取常用的 20个标签
		$member_label = D('Member_label');
		$map['uid'] = array('eq',$this->memberinfo['id']);
		$oftenLabel = $member_label->getUserLabel($map,20);
		$this->assign('oftenLabel',$oftenLabel);
		
		$circle = D('Circle');
		$circlestr = $circle->getGather('','lids');
		//获取所有属于圈子的我的标签
		$map['lid'] = array('in',$circlestr);
		$mycircle = $member_label->getUserLabel($map,20);
		$this->assign('mycircle',$mycircle);
		//获取所有 不属于圈子的我的标签
		$map['lid'] = array('not in',$circlestr);
		$mylabel = $member_label->getUserLabel($map,20);
		$this->assign('mylabel',$mylabel);
	}
	
	public function step(){
		$member = D('Member');
		$membermap['id'] = array('eq',$this->memberinfo['id']);
		$member->where($membermap)->setField('step',1);
		$this->display();
	}
	
	public function labelAdds(){
		$data = Init_GP(array('lids'));
		$lids = array_unique($data['lids']);
		$member_label = D('Member_label');
		foreach ($data['lids'] as $value){
			$value = intval($value);
			if($value){
				$member_labeldata[] = array(
					'uid'=>$this->memberinfo['id'],
					'lid'=>$value,
				);
			}
		}
		$map['uid'] = array('eq',$this->memberinfo['id']);
		$member_label->where($map)->delete();
		if($member_labeldata){
			$info = $member_label->addAll($member_labeldata);
			if($info){
				$this->success(L('operational_success'));
			}else{
				$this->error(L('operational_error'));
			}
		}else{
			$this->error(L('operational_error'));
		}
	}
	
	//一起收听所有用户
	public function togetherListen(){
		$data = Init_GP(array('uids'));
		$uids = explode(',', $data['uids']);
		$uids = array_unique($uids);
		$attention = D('Attention');
		$attentionmap['main'] = array('eq',$this->memberinfo['id']);
		$attentionmap['was'] = array('in',$uids);
		$strids = $attention->getGather($membermap,'was');
		$ids = explode(',', $strids);
		$arr = array_diff($uids, $ids);
		$time = time();
		foreach($arr as $value){
			$value = intval($value);
			if($value){
				$attentiondata[] = array(
						'main'=>$this->memberinfo['id'],
						'was'=>$value,
						'updatetime'=>$time,
				);
			}
		}
		$info = $attention->addAll($attentiondata);
		if($info){
			$this->success(L('member_attention_success'));
		}else{
			$this->error(L('member_attention_error'));
		}
	}
	
	//获取相同爱好的用户 18个
	public function sameHobby(){
		$member_label = D('Member_label');
		$member_labelmap['uid'] = array('eq',$this->memberinfo['id']);
		$myhobby = $member_label->getGather($member_labelmap,'lid');
		$hobbymap = array(
				'uid'=>array('neq',$this->memberinfo['id']),
				'lid'=>array('in',$myhobby),
		);
		$memberids = $member_label->getGather($hobbymap,'uid');
		$arr = explode(',', $memberids);
		$arr = array_unique($arr);
		$member = D('Member');
		$membermap['id'] = array('in',$arr);
		$users = $member->getDataAll($membermap,18,'rand()');
		$this->assign('users',$users);
		$this->display();
	}
	
	protected function getAllNum(){
		$member = D('Member');
		$data = $member->getAllNum($this->memberinfo['id']);
		$this->assign('allNum',$data);
	}
	//首页
    public function index(){
		/*$message = D('Message');
		//获取最新网站通知
	    $sitemap = array(
			'M.receive' =>array('eq',$this->memberinfo['id']),
			'M.type' =>array('eq',1),
			'M.mark' =>array('eq',0),
		);
		$sitecount = $message->getCount($sitemap);
		$sitemessages = $message->getMessageData($sitemap);
		//获取最新用户短信息
	    $mebmap = array(
			'M.receive' =>array('eq',$this->memberinfo['id']),
			'M.type' =>array('eq',0),
			'M.mark' =>array('eq',0),
		);
		$mebcount = $message->getCount($mebmap);
		$mebmessages = $message->getMessageData($mebmap);
		
		$remind = D('Remind');
		//获取用户最新提醒
		$remindbmap = array(
			'uid' =>array('eq',$this->memberinfo['id']),
			'new' =>array('eq',1),
		);
		$remindcount = $remind->getCount($remindbmap);
		$mebreminds = $remind->getDataAll($remindbmap);
		if(!empty($mebreminds)){
			foreach($mebreminds as $value){
			    $map['id'] = array('eq',$value['id']);
			    $succ = $remind->where($map)->setField('new',0);
			}
		}
		if($remindcount<10){
			$allmap = array(
				'uid' =>array('eq',$this->memberinfo['id']),
			);
		   $mebreminds = $remind->getDataAll($allmap,10);
		}
		$this->assign('sitecount',$sitecount);
		$this->assign('sitemessages',$sitemessages);
		$this->assign('mebcount',$mebcount);
		$this->assign('mebmessages',$mebmessages);
		$this->assign('remindcount',$remindcount);
		$this->assign('mebreminds',$mebreminds);*/
		$this->display();
    }
	//邀请好友
	public function invite(){
	    $config = C('sysconfig');
		$message_tpl = D('Message_tpl');
		
		$invitename = $message_tpl->getBody('shareinvite'); //选择模板
		$invitename = str_replace('[webname]',$config['site_name'], $invitename );
		$invite_urllink = HOST.U('Index/invite/inviteid/'.$this->memberinfo['id']);
		$invite_name = urlencode($invitename);
		$invite_pic = HOST.__ROOT__.$config['site_logo'];
		
		
		$invitemail = $message_tpl->getBody('invitemail'); //选择模板
		$invitemail = str_replace('[user]',$this->memberinfo['name'], $invitemail);
		$invitemail = str_replace('[webname]',$config['site_name'], $invitemail);
		$invitemail = str_replace('[webdesc]',$config['site_description'], $invitemail);
		$invitemail = str_replace('[verifycredits]',$config['site_mb_verifycredits'], $invitemail);
		$invitemail = str_replace('[creditsname]',$config['site_credits_name'], $invitemail);
		$invitemail = str_replace('[ordercredits]',$config['site_mb_ordercredits'], $invitemail);
		$invitemail = str_replace('[url]',$invite_urllink, $invitemail);
				
		$this->assign('invite_urllink',$invite_urllink);
		$this->assign('invite_name',$invite_name);
		$this->assign('invite_pic',$invite_pic);
		$this->assign('invitemail',$invitemail);
		$this->display();
    }
	//邮件邀请好友
	public function invite_emails(){
	    $data = Init_GP(array('friends','email_text'));
		$friends = $data['friends'];
		$config = C('sysconfig');
		//dump($friends);
		$header = L('member_invite_emails_header');
		$header = $config['site_name'].$header;
		$emails = array();
		foreach($friends as $value){
		  if(!empty($value) && preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',$value))$emails[] = $value;
		}
		if(empty($emails)) $this->error(L('member_invite_emails_mail_error'));
		
		$config = C('sysconfig');
		$invite_urllink = HOST.U('Index/invite/inviteid/'.$this->memberinfo['id']);
		$message_tpl = D('Message_tpl');
		$invitemail = $message_tpl->getBody('invite'); //选择模板
		$invitemail = str_replace('[user]',$this->memberinfo['name'], $invitemail);
		$invitemail = str_replace('[webname]',$config['site_name'], $invitemail);
		$invitemail = str_replace('[webdesc]',$config['site_description'], $invitemail);
		$invitemail = str_replace('[verifycredits]',$config['site_mb_verifycredits'], $invitemail);
		$invitemail = str_replace('[creditsname]',$config['site_credits_name'], $invitemail);
		$invitemail = str_replace('[ordercredits]',$config['site_mb_ordercredits'], $invitemail);
		$invitemail = str_replace('[url]',$invite_urllink, $invitemail);
		
		$info = sendMail($emails,$header,$invitemail);
		$this->success(L('member_invite_emails_success'));
    }
    //收件箱
    public function inbox(){
	    $data = Init_GP(array('filter','content','sendname'));
		$filter = $data['filter'];
		$content = $data['content'];
		$sendname = $data['sendname'];
		$message = D('Message');
		//获取最新用户短信息
	    $mebmap = array(
			'M.receive' =>array('eq',$this->memberinfo['id']),
		);
		$sitemap = array(
			'M.receive' =>array('eq',$this->memberinfo['id']),
			'M.type' =>array('eq',1),
		);
		$friendsmap = array(
			'M.receive' =>array('eq',$this->memberinfo['id']),
			'M.type' =>array('eq',0),
		);
		$unreadmap = array(
			'M.receive' =>array('eq',$this->memberinfo['id']),
			'M.mark' =>array('eq',0),
		);
		if(!empty($content)){
			$mebmap['M.content'] = array('like','%'.$content.'%');
			$sitemap['M.content'] = array('like','%'.$content.'%');
			$friendsmap['M.content'] = array('like','%'.$content.'%');
			$unreadmap['M.content'] = array('like','%'.$content.'%');
		}
		if(!empty($sendname)){
			$mebmap['ME.name'] = array('like','%'.$sendname.'%');
			$sitemap['ME.name'] = array('like','%'.$sendname.'%');
			$friendsmap['ME.name'] = array('like','%'.$sendname.'%');
			$unreadmap['ME.name'] = array('like','%'.$sendname.'%');
		}
		$mebcount = $message->getCount($mebmap);
		$sitecount = $message->getCount($sitemap);
		$friendscount = $message->getCount($friendsmap);
		$unreadcount = $message->getCount($unreadmap);
		if($filter=="all"){
			$count = $mebcount;
		    $map = $mebmap;
		}elseif($filter=="site"){
			$count = $sitecount;
		    $map = $sitemap;
		}elseif($filter=="friends"){
			$count = $friendscount;
		    $map = $friendsmap;
		}elseif($filter=="unread"){
			$count = $unreadcount;
		    $map = $unreadmap;
		}else{
			$count = $mebcount;
		    $map = $mebmap;
		}
		$limit=$this->page($count,'',$data);
		$mebmessages = $message->getMessageData($map,$limit);
		
		$this->assign('filter',$filter);
		$this->assign('content',$content);
		$this->assign('sendname',$sendname);
		$this->assign('mebcount',$mebcount);
		$this->assign('sitecount',$sitecount);
		$this->assign('friendscount',$friendscount);
		$this->assign('unreadcount',$unreadcount);
		$this->assign('mebmessages',$mebmessages);
		$this->display();
    }
	//查看短消息
	public function viewpm(){
	    $data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		
		$message = D('Message');
		$mebmessage = $message->getOne($id);
		if($mebmessage['receive'] != $this->memberinfo['id'])$this->error(L('operational_error'));
		$map['id'] = array('eq',$id);
		$succ = $message->where($map)->setField('mark',1);
		
		$this->assign('mebmessage',$mebmessage);
	    $this->display();
    }
	//发送短消息
	public function sendpm(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		if(empty($id)){
			
			//获得好友分组
			$friends_group = D('Friends_group');
			$friendgroups = $friends_group->getFriendsGroupData($this->memberinfo['id']);
			
			//获得所有好友
			$friends = D('Friends');
			$mebfriends = $friends->getFriendsData($this->memberinfo['id']);
			$this->assign('friendgroups',$friendgroups);
			$this->assign('mebfriends',$mebfriends);
			$this->success($this->fetch());
		}else{
			if($id==$this->memberinfo['id']){
				$this->error(L('member_sendpm_error'));
			}
			$member = D('Member');
		    $membinfo = $member->getOne($id);
			$this->assign('membinfo',$membinfo);
			$this->success($this->fetch('meb_sendpm'));
		}
    }
	//获取好友列表
	public function getfriends(){
		$data = Init_GP(array('type'));
		$type = GetNum($data['type']);
		$map = array();
		if(!empty($type)){
			$map["F.gid"] = array('eq',$type);
		}
	    $friends = D('Friends');
		$mebfriends = $friends->getFriendsData($this->memberinfo['id'],$map);
		$html="";
		foreach($mebfriends as $value){
		  $html .= '<li class="clearfix"><input class="jvf_fl" type="checkbox" id="fsid_'.$value['friend'].'" value="'.$value['friend'].'" name="receive[]"><label class="jvf_lin" for="fsid_'.$value['friend'].'">'.$value['friendname'].'</label></li>';
		}
		echo $html;
    }
    //回复短消息
	public function replypm(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		
		$message = D('Message');
		$mebmessage = $message->getOne($id);
		if($mebmessage['receive'] != $this->memberinfo['id'])$this->error(L('operational_error'));
		$this->assign('mebmessage',$mebmessage);
	    $this->display();
    }
	//发送短消息操作
	public function pmsend(){
	    $data = Init_GP(array('name','receive','content'));
		$receive = $data['receive'];
		$message = D('Message');
				    
		if(is_array($receive)){
			foreach($receive as $value){
			    $pmsdata = array(
					'send'=>$this->memberinfo['id'],
					'receive'=>$value,
					'content'=>$data['content'],
				);
				$messagedata[] = $message->create($pmsdata);
			}
			$info = $message->addAll($messagedata);
			if($info){
				$this->success(L('send_success'));
			}else{
				$this->error(L('send_error'));
			}
		}else{		    
			$data['send'] = $this->memberinfo['id'];
			$info = $message->insert($data);
			if($info){
				$this->success(L('send_success'));
			}else{
				$this->error(L('send_error'));
			}
		} 
    }	
	//删除短消息操作
	public function deletepm(){
	    $data = Init_GP(array('id'));
		$id = $data['id'];
		$message = D('Message');
		if(empty($id)){
		    $this->error(L('member_deletepm_empty_id'));
		}
		if(is_array($id)){
			$map['id'] = array('in', implode(',',$id));
			$map['receive'] = array('eq', $this->memberinfo['id']);
			$info = $message->where($map)->delete();
			if($info){
				$this->success(L('delete_success'));
			}else{
				$this->error(L('delete_error'));
			}
		}else{
		    $mebmessage = $message->getOne($id);
		    if($mebmessage['receive'] != $this->memberinfo['id'])$this->error(L('operational_error'));
			$info = $message->delete($id);
			if($info){
				$this->success(L('delete_success'));
			}else{
				$this->error(L('delete_error'));
			}
		} 
    }
    // 准备收藏页面
    public function addFavorites(){
    	$data = Init_GP(array('id'));
    	$id = intval($data['id']);
    	$goods = D('Goods');
    	$goodsdata = $goods->getOne($id);
    	if(empty($goodsdata)){
    		$this->error(L('goods_not_exist'));
    	}
		if($goodsdata['promulgator']['id']==$this->memberinfo['id']){
    		$this->error(L('goods_is_own'));
		}
    	$this->assign('goodsdata',$goodsdata);
    	$this->display();
    }
    //收藏商品
    public function saveFavorites(){
    	$data = Init_GP(array('gid','ispublic','remark'));
    	$gid = $data['gid'] = GetNum($data['gid']);
    	$goods = D('Goods');
    	if(!$goods->isExist($gid)){
    		$this->error(L('goods_not_exist'));
    	}
    	$collection = D('Collection');
    	$collectionmap = array(
    		'uid'=>array('eq',$this->memberinfo['id']),
    		'gid'=>array('eq',$gid),
    	);
    	
    	if($collection->isExist($collectionmap)){
    		$this->success(L('member_savefavorites_isexist'));
    	}
    	
    	$data['uid'] = $this->memberinfo['id'];
    	$info = $collection->insert($data);
    	if($info){
    		$this->success(L('member_savefavorites_success'));
    	}else{
    		$this->error(L('member_savefavorites_error'));
    	}
    	
    }
    //删除收藏
	public function removeFavorites(){
		$data = Init_GP(array('gid'));
    	$id = GetNum($data['gid']);
    	$goods = D('Goods');
    	if(!$goods->isExist($id)){
    		$this->error(L('goods_not_exist'));
    	}
    	$collection = D('Collection');
    	$collectionmap = array(
    		'uid'=>array('eq',$this->memberinfo['id']),
    		'gid'=>array('eq',$id),
    	);
    	$info = $collection->where($collectionmap)->delete();
    	if($info){
    		$this->success(L('delete_success'));
    	}else{
    		$this->error(L('delete_error'));
    	}
    }
    
    //举报
    public function report(){
    	//获取举报项
    	$complaint_item = D('Complaint_item');
    	$complaint_item_data = $complaint_item->getData();
    	$this->assign('complaint_item_data',$complaint_item_data);
    	$this->display();
    }
    
    //举报提交
    public function complaint(){
    	$data = Init_GP(array('gid','item','other'));
    	$gid = $data['gid'] = GetNum($data['gid']);
    	$goods = D('Goods');
    	if(!$goods->isExist($gid)){
    		$this->error(L('goods_not_exist'));
    	}
    	$complaint = D('Complaint');
    	$complaintmap = array(
    		'uid'=>array('eq',$this->memberinfo['id']),
    		'gid'=>array('eq',$gid),
    	);
    	
    	if($complaint->isExist($complaintmap)){
    		$this->success(L('member_complaint_isexist'));
    	}
    	
    	$data['uid'] = $this->memberinfo['id'];
    	$info = $complaint->insert($data);
    	if($info){
    		$this->success(L('member_complaint_success'));
    	}else{
    		$this->error(L('member_complaint_error'));
    	}
    }
    //加为好友
	public function addfriend(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		if($id==$this->memberinfo['id']){
			$this->error(L('addfriend_self'));
		}
		$friends_request = D('Friends_request');
		$requestmap['friend']  = array('eq',$id);
		$friends_requestdata = $friends_request->getFriendsrequestData($this->memberinfo['id'],$requestmap);
		
		if(!empty($friends_requestdata)){
			$this->error(L('member_addfriend_error'));
		}
		
		$friends_group = D('Friends_group');
		$friendgroups = $friends_group->getFriendsGroupData($this->memberinfo['id']);
		
		$member = D('Member');
		$frienddata = $member->getOne($id);
		
		$this->assign('friendgroups',$friendgroups);
		$this->assign('frienddata',$frienddata);
	    $this->success($this->fetch());
    }
	//发送请求
	public function addfriends_request(){
		$data = Init_GP(array('friend','gid','note'));
		
		$data['main'] = $this->memberinfo['id'];
		$data['friend'] = GetNum($data['friend']);
		$data['gid'] = GetNum($data['gid']);
		$data['note'] = $data['note'];
		$data['addtime'] = time();
		$friends_request = D('Friends_request');
		$info = $friends_request->insert($data);
		
		if($info){
		    $remind = D('Remind');
			$reinfo = $remind->addRemind($data['friend'],$this->memberinfo['id'],'friend_request',0,$data['note']);
			
			if($reinfo)$this->success(L('member_addfriends_request_success'));
			else{
			    $friends_request->delete($data); 
				$this->error(L('member_addfriends_request_error'));
			}
		}else $this->error(L('member_addfriends_request_error'));
    }
	//打开好友申请	
	public function friendadd(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		if($id==$this->memberinfo['id']){
			$this->error(L('addfriend_self'));
		}
		$friends_request = D('Friends_request');
		$requestmap['friend']  = array('eq',$this->memberinfo['id']);
		$friends_requestdata = $friends_request->getFriendsrequestData($id,$requestmap);
		
		if(empty($friends_requestdata)){
			$this->error(L('member_friendadd_error'));
		}
		
		$friends_group = D('Friends_group');
		$friendgroups = $friends_group->getFriendsGroupData($this->memberinfo['id']);
		
		$member = D('Member');
		$frienddata = $member->getOne($id);
		
		$this->assign('friendgroups',$friendgroups);
		$this->assign('frienddata',$frienddata);
	    $this->display();
    }
    //批准申请	
	public function agree_addfriend(){
		$data = Init_GP(array('friend','gid','friendname'));
		
		$id = GetNum($data['friend']);
		if($id==$this->memberinfo['id']){
			$this->error(L('addfriend_self'));
		}
		
		$friends_request = D('Friends_request');
		$requestmap['friend']  = array('eq',$this->memberinfo['id']);
		$friends_requestdata = $friends_request->getFriendsrequestData($id,$requestmap);
		if(empty($friends_requestdata)){
			$this->error(L('member_agree_addfriend_notexist'));
		}
		
		$friends = D('Friends');
		$friendsmap['F.friend'] = array('eq',$this->memberinfo['id']);
		$mebfriends = $friends->getFriendsData($id,$friendsmap);
		$myfriendsmap['F.friend'] = array('eq',$id);
		$mymebfriends = $friends->getFriendsData($this->memberinfo['id'],$myfriendsmap);
		if(!empty($mebfriends) && !empty($mymebfriends)){
		    $this->error(L('member_agree_addfriend_already'));
		}
		if(empty($mebfriends)){
			$friendsdata['main'] = $id;
			$friendsdata['friend'] = $this->memberinfo['id'];
			$friendsdata['gid'] = $friends_requestdata[0]['gid'];
			$friendsdata['addtime'] = time();
			$finfo = $friends->add($friendsdata);
		}
		if(empty($mymebfriends)){
			$data['main'] = $this->memberinfo['id'];
			$data['friend'] = $id;
			$data['gid'] = GetNum($data['gid']);
			$data['addtime'] = time();
			$info = $friends->add($data);
		}
		if($finfo || $info){
		    $friends_request->delRrequest($id,$requestmap);
			
		    $remind = D('Remind');
			$remindmap['uid'] = array('eq',$this->memberinfo['id']);
			$remindmap['opposite'] = array('eq',$id);
			$remindmap['type'] = array('eq','friend_request');
			$remind->where($remindmap)->delete();
			$reinfo = $remind->addRemind($id,$this->memberinfo['id'],'friend');
			$member_feed = D('Member_feed');
			$tip = $member_feed->addFeed($this->memberinfo['id'],'friend',$id,'Member');
			if($reinfo)$this->success($data['friendname'].L('member_agree_addfriend_success'));
			else{
			    $friends_request->delete($data); 
				$this->error(L('member_agree_addfriend_error'));
			}
		}else $this->error(L('member_agree_addfriend_error'));
    }
	//解除好友
	public function removefriend(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		
		$friends = D('Friends');
		$friendsmap['F.friend'] = array('eq',$this->memberinfo['id']);
		$mebfriends = $friends->getFriendsData($id,$friendsmap);
		$myfriendsmap['F.friend'] = array('eq',$id);
		$mymebfriends = $friends->getFriendsData($this->memberinfo['id'],$myfriendsmap);
		
		if(empty($mebfriends) && empty($mymebfriends)){
		    $this->error(L('del_friend_successed'));
		}else{
		    $frimap['main'] = array('eq',$id);  
		    $frimap['friend'] = array('eq',$this->memberinfo['id']);
		    $myfrimap['main'] = array('eq',$this->memberinfo['id']);  
		    $myfrimap['friend'] = array('eq',$id);
		    $friends->where($frimap)->delete();
			$friends->where($myfrimap)->delete();
		    $this->success(L('del_friend_success'));
		}
	}	
	//关注
	public function attention(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		if($id==$this->memberinfo['id']){
			$this->error(L('member_attention_self'));
		}
		$member = D('Member');
		$membinfo = $member->getOne($id);
		
		$attention = D('Attention');
		$attentionsmap['A.main'] = array('eq',$this->memberinfo['id']);
		$mebattentions = $attention->getAttentionsData($id,$attentionsmap);
		
		if(!empty($mebattentions)){
		    $this->error(L('member_attention_already').$membinfo['name']);
		}else{
		    $attentiondata = array(
				'main'=>$this->memberinfo['id'],
				'was'=>$id,
				'updatetime'=>time(),
			);
		    $info = $attention->add($attentiondata);
			if($info){
				$remind = D('Remind');
				$reinfo = $remind->addRemind($id,$this->memberinfo['id'],'attention');
				$member_feed = D('Member_feed');
			    $tip = $member_feed->addFeed($this->memberinfo['id'],'attention',$id,'Member');
				$this->success(L('member_attention_success').$membinfo['name']);
			}else{
			    $this->error(L('member_attention_error').$membinfo['name']);
			}
		}
	}
	//取消关注
	public function removeattention(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		
		$member = D('Member');
		$membinfo = $member->getOne($id);
		
		$attention = D('Attention');
		$attentionsmap['A.main'] = array('eq',$this->memberinfo['id']);
		$mebattentions = $attention->getAttentionsData($id,$attentionsmap);
		
		if(empty($mebattentions)){
		    $this->error(L('member_removeattention_already').$membinfo['name']);
		}else{
		    $attmap['main'] = array('eq',$this->memberinfo['id']);
			$attmap['was'] = array('eq',$id);  
		    $attention->where($attmap)->delete();
		    $this->success(L('member_removeattention_success').$membinfo['name']);
		}
	}
	//联系我
	public function callMe(){
    	$data = Init_GP(array('id'));
    	$this->assign('id',GetNum($data['id']));
    	$this->display();
	}
	//删除评论
	public function delComment(){
		$data = Init_GP(array('id'));
		$id = GetNum($data['id']);
		$comment = D('Comment');
		$commentdata = $comment->getOne($id);
		if($commentdata['reviewer']['id'] != $this->memberinfo['id']){
			$this->error(L('illegal_operational'));
		}
		$comment->delete($id);
		$this->success(L('operational_success'));
	}
	//删除评论回复
	public function delComment_reply(){
		$data = Init_GP(array('id'));
		$id = intval($data['id']);
		$comment_reply = D('Comment_reply');
		$comment_replydata = $comment_reply->getOne($id);
		if($comment_replydata['uid']['id'] != $this->memberinfo['id']){
			$this->error(L('illegal_operational'));
		}
		$comment_reply->delete($id);
		$this->success(L('operational_success'));
	}    
	//添加评论回复
	public function addComment_reply(){
		$data = Init_GP(array('content','cid'));
		$cid  = intval($data['cid']);
		if(empty($data['content'])){
			$this->error(L('content_notempty'));
		}
		$comment_reply = D('Comment_reply');
		$comment_replydata = array(
			'cid' =>$cid,
			'uid' => $this->memberinfo['id'],
			'reviewer'=>getParent('Comment',$cid,'reviewer'),
			'content'=>$data['content'],
			'addtime'=>time(),
		);
		$info = $comment_reply->insert($comment_replydata);
		if($info){
		    $remind = D('Remind');
			$gid = getParent('Comment',$cid,'gid');
			$reinfo = $remind->addRemind($comment_replydata['reviewer'],$this->memberinfo['id'],'commentreplyed',$gid);
			$member_feed = D('Member_feed');
			$tip = $member_feed->addFeed($this->memberinfo['id'],'commentreply',$gid,'Goods');
			$v = $comment_reply->getOne($info);
			$this->assign('v',$v);
			$result = $this->fetch('addComment_reply');
			$this->success($result);
		}else{
			$this->error(L('illegal_operational'));
		}
	}	
	//添加评论
	public function addComment(){
		$data = Init_GP(array('content','gid'));
		$gid  = intval($data['gid']);
		if(empty($data['content'])){
			$this->error(L('content_notempty'));
		}
		$comment = D('Comment');
		$comment_data = array(
			'gid' =>$gid,
			'reviewer' => $this->memberinfo['id'],
			'content'=>$data['content'],
			'addtime'=>time(),
		);
		$info = $comment->insert($comment_data);
		if($info){
			$remind = D('Remind');
			$uid = getParent('Goods',$gid,'promulgator');
			$reinfo = $remind->addRemind($uid,$this->memberinfo['id'],'commented',$gid);
			$member_feed = D('Member_feed');
			$tip = $member_feed->addFeed($this->memberinfo['id'],'comment',$gid,'Goods');
			$dtip = $member_feed->addFeed($uid,'commented',$gid,'Goods');
			$vo = $comment->getOne($info);
			$this->assign('vo',$vo);
			$result = $this->fetch('addComment');
			$this->success($result);
		}else{
			$this->error(L('illegal_operational'));
		}
	}
	//聊天
	public function chatBox(){
		if(C('sysconfig.is_open_chat') == 1){
			$chat_log = D('Chat_log');
			$recently =	$chat_log->getRecently($this->memberinfo['id']);
			$this->assign('recently',$recently);
			$friends = D('Friends');
			$data = $friends->getFriendsAll($this->memberinfo['id']);
			$this->assign('data',$data);
			$result = $this->fetch('chatBox');
			$this->ajaxReturn($result);
		}else{
			$this->error(L('operational_error'));
		}
	}

	public function getFriendsStatus(){
		if(C('sysconfig.is_open_chat') == 1){
			$friends = D('Friends');
			$data = $friends->getFriendsData($this->memberinfo['id']);
			foreach($data as $value){
				$result[] = array(
					'uid'=>$value['friend'],
					'online'=>onLineClass($value['online']),
				);
			}
			$this->ajaxReturn($result);
		}else{
			$this->error(L('operational_error'));
		}
	}
	
	public function setOnline(){
		$data = Init_GP(array('info'));
		if($data['info'] !== ''){
			$member = D('Member');
			setOnline($this->memberinfo['id'],$data['info']);
			$this->success(L('member_setonline_success'));
		}else{
			$this->error(L('parameter_error'));
		}
	}
	
	public function getChat_log(){
		$data = Init_GP(array('uid'));
		$uid1 = intval($data['uid']);
		if(!empty($uid1)){
			$uid2 = $this->memberinfo['id'];
			$chat_log = D('Chat_log');
			$logdata = $chat_log->getSides($uid1,$uid2);
			$this->assign('uid',$uid1);
			$this->assign('logdata',$logdata);
			$result = $this->fetch('getChat_log');
			$this->ajaxReturn($result);
		}else{
			$this->error(L('parameter_error'));
		}
	}
	
	public function sendChat(){
		$data = Init_GP(array('uid','content'));
		$uid = intval($data['uid']);
		if(empty($uid)){
			$this->error(L('parameter_error'));
		}elseif(empty($data['content'])){
			$this->error(L('content_notempty'));
		}else{
			$chat_log = D('Chat_log');
			$chat_logdata = array(
				'send'=>$this->memberinfo['id'],
				'receive'=>$uid,
				'content'=>$data['content'],
				'addtime'=>time(),
			);
			$info = $chat_log->insert($chat_logdata);
			if($info){
				$logdata = $chat_log->getOne($info);
				$arr = S("Member_{$uid}");
				
				foreach($arr as &$value){
					$value[] = $logdata;
				}
				S("Member_{$uid}",$arr);
				$this->assign('vo',$logdata);
				$result = $this->fetch('sendChat');
				$this->ajaxReturn($result);
			}else{
				$this->error(L('send_error'));
			}
		}
	}
	
	public function getChatUser(){
		$data = Init_GP(array('uid'));
		$uid = intval($data['uid']);
		if(empty($uid)){
			$this->error(L('parameter_error'));
		}else{
			$member = D('Member');
			$memberdata = $member->getOne($uid);
			if(empty($memberdata)){
				$this->error(L('account_not_exist'));
			}
			$this->assign('vo',$memberdata);
			$result = $this->fetch('getChatUser');
			$this->ajaxReturn($result);
		}
	}
	
	public function clearChatTip(){
		   $key = "Member_{$this->memberinfo['id']}";
		   $ids = implode(',', $arr);
	   	   $chat_log = D('Chat_log');
	   	   $prefix = C('DB_PREFIX');
	   	   $chat_log->query("UPDATE `{$prefix}chat_log` SET `mark` = '1' WHERE `id` in({$ids})");
	   	   S($key,null);
	}
	
	public function otherDynamic(){
		$attention = D('Attention');
		$friends = D('Friends');
		$map['main'] = array('eq',$this->memberinfo['id']);
		$wasids = $attention->getGatherArr($map,'was');
		$friendids = $friends->getGatherArr($map,'friend');
		
		$uids = array_merge($wasids,$friendids);
		if(!empty($uids))$uids = array_unique($uids);
		$member_feed = D('Member_feed');
		$feedsmap['uid'] = array('in',$uids);
		$count = $member_feed->getCount($feedsmap);
		$limit = $this->page($count);
		$feedsdata = $member_feed->getDataAll($feedsmap,$limit);
		$today = strtotime(date('Y-m-d 0:0:0',time()));
		$feeds_list = array();
		if(!empty($feedsdata)){
		$member = D('Member');
		foreach($feedsdata as $value){
		if($value['addtime']>=$today) {
		$dkey = 'today';
		} elseif ($value['addtime']>=$today-3600*24) {
		$dkey = 'yesterday';
		} else {
		$dkey = toDate($value['addtime'], 'Y-m-d');
		}
		$feeds_list[$dkey][$value['uid']]['info'] = $member->getOne($value['uid']);
		$feeds_list[$dkey][$value['uid']]['feed'][$value['id']] = $value;
		}
		}
		$this->assign('feeds_list',$feeds_list);
		$this->display();
	}
	
	//我的关注
	public function listings(){
	    
		$this->display();
	}
	//关注的人
	public function myattention(){
	    $attention = D('Attention');
    	$map = array(
    			'main'=>array('eq',$this->memberinfo['id']),
    	);
		$count = $attention->getCount($map);
    	$limit = $this->page($count); 
		$attentionsdata = $attention->getDataAll($map,$limit);
		$this->assign('attentionsdata',$attentionsdata);
		$this->display();
	}
	//我的好友
	public function friends(){
		$data = Init_GP(array('gid'));
		$gid = "";
		if($data['gid'] !=""){
		    $gid = intval($data['gid']);
			$map['gid'] = array('eq',$gid);
		}
	
		$friends = D('Friends');
		$friends_group = D('Friends_group');
		$friendgroups = $friends_group->getFriendsGroupData($this->memberinfo['id']);
		foreach ($friendgroups as &$value){
			$group_map['gid'] = array('eq',$value['id']);
			$value['count'] = $friends->getCount($group_map);
		}

	    $map['main'] = array('eq',$this->memberinfo['id']);
	    $count = $friends->getCount($map);
	    //统计一共有多少好友
	    $limit = $this->page($count,'',$data);
    	$friendsdata = $friends->getDataAll($map,$limit);
        unset($map['gid']);
	    $total = $friends->getCount($map);
		$map['gid'] = array('eq',0);
		$ngcount = $friends->getCount($map);
    	$login_log = D('Login_log');
    	$attention = D('Attention');
    	foreach($friendsdata as &$val){
	    	$login_logmap['uid'] = array('eq',$val['frienddata']['id']);
	    	$val['frienddata']['lastlog'] = $login_log->getLastLog($login_logmap);
	    	$attentionmap['was'] = array('eq',$val['frienddata']['id']);
	    	$val['frienddata']['attention_num'] = $attention->where($attentionmap)->count();
	    	unset($login_logmap,$attentionmap);
    	}

		$this->assign('friendgroups',$friendgroups);
    	$this->assign('friendsdata',$friendsdata);
    	$this->assign('total',$total);
		$this->assign('ngcount',$ngcount);
    	$this->assign('gid',$gid);
		$this->display();
	}
	
	public function friendAll(){
		$friends = D('Friends');
		$map['main'] = array('eq',$this->memberinfo['id']);
		$friendsdata = $friends->getDataAll($map,$limit);
		$this->assign('friendsdata',$friendsdata);
		$this->display();
	}

	//我的主题
	public function trips(){
		$member_feed = D('Member_feed');
		$feedsmap['uid'] = array('eq',$this->memberinfo['id']);
		$count = $member_feed->getCount($feedsmap);
    	$limit = $this->page($count); 
		$feedsdata = $member_feed->getDataAll($feedsmap,$limit);
		$today = strtotime(date('Y-m-d 0:0:0',time()));
		$feeds_list = array();
		if(!empty($feedsdata)){
		    foreach($feedsdata as $value){
				if($value['addtime']>=$today) {
					$dkey = 'today';
				} elseif ($value['addtime']>=$today-3600*24) {
					$dkey = 'yesterday';
				} else {
					$dkey = toDate($value['addtime'], 'Y-m-d');
				}
				$feeds_list[$dkey][] = $value;
		    }
		}
		$this->assign('feeds_list',$feeds_list);
		$this->display();
	}
	//我的提醒
	public function reminds(){
	    $data = Init_GP(array('filter'));
		$remind = D('Remind');
		//获取用户提醒
		$remindmap['uid'] = array('eq',$this->memberinfo['id']);
		if($data['filter'] == 'read'){
		    $remindmap['new'] = array('eq',0);
		}elseif($data['filter'] =='unread'){
		    $remindmap['new'] = array('eq',1);
		}
		$count = $remind->getCount($remindmap);
    	$limit = $this->page($count,'',$data); 
		$remindsdata = $remind->getDataAll($remindmap,$limit);
		if($data['filter'] != 'unread'){
			if(!empty($remindsdata)){
				foreach($remindsdata as $value){
					if($value['new'] == 1){
						$map['id'] = array('eq',$value['id']);
						$succ = $remind->where($map)->setField('new',0);
					}
				}
			}
		}
		$this->assign('filter',$data['filter']);
		$this->assign('remindsdata',$remindsdata);
		$this->display();
	}
	//删除用户提醒
	public function delremind(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
		$remind = D('Remind');
		if(empty($id)){
		    $this->error(L('member_delremind_empty_id'));
		}
		if(is_array($id)){
			$map['id'] = array('in', implode(',',$id)) ;
			$map['uid'] = array('eq',$this->memberinfo['id']);
			$info = $remind->where($map)->delete();
			if($info){
				$this->success(L('delete_success'));
			}else{
				$this->error(L('delete_error'));
			}
		}else{
		    $reminddata = $remind->find($id);
		    if($reminddata['uid'] != $this->memberinfo['id'])$this->error(L('operational_error'));
			$info = $remind->delete($id);
			if($info){
				$this->success(L('delete_success'));
			}else{
				$this->error(L('delete_error'));
			}
		} 
    }
	//我的粉丝
	public function myattentioned(){
	    $attention = D('Attention');
	    $map['was'] = array('eq',$this->memberinfo['id']);
		$count = $attention->getCount($map);
    	$limit = $this->page($count); 
		$attentionedsdata = $attention->getDataAll($map,$limit);
		$friends = D('Friends');
		$login_log = D('Login_log');
    	foreach($attentionedsdata as &$val){
	    	$login_logmap['uid'] = array('eq',$val['maindata']['id']);
	    	$val['maindata']['lastlog'] = $login_log->getLastLog($login_logmap);
	    	$attentionmap['was'] = array('eq',$val['maindata']['id']);
	    	$val['maindata']['attention_num'] = $attention->where($attentionmap)->count();
	    	
	    	$friendsmap['F.friend'] = array('eq',$this->memberinfo['id']);
			$val['maindata']['mebfriends'] = $friends->getFriendsData($val['maindata']['id'],$friendsmap);
			$attentionsmap['A.main'] = array('eq',$this->memberinfo['id']);
			$val['maindata']['mebattentions'] = $attention->getAttentionsData($val['maindata']['id'],$attentionsmap);
	    	unset($login_logmap,$attentionmap,$friendsmap,$attentionsmap);
    	}
    	
		$this->assign('attentionedsdata',$attentionedsdata);
		$this->display();
	}
	//我的商品
	public function goods(){
		$this->_check_business();
		$goods = D('Goods');
		$map['promulgator'] = array('eq',$this->memberinfo['id']);
		$count = $goods->getCount($map);
    	$limit = $this->page($count); 
		$goodsdata = $goods->getDetails($map,$limit,'id desc');
		$this->assign('goodsdata',$goodsdata);
		$this->display();
	}
	
	public function delGoods(){
		$this->_check_business();
		$data = Init_GP(array('id'));
		$id= intval($data['id']);
		if($id){
			$goods = D('Goods');
			$goodsdata= $goods->getOne($id);
			if(empty($goodsdata)){
				$this->error(L('delete_error'));
			}
			
			if($goodsdata['audit'] == 0){
				$this->error(L('delete_error'));
			}
			
			if($goodsdata['promulgator']['id'] != $this->memberinfo['id']){
				$this->error(L('delete_error'));
			}
			$info = $goods->delete($id);
			if($info){
				$this->success(L('delete_success'));
			}else{
				$this->error(L('delete_error'));
			}
		}else{
			$this->error(L('delete_error'));
		}
	}
	
	//编辑资料
	public function edit(){
		$attachment = D ('Attachment');
		$mattlist=$attachment->getExpand($this->memberinfo['id']);
		foreach($mattlist as &$v){
			if(!empty($v['enum']))$v['enum'] = explode(",",$v['enum']);
			if($v['type']==4)$v['val'] = explode(",",$v['val']);
		}
		$this->assign('mattlist',$mattlist);
		$this->display();
	}
	//发送手机验证码
	public function smsphone(){
		$data = Init_GP(array('phone'));
		if(empty($data['phone']))$this->error(L('member_smsphone_empty_phone'));
		if(!isPhone($data['phone']))$this->error(L('member_smsphone_isPhone'));
		$member = D('Member');
		$map['phone'] = array('eq',$data['phone']);
		$map['phonestatus'] = array('eq',1);
		$memberdata = $member->where($map)->find();
		if(!empty($memberdata)) $this->error(L('member_smsphone_used'));
		$verification = D('Verification');
		$count = $verification->getCount($data['phone'],'phonecode');
		if ($count < 5){
			$verification->delCode($data['phone'],'phonecode');
			$phonecode = $verification->setPhoneCode($data['phone'],'phonecode',$count+1);
			
			$config = C('sysconfig');
			$message_tpl = D('Message_tpl');
			$msg = $message_tpl->getBody('phone'); //选择模板
			$msg = str_replace('[webname]',$config['site_name'], $msg);
			$msg = str_replace('[code]',$phonecode, $msg);
			$info = sendsms($data['phone'],$msg);
			if($info){
				$this->success(L('member_smsphone_success'));
			}else $this->error(L('member_smsphone_error'));
		}else $this->error(L('member_smsphone_num_error'));
	}
	//验证验证验证码
	public function phoneverify(){
		$data = Init_GP(array('phone','authcode'));
		if(empty($data['phone']))$this->error(L('member_smsphone_empty_phone'));
		if(empty($data['authcode']))$this->error(L('verification_code_input'));
		if(!isPhone($data['phone']))$this->error(L('member_smsphone_isPhone'));
		$verification = D('Verification');
		$map = array(
			'mail'=>array('eq',$data['phone']),
			'type'=>array('eq','phonecode')
		);
		$verificationdata = $verification->where($map)->find();
		if(empty($verificationdata)) $this->error(L('verification_code_phone_notsame'));
		$config = C('sysconfig');
		if((time()-$verificationdata['addtime'])>GetNum($config['site_sendsms_code_time'])*60){ 
			$this->error(L('verification_code_fail'));
		}
		
		if($data['authcode'] == $verificationdata['code']){
		    $verification->delCode($data['phone'],'phonecode');
			$member = D('Member');
			$member->setField('phone',$data['phone'],'id ='.$this->memberinfo['id']);
			$info = $member->setField('phonestatus',1,'id ='.$this->memberinfo['id']); 
			if($info){
				if($this->memberinfo['mailstatus']==1){
					$value_log = D('Value_log');
					$v_lmap['uid'] = array('eq',$this->memberinfo['id']);
					$v_lmap['content'] = array('eq',"[reg_verify]");
					$v_lmap['rel_id'] = array('eq',$this->memberinfo['id']);
					$v_lmap['rel_module'] = array('eq',"verify");
					$value_logdata = $value_log->getDataAll($v_lmap);
					if(empty($value_logdata)){
						$tip = $member->addVal($this->memberinfo['id'],$config['site_mb_verifycredits'],"[reg_verify]",$this->memberinfo['id'],"verify");
						if(!empty($this->memberinfo['inviteid'])){
							$iv_lmap['uid'] = array('eq',$this->memberinfo['inviteid']);
							$iv_lmap['content'] = array('eq',"[invite]");
							$iv_lmap['rel_id'] = array('eq',$this->memberinfo['id']);
							$iv_lmap['rel_module'] = array('eq',"invite");
							$ivalue_logdata = $value_log->getDataAll($iv_lmap);
							if(empty($ivalue_logdata)){
								$itip = $member->addVal($this->memberinfo['inviteid'],$config['site_mb_verifycredits'],"[invite]",$this->memberinfo['id'],"invite");
							}
						
						}
					}
				}
			}
			$this->success(L('verification_success'));
		}else $this->error(L('verification_code_error'));
	}
	//更新用户信息
	public function update(){
        $data = $_POST;
		$member = D('Member');
		$data['id'] = $this->memberinfo['id'];
		if($data['name'] != $this->memberinfo['name']){
			$map['name'] = array('eq',$name);
			$map['id'] = array('neq',$this->memberinfo['id']);
			$mdata = $member->where($map)->findAll();
			if(!empty($mdata)){
				$this->error(L('username_used'));
			}
		}
		$accessory = D('Accessory');
		$upload_list = $accessory->imgUpload(0,"member");
		if($upload_list){
			foreach($upload_list as $upload_item){
				$data[$upload_item['key']] = $upload_item['recpath'].$upload_item['savename'];
			}
		}

		$medata=array();//主表数据
		$me_atdata=array();//扩展数据
		foreach($data as $k=>$value){//分离数据
		    if(is_array($value))$value= implode(",",$value);
			if(intval($k)){
			    $me_atdata[$k]=$value;
			}else{
				$medata[$k]=$value;
			}
		}
		
		if (false === $member->create ($medata)) {
			$this->error ( $member->getError () );
		}
		// 更新数据
		$list = $member->update($medata);
		if (false !== $list) {
			//成功提示
			$Member_attachment = D ('Member_attachment');
			foreach($me_atdata as $k=>$value){
			    $where = 'aid='.$k.' and uid='.$medata['id'];
				$matarray = $Member_attachment->where($where)->find();
				$metadata = array(
					'uid'=>$medata['id'],
					'aid'=>$k,
					'val'=>$value
				);
				if(empty($matarray)){
					$result=$Member_attachment->insert($metadata);
				}else{
					$result=$Member_attachment->where($where)->update($metadata);
				}
				unset ($where, $matarray, $metadata, $result);
			}
			$member_feed = D('Member_feed');
			$tip = $member_feed->addFeed($this->memberinfo['id'],'info',$this->memberinfo['id'],'Member');
			$this->success (L('edit_success'));
		} else {
			//错误提示
			$this->error (L('edit_error'));
		}
	}
	//编辑头像
	public function avatar(){
		$this->display();
	}
	//常用登录位置
	public function location(){
	    $member_location = D ('Member_location');
		$map['uid'] = array('eq',$this->memberinfo['id']);
		$count = $member_location->getCount($map);
		$limit = $this->page($count,10);
		$locationdata = $member_location->getData($map,$limit,'`type` desc,`id` desc');
		$this->assign('locationdata',$locationdata);
		$this->display();
	}
	public function addlocation(){
	    $data = Init_GP(array('address','longitude','latitude'));
		if(empty($data['address']))$this->error (L('member_location_address_empty'));
		if(empty($data['longitude']) || empty($data['latitude']))$this->error (L('member_location_latlng_empty'));
		$member_location = D ('Member_location');
		$map['uid'] = array('eq',$this->memberinfo['id']);
		$count = $member_location->getCount($map);
		$map['address'] = array('eq',$data['address']);
		$locationdata = $member_location->getOne($map);
		if(!empty($locationdata))$this->error (L('member_location_notempty'));
		$data['uid'] = $this->memberinfo['id'];
		$data['lng'] = $data['longitude'];
		$data['lat'] = $data['latitude'];
		if($count==0)$data['type'] = 1;
		else $data['type'] = 0;
		$result = $member_location->insert($data);
		if($result){
			$vo= $member_location->getOne($result);
			$this->assign('vo',$vo);
			$html = $this->fetch();
			$this->success ($html);
		} else {
			$this->error (L('member_location_add_error'));
		}
	}
	public function editlocation(){
	     $data = Init_GP(array('id'));
		 $id = intval($data['id']);
		 $member_location = D ('Member_location');
		 $locationdata = $member_location->getOne($id);
		 if(empty($locationdata)){
			 $this->error(L('member_location_empty_id'));
		 }elseif($locationdata['uid'] != $this->memberinfo['id']){
			 $this->error(L('operational_error'));
		 }
		 $this->success($locationdata);
	}
	public function updatelocation(){
	    $data = Init_GP(array('id','address','longitude','latitude'));
		if(empty($data['address']))$this->error (L('member_location_address_empty'));
		if(empty($data['longitude']) || empty($data['latitude']))$this->error (L('member_location_latlng_empty'));
		$id = intval($data['id']);
		$member_location = D ('Member_location');
		$map['uid'] = array('eq',$this->memberinfo['id']);
		$map['address'] = array('eq',$data['address']);
		$addressdata = $member_location->getOne($map);
		if(!empty($addressdata) && $addressdata['id'] != $id)$this->error (L('member_location_notempty'));
		
		$locationdata = $member_location->getOne($id);
		if($locationdata['uid'] != $this->memberinfo['id'])$this->error (L('operational_error'));
		
        $locationdata['address'] = $data['address'];
		$locationdata['lng'] = $data['longitude'];
		$locationdata['lat'] = $data['latitude'];

		$list = $member_location->update($locationdata);
		if (false !== $list){
			$this->success (L('member_location_edit_success'));
		} else {
			$this->error (L('member_location_edit_error'));
		}
	}
	public function dellocation(){
		$data = Init_GP(array('id'));
		$id = intval($data['id']);
		$member_location = D ('Member_location');
		$locationdata = $member_location->getOne($id);
		if(empty($locationdata)){
			$this->error(L('member_location_empty_id'));
		}elseif($locationdata['uid'] != $this->memberinfo['id']){
			$this->error(L('operational_error'));
		}    
		$info = $member_location->delete($id);
		if($info){
			$this->success(L('delete_success'));
		}else{
			$this->error(L('delete_error'));
		}
	}
	public function setlocation(){
		$data = Init_GP(array('id'));
		$id = intval($data['id']);
		$member_location = D ('Member_location');
		$locationdata = $member_location->getOne($id);
		if(empty($locationdata)){
			$this->error(L('member_location_empty_id'));
		}elseif($locationdata['uid'] != $this->memberinfo['id']){
			$this->error(L('operational_error'));
		}
		$setmap['id'] = array('neq',$id);
		$setmap['uid'] = array('eq',$this->memberinfo['id']);
		$setmap['type'] = array('eq',1);
		$member_location->where($setmap)->setField('type', 0);	        
		$map['id'] = array('eq',$id);
		$info =$member_location->where($map)->setField('type', 1);
		$this->assign("jumpUrl",U('Member/location'));		
		if($info){
			$this->success(L('setdefault_success'));
		}else{
			$this->error(L('setdefault_error'));
		}
	}
	//验证和账号绑定
	public function verification(){
	    $login_port = D ('Login_port');
		$map['status'] = array('eq',1);
		$login_portdata = $login_port->getDataAll($map);
		foreach($login_portdata as &$value){
			$key = $value['remark'].'_id';
			if($this->memberinfo[$key])$value['verified'] = 1;
			else $value['verified'] = 0;
		}
		$this->assign('login_portdata',$login_portdata);
		$this->display();
	}
	//评价管理
	public function reviews(){
	    $id = $this->memberinfo['id'];
	
		$order_details = D('Order_details');
		$map['uid'] = array('eq',$id);
		$map['comment_id'] = array('eq',0);
		$map['status'] = array('eq',1);
		$limit = $order_details->getCount($map);
		$ordersdata = $order_details->getDataAll($map,$limit);
		
		$goods = D('Goods');
		$goodsmap['promulgator'] = array('eq',$id);
		$ids = $goods->getGather($goodsmap);
		$soldmap['gid'] = array('in',$ids);
		$soldmap['member_comment_id'] = array('eq',0);
		$soldmap['status'] = array('eq',1);
		$soldlimit = $order_details->getCount($soldmap);
		$soldordersdata = $order_details->getDataAll($soldmap,$soldlimit);
		
		$this->assign('ordersdata',$ordersdata);
		$this->assign('soldordersdata',$soldordersdata);
		$this->display();
	}
	//查看订单详情
	public function viewo_details(){
	    $data = Init_GP(array('id','oid'));
		$id = intval($data['id']);
		$oid = intval($data['oid']);
		if($id){
			$map['id'] = array('eq',$id);
		}
		
		if($oid){
			$map['oid'] = array('eq',$oid);
		}
	    $uid = $this->memberinfo['id'];
	
		$order_details = D('Order_details');
		$o_detailsdata = $order_details->getDataAll($map);
		
		if($o_detailsdata[0]['uid'] != $uid && $o_detailsdata[0]['good']['promulgator']['id'] != $uid ){
			$this->error (L('order_not_belong_you'));
		}
		$this->assign('o_detailsdata',$o_detailsdata);
		if($o_detailsdata[0]['uid'] == $uid){
		   $this->display();
		}elseif($o_detailsdata[0]['good']['promulgator']['id'] == $uid){
		   $this->display('viewso_details');
		}
	}
	public function commentorder(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
	    $uid = $this->memberinfo['id'];
	
		$order_details = D('Order_details');
		$o_detailsdata = $order_details->getOne($id);
		
		if($o_detailsdata['uid'] != $uid){
			$this->error (L('order_not_belong_you'));
		}
		if(!empty($o_detailsdata['comment_id'])){
			$this->error (L('order_comment_repeat'));
		}
		$evaluate_items = D('Evaluate_items');
		$evaluate_itemsdata = $evaluate_items->getData();
		$this->assign('evaluate_itemsdata',$evaluate_itemsdata);
		$this->assign('o_detailsdata',$o_detailsdata);
		$this->display();
	}
	public function commentadd(){
		$data = Init_GP(array('odid','gid','content'));
		$odid  = intval($data['odid']);
		$gid  = intval($data['gid']);
		$order_details = D('Order_details');
		$o_detailsdata = $order_details->getOne($odid);
		
		if($o_detailsdata['uid'] != $this->memberinfo['id']){
			$this->error (L('order_not_belong_you'));
		}
		if(!empty($o_detailsdata['comment_id'])){
			$this->error (L('order_comment_repeat'));
		}
		if(empty($data['content'])){
			$this->error(L('content_notempty'));
		}
		$comment = D('Comment');
		$comment_data = array(
			'gid' =>$gid,
			'reviewer' => $this->memberinfo['id'],
			'content'=>$data['content'],
			'addtime'=>time(),
		);
		$info = $comment->insert($comment_data);
		
		if($info){
			//评分
			$evaluate = D('Evaluate');
			$evaluate_items = D('Evaluate_items');
			$evaluate_itemsdata = $evaluate_items->getData();
			foreach($evaluate_itemsdata as $val){
			    $value = intval($_REQUEST["item{$val['id']}"]);
				$config = C('sysconfig');
			    if($value<0 || $value>intval($config['evaluate_total'])) $value = intval($config['evaluate_total']); 
				$evaluatedata[] = array(
					'gid'=>$gid,
					'uid'=>$this->memberinfo['id'],
					'odid'=>$odid,
					'item'=>$val['id'],
					'value'=>$value,
				);
			}
			$evaluate->addAll($evaluatedata);
			
			$tip = $order_details->setField('comment_id',$info,'id ='.$odid);
			$remind = D('Remind');
			$uid = getParent('Goods',$gid,'promulgator');
			$reinfo = $remind->addRemind($uid,$this->memberinfo['id'],'commented',$gid);
			$member_feed = D('Member_feed');
			$tip = $member_feed->addFeed($this->memberinfo['id'],'comment',$gid,'Goods');
			$dtip = $member_feed->addFeed($uid,'commented',$gid,'Goods');
			if($tip)$this->success(L('comment_success'));
			else $this->error(L('comment_error'));
		}else{
			$this->error(L('comment_error'));
		}
	}
	public function editcomment(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
	
		$comment = D('Comment');
		$commentdata = $comment->getOne($id);
		
		if($commentdata['reviewer']['id'] != $this->memberinfo['id']){
			$this->error (L('data_error'));
		}
		$order_details = D('Order_details');
		$omap['comment_id'] = array('eq',$commentdata['id']);
		$odid = $order_details->where($omap)->getField('id');
		$commentdata['odid'] = intval($odid);
		$config = C('sysconfig');
		$evaluate = D('Evaluate');
		$evaluate_items = D('Evaluate_items');
		$evaluate_itemsdata = $evaluate_items->getData();
		foreach($evaluate_itemsdata as &$val){
			$map['uid'] = array('eq',$this->memberinfo['id']);
			$map['gid'] = array('eq',$commentdata['gid']);
			$map['odid'] = array('eq',$commentdata['odid']);
			$map['item'] = array('eq',$val['id']);
			$value = $evaluate->where($map)->getField('value');
			$val['value'] = intval($value);
			unset($map);
		}
		$this->assign('evaluate_total',intval($config['evaluate_total']));
		$this->assign('evaluate_itemsdata',$evaluate_itemsdata);
		$this->assign('commentdata',$commentdata);
		$this->display();
	}
	public function updatecomment(){
	    $data = Init_GP(array('id','gid','odid','content'));
		$id = intval($data['id']);
		$gid  = intval($data['gid']);
		$odid  = intval($data['odid']);
		if(empty($data['content'])){
			$this->error(L('content_notempty'));
		}
		$comment = D('Comment');
		$commentdata = $comment->getOne($id);
		if($commentdata['reviewer']['id'] != $this->memberinfo['id']){
			$this->error (L('data_error'));
		}
		$comment_data = array(
			'id' =>$id,
			'content'=>$data['content'],
		);
		$info = $comment->update($comment_data);
		if($info !== false){
			$evaluate = D('Evaluate');
			$evaluate_items = D('Evaluate_items');
			$evaluate_itemsdata = $evaluate_items->getData();
			$config = C('sysconfig');
			foreach($evaluate_itemsdata as $val){
			    $where = 'gid='.$gid.' and uid='.$this->memberinfo['id'].' and odid='.$odid.' and item='.$val['id'];
			    $value = intval($_REQUEST["item{$val['id']}"]);
			    if($value<0 || $value>intval($config['evaluate_total'])) $value = intval($config['evaluate_total']); 
				$evaluatedata = array(
					'gid'=>$gid,
					'uid'=>$this->memberinfo['id'],
					'odid'=>$odid,
					'item'=>$val['id'],
					'value'=>$value,
				);
				$evalarray = $evaluate->where($where)->find();
				if(empty($evalarray)){
					$result=$evaluate->insert($evaluatedata);
				}else{
					$result=$evaluate->where($where)->update($evaluatedata);
				}
				unset ($where, $evalarray, $evaluatedata, $result);
			}
			$this->success(L('edit_success'));
		}else{
			$this->error(L('edit_error'));
		}
	}
	public function member_commentorder(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
	    $uid = $this->memberinfo['id'];
	
		$order_details = D('Order_details');
		$o_detailsdata = $order_details->getOne($id);
		
		if($o_detailsdata['good']['promulgator']['id'] != $uid ){
			$this->error (L('order_not_belong_you'));
		}
		if(!empty($o_detailsdata['member_comment_id'])){
			$this->error (L('order_comment_repeat'));
		}

		$this->assign('o_detailsdata',$o_detailsdata);
		$this->display();
	}
	public function member_commentadd(){
		$data = Init_GP(array('odid','uid','content'));
		$odid  = intval($data['odid']);
		$uid  = intval($data['uid']);
		$order_details = D('Order_details');
		$o_detailsdata = $order_details->getOne($odid);
		if($o_detailsdata['good']['promulgator']['id'] != $this->memberinfo['id'] ){
			$this->error (L('order_not_belong_you'));
		}
		if(!empty($o_detailsdata['member_comment_id'])){
			$this->error (L('order_comment_repeat'));
		}
		if(empty($data['content'])){
			$this->error(L('content_notempty'));
		}
		$member_comment = D('Member_comment');
		$mcomment_data = array(
			'uid' =>$uid,
			'reviewer' => $this->memberinfo['id'],
			'content'=>$data['content'],
			'addtime'=>time(),
		);
		$info = $member_comment->insert($mcomment_data);
		if($info){
			$tip = $order_details->setField('member_comment_id',$info,'id ='.$odid);
			$remind = D('Remind');
			$reinfo = $remind->addRemind($uid,$this->memberinfo['id'],'commented');
			$member_feed = D('Member_feed');
			$tip = $member_feed->addFeed($this->memberinfo['id'],'comment',$uid,'Member');
			$dtip = $member_feed->addFeed($uid,'commented',$this->memberinfo['id'],'Member');
			if($tip)$this->success(L('comment_success'));
			else $this->error(L('comment_error'));
		}else{
			$this->error(L('comment_error'));
		}
	}
	public function editmember_comment(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
	
		$member_comment = D('Member_comment');
		$member_commentdata = $member_comment->getOne($id);
		
		if($member_commentdata['reviewer']['id'] != $this->memberinfo['id']){
			$this->error (L('data_error'));
		}
		
		$this->assign('member_commentdata',$member_commentdata);
		$this->display();
	}
	public function updatemember_comment(){
	    $data = Init_GP(array('id','content'));
		$id = intval($data['id']);
		
		if(empty($data['content'])){
			$this->error(L('content_notempty'));
		}
		$member_comment = D('Member_comment');
		$member_commentdata = $member_comment->getOne($id);
		if($member_commentdata['reviewer']['id'] != $this->memberinfo['id']){
			$this->error (L('data_error'));
		}
		$comment_data = array(
			'id' =>$id,
			'content'=>$data['content'],
		);
		$info = $member_comment->update($comment_data);
		if($info !== false){
			$this->success(L('edit_success'));
		}else{
			$this->error(L('edit_error'));
		}
	}
	//推荐管理
	public function references(){
		$this->display();
	}
	public function references_emails(){
		$this->_check_business();
	    $data = Init_GP(array('friends'));
		$friends = $data['friends'];
		$config = C('sysconfig');
		$friends = explode(',', $friends);
		$header = L('member_references_emails_header');
		$header = $config['site_name'].$header;
		$emails = array();
		foreach($friends as $value){
		  if(!empty($value) && preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',$value))$emails[] = $value;
		}
		if(empty($emails)) $this->error(L('member_references_emails_empty'));
		
		$config = C('sysconfig');
		$references_urllink = HOST.U('Member/addreferences/uid/'.$this->memberinfo['id']);
		$message_tpl = D('Message_tpl');
		$referencesmail = $message_tpl->getBody('referencesemail'); //选择模板
		$referencesmail = str_replace('[user]',$this->memberinfo['name'], $referencesmail);
		$referencesmail = str_replace('[webname]',$config['site_name'], $referencesmail);
		$referencesmail = str_replace('[webdesc]',$config['site_description'], $referencesmail);
		$referencesmail = str_replace('[verifycredits]',$config['site_mb_verifycredits'], $referencesmail);
		$referencesmail = str_replace('[creditsname]',$config['site_credits_name'], $referencesmail);
		$referencesmail = str_replace('[ordercredits]',$config['site_mb_ordercredits'], $referencesmail);
		$referencesmail = str_replace('[url]',$references_urllink, $referencesmail);
		
		foreach($emails as $value){
			$info = sendMail($value,$header,$referencesmail);
		}
		$this->success(L('member_references_emails_success'));
    }
	public function addreferences(){
	    $data = Init_GP(array('uid'));
		$uid  = intval($data['uid']);
		if($uid == $this->memberinfo['id']){
			$this->error(L('member_addreferences_self'));
		}
		$member = D('Member');
		$userdata = $member->getOne($uid);
		if(empty($userdata)){
			$this->error(L('account_not_exist'));
		}
	
		$goods = D('Goods');
		$goodmap = $goods->_defaultWhere();
		$goodmap['promulgator'] = array('eq',$uid);
		$user_goods = $goods->getDataAll($goodmap,'');
		$this->assign('userdata',$userdata);
		$this->assign('user_goods',$user_goods);
		$this->display();
	}
	
	//推荐
	public function addrecommend(){
	    $data = Init_GP(array('uid','gid','content'));
		$uid  = intval($data['uid']);
		$gid  = intval($data['gid']);
		
		if(empty($data['content'])){
			$this->error(L('content_notempty'));
		}
		
		$recommend = D('Recommend');
		$map['gid'] = array('eq',$gid);
		$map['reviewer'] = array('eq',$this->memberinfo['id']);
		$recommenddata = $recommend->getDataAll($map,'');
		if(!empty($recommenddata)){
			$this->error(L('member_addrecommend_already'));
		}
		$goods = D('Goods');
		$user_goods = $goods->getOne($gid);
		if($user_goods['promulgator']['id'] != $uid){
			$this->error(L('operational_error'));
		}
		
		$recommend_data = array(
			'gid' =>$gid,
			'reviewer' => $this->memberinfo['id'],
			'content'=>$data['content'],
			'addtime'=>time(),
		);
		$info = $recommend->insert($recommend_data);
		if($info){
			$remind = D('Remind');
			$reinfo = $remind->addRemind($uid,$this->memberinfo['id'],'recommended',$gid);
			$member_feed = D('Member_feed');
			$tip = $member_feed->addFeed($this->memberinfo['id'],'recommend',$gid,'Goods');
			$dtip = $member_feed->addFeed($uid,'recommended',$gid,'Goods');
			$this->success(L('member_addrecommend_success'));
		}else{
			$this->error(L('member_addrecommend_error'));
		}
	}
	//隐私设置
	public function privacy(){
	    $member_info = D('Member_info');
		$infodata = $member_info->getInfo($this->memberinfo['id']);
		if(empty($infodata)){
			$data['uid'] = $this->memberinfo['id'];
			$id = $member_info->insert($data);
			$infodata = $member_info->getOne($id);
		}
		$this->assign('infodata',$infodata);
		$this->display();
	}
	public function editprivacy(){
	    $data = $_POST;
		$member_info = D('Member_info');
		$info = $member_info->update($data);
		if (false !== $info) {
			$this->success(L('save_success'));
		} else {
			$this->error(L('save_error'));
		}
		
	}
	
	//去付款
    public function payment(){
    	$data = Init_GP(array('oid'));
    	$oid = intval($data['oid']);
    	if($oid){
    		//订单支付
    		$order = D('Order');
	 		$orderdata = $order->getOne($oid);
	 		if(empty($orderdata)){
	 			$this->error(L('order_not_exist'));
	 		}
    		if(isset($orderdata['uid']) && $orderdata['uid'] != $this->memberinfo['id']){
				$this->error(L('order_not_belong_you'));
    		}
    		if($orderdata['status'] == 1){
	 			$this->error(L('order_paid'));
	 		}
    		if($orderdata['status'] == 2){
	 			$this->error(L('order_obsolete'));
	 		}
    		
    		$order_details = D('Order_details');
    		$order_detailsmap = array(
    			'oid'=>array('eq',$oid),
    		);
    		$order_detailsdata = $order_details->getData($order_detailsmap);
    		
    		foreach ($order_detailsdata as $value){
	 			$ids[] = $value['gid'];
	 			$nums[$value['gid']] = $value['num'];
	 		}
	 		$this->assign('orderdata',$orderdata);
    	}else{
    		//购物车支付
	    	$cartdata = ShoppingCart::getVal();
	    	if(empty($cartdata)){
	    		$this->assign('jumpUrl',U('Goods/shoppingCart'));
	    		$this->error(L('shoppingcart_empty'));
	    	}
	    	foreach ($cartdata as $value){
	 			$ids[] = $value['id'];
	 			$nums[$value['id']] = $value['num'];
	 		}
    	}
 		
 		$goods = D('Goods');
 		$goodsmap['id'] = array('in',$ids);
 		$goodsdata = $goods->getDataAll($goodsmap);
 		
 		//支付方式
 		$this->onPayment();
 		$this->assign('goodsdata',$goodsdata);
 		$this->assign('nums',$nums);
    	$this->display();
    }
    
    public function pay(){
    	$data = Init_GP(array('iscash','paytype','phone','remark','paybank','oid'));
    	$oid = intval($data['oid']);
    	$iscash = intval($data['iscash']);
    	$phone = $data['phone'];
    	$order = D('Order');
    	if(empty($phone)){
	    	if($this->memberinfo['phonestatus']){
	    		$phone = $this->memberinfo['phone'];
	    	}else{
	    		$this->ajaxReturn(1,L('please_input_phone'),0);
	    	}
    	}
		if(!isPhone($phone)){
			$this->ajaxReturn(1,L('phone_error'),0);
		}
    	
    	//获取当前时间
    	$time = time();
    	$goods = D('Goods');
    	$order_details = D('Order_details');
    	//订单总价
    	$order_total = 0;
    	//订单状态
    	$status = 0;
    	//订单支付状态
 		$money_status = 0;
 		//应付货款
 		$cope = 0;
    	if($oid){
    		//订单支付
	 		$order_data = $order->getOne($oid);
	 		if(empty($order_data)){
	 			$this->error(L('order_not_exist'));
	 		}
    		if(isset($order_data['uid']) && $order_data['uid'] != $this->memberinfo['id']){
				$this->error(L('order_not_belong_you'));
    		}
    		if($order_data['status'] == 1){
	 			$this->error(L('order_paid'));
	 		}
    		if($order_data['status'] == 2){
	 			$this->error(L('order_obsolete'));
	 		}
	 		$order_total = $order_data['total'];
	 		$cope = $order_data['cope'];
    	}else{
    		//购物车支付
	    	$cartdata = ShoppingCart::getVal();
	    	if(empty($cartdata)){
	    		$this->error(L('shoppingcart_empty'));
	    	}
	    	
	    	foreach ($cartdata as $value){
	 			$goodsdata = $goods->getOne($value['id']);
	 			$sy = $goodsdata['num'] - $goodsdata['crrnum'];
	 			$restriction = $goodsdata['onenum'] - $goods->getUserQuantity($goodsdata['id'],$this->memberinfo['id']);
	 			if($restriction < 0)$restriction =0;
	 			if($value['num'] > 0){
		    		if($sy <= 0 && $goodsdata['num'] != 0){
		    			$this->error($goodsdata['title'].L('goods_inadequate_del'));
		    		}elseif($val['num'] > $restriction && !empty($goodsdata['onenum'])){
		    			$this->error($goodsdata['title'].L('goods_purchase_limit').$goodsdata['onenum']);
		    		}elseif($val['num'] > $sy && $goodsdata['num'] != 0){
		    			$this->error($goodsdata['title'].L('goods_purchase_limit_tip').$sy);
		    		}
	 			}else{
	 				$this->error($goodsdata['title'].L('goods_num_error'));
	 			}
	 			//不能自己购买自己的产品
	 			if($goodsdata['promulgator']['id'] == $this->memberinfo['id']){
	 				$this->error($goodsdata['title'].L('goods_is_self'));
	 			}
	 			
	 			$price = $goodsdata['price']; 
	 			$total = $price * $value['num'];
	 			$order_details_data[] = array(
	 				'gid'=>$goodsdata['id'],
	 				'uid'=>$this->memberinfo['id'],
	 				'num'=>$value['num'],
	 				'title'=>$goodsdata['title'],
	 				'price'=>$price,
	 				'total'=>$total,
	 				'addtime'=>$time,
	 			);
	 			$order_total += $total;
	 			//删除循环的变量
	 			unset($goodsdata,$price,$total,$sy);
	 		}
	 		$cope = $order_total;
    	}
    	
 		//使用余额支付
 		if($iscash){
 			$incharge = $this->memberinfo['cash'];
 			if($cope <= $incharge){
 				$incharge = $cope;
 			}
 			$cope = $cope - $incharge;
 			if($cope > 0){
 				//部分支付
 				$money_status = 1;
 			}else{
 				//全部支付
 				$money_status = 2;
 				$status = 1;
 				$paytype = L('order_cash_paytype');
 			}
 		}else{
 			$incharge = 0;
 		}
		$payment = D('Payment');
 		//支付方式
 		if(empty($paytype)){
 			if(empty($data['paytype'])){
 				$this->error(L('please_select_payment'));
 			}else{
 				$paymentmap = array(
 					'mark'=>array('eq',$data['paytype']),
 					'status'=>array('eq',1),
 				);
 				$paymentdata = $payment->getOne($paymentmap);
 				if(empty($paymentdata)){
 					$this->error(L('please_select_payment'));
 				}else{
 					$import_status = import("@.ORG.{$paymentdata['mark']}");
 					if($import_status){
 						$pay = new $paymentdata['mark']($paymentdata);
 					}else{
 						$this->error(L('payment_interface_not_exist'));
 					}
 					$paytype = $paymentdata['name'];
 				}
 			}
 		} 		
		if($oid){
    		//订单支付
    		$orderdata = array(
    			'id'=>$oid,
	 			'phone'=>$phone,
	 			'incharge'=>$order_data['incharge']+$incharge,
	 			'cope'=>$cope,
	 			'money_status'=>$money_status,
	 			'paytype'=>$paytype,
	 			'remark'=>$data['remark']?$data['remark']:'',
	 			'status'=>$status,
	 		);
	 		$updata_info = $order->update($orderdata);
	 		if($updata_info !== false){
	 			$order_detailsmap['oid'] = array('eq',$oid);
	 			$order_details->where($order_detailsmap)->setField('status', $status);
	 			$orderdata = array_merge($order_data,$orderdata);
	 		}else{
	 			$this->error(L('order_error'));
	 		}
		}else{
			//购物车支付
	 		$orderdata = array(
	 			'uid'=>$this->memberinfo['id'],
	 			'sn'=>$order->produceSn(),
	 			'phone'=>$phone,
	 			'incharge'=>$incharge,
	 			'cope'=>$cope,
	 			'total'=>$order_total,
	 			'money_status'=>$money_status,
	 			'addtime'=>$time,
	 			'paytype'=>$paytype,
	 			'remark'=>$data['remark']?$data['remark']:'',
	 			'status'=>$status,
	 		);
			
	 		$oid = $order->insert($orderdata);
	 		if($oid){
	 			//成功插入
	 			foreach($order_details_data as &$value){
	 				$value['oid'] = $oid;
	 				$value['status'] = $status;
	 			}
	 			$order_details->addAll($order_details_data);
	 			//清空购物车
	 			ShoppingCart::clear();
	 		}else{
	 			$this->error(L('order_error'));
	 		}
		}
		
		if($incharge){
 			$member = D('Member');
 			$member->setDec('cash',"id={$this->memberinfo['id']}",toPrice($incharge));
 			$cash_log = D('Cash_log');
 			$cash_logdata = array(
				'uid'=>$this->memberinfo['id'],
				'val'=>-$incharge,
				'content'=>"[pay_order]{$orderdata['sn']}",
 				'rel_id'=>$oid,
				'rel_module'=>'Order',
 				'addtime'=>$time,
			);
			$cash_log->insert($cash_logdata);
 		}
 		
 		if($status){
 			//设置库存
	 		$order_details->updateCrrnum($oid);
 			$html = '';
 		}else{
 			$html = $pay->_payto($orderdata,$data['paybank']);
 		}
 		$this->assign('paytype',$paytype);
 		$this->assign('form',$html);
 		$this->assign('oid',$oid);
 		$this->assign('url',U('Member/account/item/mycoupons'));
 		$result['html'] = $this->fetch('bankfanh');
        $result['oid'] = $oid;
 		$this->success($result);
    }
    
    //账户信息
    public function account(){
    	$this->display();
    }
    
    public function recharge(){
    	//支付方式
 		$this->onPayment();
    	$this->display();
    }
    
    //支付
	public function toRecharge(){
    	$data = Init_GP(array('cash','paytype','paybank'));
    	$payment = D('Payment');
    	$cash = toPrice(GetNum($data['cash']));
    	if($cash <= 0 || $cash != $data['cash']){
    		$this->ajaxReturn(1,L('please_input_amount'),0);
    	}
 		//支付方式
 		if(empty($data['paytype'])){
 			$this->error(L('please_select_payment'));
 		}else{
 			$paymentmap = array(
 				'mark'=>array('eq',$data['paytype']),
 				'status'=>array('eq',1),
 			);
 			$paymentdata = $payment->getOne($paymentmap);
 			if(empty($paymentdata)){
 				$this->error(L('please_select_payment'));
 			}else{
 				$import_status = import("@.ORG.{$paymentdata['mark']}");
 				if($import_status){
 					$pay = new $paymentdata['mark']($paymentdata);
 				}else{
 					$this->error(L('payment_interface_not_exist'));
 				}
 				$paytype = $paymentdata['name'];
 			}
 		}
 		
 		$recharge = D('Recharge');
 		$rechargedata = array(
 			'sn'=>$recharge->produceSn(),
 			'uid'=>$this->memberinfo['id'],
 			'cope'=>$cash,
 			'cash'=>$cash,
 			'bank_id'=>$paytype,
 			'addtime'=>time(),
 		);
 		$rid = $recharge->insert($rechargedata);
 		if($rid){
 			$html = $pay->_payto($rechargedata,$data['paybank']);
	 		$this->assign('paytype',$paytype);
	 		$this->assign('form',$html);
	 		$this->assign('url',U('Member/account/item/rechargeList'));
	 		$result['html'] = $this->fetch('bankfanh');
	 		$this->success($result);
 		}else{
 			$this->error(L('illegal_operational'));
 		} 		
    }
    
    //充值卡
    public function prepaidCard(){
    	$this->display();
    }
    
    //充值充值卡
    public function rechargePrepaidCard(){
    	$data = Init_GP(array('sn','pwd','recharge'));
    	if(empty($data['sn'])){
    		$this->error(L('member_checkprepaidcard_empty_sn'));
    	}
    	if(empty($data['pwd'])){
    		$this->error(L('member_checkprepaidcard_empty_pwd'));
    	}
    	
    	/*if(empty($data['recharge'])){
    		//验证验证码
    		$this->checkVerify();
    	}*/
    	
    	$prepaid_card = D('Prepaid_card');
    	$prepaid_cardmap = array(
    		'sn'=>$data['sn'],
    		'pwd'=>$data['pwd'],
    	);
    	$prepaid_carddata = $prepaid_card->getOne($prepaid_cardmap);
    	if(!empty($prepaid_carddata)){
    		$time = time();
    		if($prepaid_carddata['status'] != 0){
    			$this->error(L('member_checkprepaidcard_status'));
    		}
    		
    		if($time > $prepaid_carddata['endtime']){
    			$this->error(L('member_checkprepaidcard_endtime'));
    		}
    		
    		if($time < $prepaid_carddata['starttime']){
    			$this->error(L('member_checkprepaidcard_starttime'));
    		}
    		if(empty($data['recharge'])){
    			//非充值
    			$this->assign('data',$prepaid_carddata);
	    		$result = $this->fetch('confirmPrepaidCard');
	    		$this->success($result);
    		}else{
    			//充值
	    		$member = D('Member');
	 			$member->setInc('cash',"id={$this->memberinfo['id']}",toPrice($prepaid_carddata['cash']));
	 			$cash_log = D('Cash_log');
	 			$cash_logdata = array(
					'uid'=>$this->memberinfo['id'],
					'val'=>$prepaid_carddata['cash'],
					'content'=>'[prepaid_card]',
	 				'rel_id'=>$prepaid_carddata['id'],
					'rel_module'=>'Prepaid_card',
	 				'addtime'=>$time,
				);
				$cash_log->insert($cash_logdata);
				
				$recharge = D('Recharge');
				$rechargedata = array(
					'sn'=>$recharge->produceSn(),
					'uid'=>$this->memberinfo['id'],
					'cash'=>$prepaid_carddata['cash'],
					'bank_id'=>C('sysconfig.site_prepaid_card_name'),
					'addtime'=>$time,
					'status'=>1,
				);
				$recharge->insert($rechargedata);
				$carddata = array(
					'id'=>$prepaid_carddata['id'],
					'status'=>1,
				);
				$prepaid_card->update($carddata);
    		}
			$this->success(L('recharge_success'));
    	}else{
    		$this->error(L('member_checkprepaidcard_error'));
    	}
    }
    
    //购买订单列表
    public function buyOrderList(){
    	$order = D('Order');
    	$ordermap['uid'] = array('eq',$this->memberinfo['id']);
    	$order_count = $order->getCount($ordermap);
    	$limit = $this->page($order_count);   	
    	$orderdata = $order->getDataAll($ordermap,$limit);
    	$this->assign('orderdata',$orderdata);
    	$this->display();
    }
    
    //作废订单
    public function invalid(){
    	$data = Init_GP(array('oid'));
    	$oid = intval($data['oid']);
    	if($oid){
    		$order = D('Order');
    		$orderdata = $order->find($oid);
    		if($orderdata['uid'] != $this->memberinfo['id']){
    			$this->error(L('operational_error').L('order_not_belong_you'));
    		}
    		if($orderdata['status'] == 1){
    			$this->error(L('operational_error').L('order_paid'));
    		}
    		if($orderdata['status'] == 2){
    			$this->error(L('operational_error').L('order_obsolete'));
    		}
    		$order->invalid($oid);
    		$this->success(L('operational_success'));
    	}else{
    		$this->error(L('operational_error'));
    	}
    }
    //卖出订单列表
    public function sellOrderList(){
		$this->_check_business();
    	$order_details = D('Order_details');
    	$goods = D('Goods');
    	$goodsmap['promulgator'] = array('eq',$this->memberinfo['id']);
    	$gids = $goods->getGather($goodsmap);
    	$order_detailsmap['gid'] = array('in',$gids);
    	$order_details_count = $order_details->getCount($order_detailsmap);
    	$limit = $this->page($order_details_count);
    	$order_detailsdata = $order_details->getDataAll($order_detailsmap,$limit);
    	$this->assign('order_detailsdata',$order_detailsdata);
    	$this->display();
    }
    
    //充值日志
    
    public function rechargeList(){
    	$recharge = D('Recharge');
    	$rechargemap['uid'] = array('eq',$this->memberinfo['id']);
    	$rechargemap['status'] = array('eq',1);
    	$recharge_count = $recharge->getCount($rechargemap);
    	$limit = $this->page($recharge_count);
    	$rechargedata = $recharge->getData($rechargemap,$limit);
    	$this->assign('rechargedata',$rechargedata);
    	$this->display();
    }
    
	//积分日志
    
    public function valueLog(){
    	$value_log = D('Value_log');
    	$value_logmap['uid'] = array('eq',$this->memberinfo['id']);
    	$value_log_count = $value_log->getCount($value_logmap);
    	$limit = $this->page($value_log_count);
    	$value_logdata = $value_log->getDataAll($value_logmap,$limit);
    	$this->assign('value_logdata',$value_logdata);
    	$this->display();
    }
    
	//等级列表
    public function levelList(){
    	$level = D('Level');
    	$leveldata = $level->getData($levelmap,'','id desc');
    	$this->assign('leveldata',$leveldata);
    	$this->display();
    }
    
    //修改密码
    public function modifyPwd(){
    	$this->display();
    }
    
    //保存密码
    public function savePwd(){
    	$data = Init_GP(array('oldpwd','newpwd','newpwd2'));
    	if(empty($data['oldpwd'])){
    		$this->error(L('member_savepwd_empty_oldpwd'));
    	}
    	if(empty($data['newpwd'])){
    		$this->error(L('member_savepwd_empty_newpwd'));
    	}
    	if(empty($data['newpwd2'])){
    		$this->error(L('member_savepwd_empty_newpwd2'));
    	}
    	
    	$newpwd = $data['newpwd'];
    	if(md5($data['oldpwd']) != $this->memberinfo['password']){
    		$this->error(L('member_savepwd_neq_oldpwd'));
    	}
    	
    	$member = D('Member');
    	$membermap['id'] = array('eq',$this->memberinfo['id']);
    	$info = $member->where($membermap)->setField('password', md5($newpwd));
    	if($info !== false){
    		//清楚登录数据
    		loginClear($this->memberinfo['id']);
    		$this->success(L('member_savepwd_success'));
    	}else{
    		$this->error(L('member_savepwd_error'));
    	}
    }

    
    //添加好友分组
    public function friendsGroupAdd(){
    	$data = Init_GP(array('name'));
    	if(empty($data['name'])){
    		$this->error(L('member_friendsgroupadd_empty_name'));
    	}
    	$friends_group = D('Friends_group');
    	$map['name'] = array('eq',$data['name']);
    	$map['uid'] = array('eq',$this->memberinfo['id']);
    	if($friends_group->isExist($map)){
    		$this->error(L('member_friendsgroupadd_isexist'));
    	}
    	$data['uid'] = $this->memberinfo['id'];
    	$info = $friends_group->insert($data);
    	if($info){
    		$result = array(
    			'id'=>$info,
    			'name'=>$data['name'],
    		);
    		$this->success($result);
    	}else{
    		$this->error(L('operational_error'));
    	}
    }
    
    //编辑好友分组
    public function friendsGroupEdit(){
   		$data = Init_GP(array('id','name'));
   		$id = intval($data['id']);
    	if(empty($data['name'])){
    		$this->error(L('member_friendsgroupadd_empty_name'));
    	}
    	if(!$id){
    		$this->error(L('operational_error'));
    	}
    	$friends_group = D('Friends_group');
    	$friends_groupdata = $friends_group->getOne($id);
    	if($friends_groupdata['uid'] != $this->memberinfo['id']){
    		$this->error(L('operational_error'));
    	}
    	$map['name'] = array('eq',$data['name']);
		$map['id'] = array('neq',$id);
    	$map['uid'] = array('eq',$this->memberinfo['id']);
    	if($friends_group->isExist($map)){
    		$this->error('member_friendsgroupadd_isexist');
    	}
    	$friends_groupdata['name'] = $data['name'];
    	$info = $friends_group->update($friends_groupdata);
    	if($info !== false){
    		$result = array(
    			'id'=>$friends_groupdata['id'],
    			'name'=>$friends_groupdata['name'],
    		);
    		$this->success($result);
    	}else{
    		$this->error(L('operational_error'));
    	}
    }
    
    //删除分组
    public function friendsGroupDel(){
    	$data = Init_GP(array('id'));
   		$id = intval($data['id']);
    	if(!$id){
    		$this->error(L('operational_error'));
    	}
    	$friends_group = D('Friends_group');
    	$friends_groupdata = $friends_group->getOne($id);
    	if($friends_groupdata['uid'] != $this->memberinfo['id']){
    		$this->error(L('operational_error'));
    	}
    	$info = $friends_group->delete($id);
    	if($info){
    		
    		$this->success(L('delete_success'));
    	}else{
    		$this->error(L('operational_error'));
    	}
    }
    
    //设置用户分组
    public function friendsSetGroup(){
    	$data = Init_GP(array('gid','uid'));
    	$friends = D('Friends');
    	$map = array(
    		'main'=>array('eq',$this->memberinfo['id']),
    		'friend'=>array('eq',$data['uid']),
    	);
    	$friendsdata = $friends->where($map)->find();
    	if(empty($friendsdata)){
    		$this->error(L('operational_error'));
    	}
    	
    	$friendsdata['gid'] = $data['gid'];
    	$info = $friends->update($friendsdata);
    	if($info !== false){
    		$this->success(L('operational_success'));
    	}else{
    		$this->error(L('operational_error'));
    	}
    	
    }

	//我的优惠券
    public function mycoupons(){
	    $data = Init_GP(array('filter'));
		$coupon = D('Coupon');
		//获取用户优惠券
		$map['uid'] = array('eq',$this->memberinfo['id']);
		$now = time();
		if($data['filter'] == 'unused'){
		    $map['status'] = array('eq',0);
		}elseif($data['filter'] =='used'){
		    $map['status'] = array('eq',1);
		}elseif($data['filter'] =='freeze'){
			$map['status'] = array('eq',2);
		}elseif($data['filter'] =='expired'){
			$map['status'] = array('eq',0);
		    $map['endtime'] = array('lt',$now);
		}
		$count = $coupon->getCount($map);
    	$limit = $this->page($count,'',$data); 
		$couponsdata = $coupon->getDataAll($map,$limit);
		$allow_sms =C('sysconfig.site_sendsms_coupon');
		$this->assign('now',$now);
		$this->assign('filter',$data['filter']);
		$this->assign('couponsdata',$couponsdata);
		$this->assign('allow_sms',$allow_sms);
    	$this->display();
    }
	public function smscoupon(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
		
		$config = C('sysconfig');
		$coupon = D('Coupon');
		$coupondata = $coupon->getOne($id);
		if($coupondata['uid'] != $this->memberinfo['id']){
			$this->error(L('member_smscoupon_self').$config['site_couponname']);
		}
		if($coupondata['status'] == 1){
			$this->error($config['site_couponname'].L('member_smscoupon_used'));
		}
		if($coupondata['status'] == 2){
			$this->error($config['site_couponname'].L('member_smscoupon_freeze'));
		}
		$tip = $coupon->sms_coupon($coupondata);
		if($tip===true){
		    $this->success(L('send_success'));
		}elseif($tip==-1){
		    $this->error(L('member_smscoupon_error_close'));
		}elseif($tip==-2){
		    $this->error($config['site_couponname'].L('member_smscoupon_lapsed'));
		}elseif($tip==-3){
		    $this->error($config['site_couponname'].L('member_smscoupon_num_error'));
		}elseif($tip==-4){
		    $this->error(L('member_smscoupon_phone_error'));
		}else{
		    $this->error(L('send_error'));
		}

    }
	public function printcoupon(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
		$config = C('sysconfig');
		$coupon = D('Coupon');
		$coupondata = $coupon->getOne($id);
		if(empty($coupondata)){
			$this->error(L('operational_error'));
		}
		
		if($coupondata['uid'] != $this->memberinfo['id']){
			$this->error(L('member_smscoupon_self').$config['site_couponname']);
		}
		if($coupondata['status'] == 1){
			$this->error($config['site_couponname'].L('member_smscoupon_used'));
		}
		if($coupondata['status'] == 2){
			$this->error($config['site_couponname'].L('member_smscoupon_freeze'));
		}
		$this->assign('coupondata',$coupondata);
    	$this->display();
    }
	//商品详情
    public function gooddetail(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
 		$goods = D('Goods');
 		$gooddata = $goods->getOne($id);
		
		$order_details = D('Order_details');
		$map['gid'] = array('eq',$id);
		$map['status'] = array('eq',1);
		$payuids =array();
		$payuids = $order_details->where($map)->getField('id,uid');
		if(!empty($payuids))$payuids = array_unique($payuids);
		$paycount = count($payuids);
	    $buycount = $order_details->where($map)->sum('num');
		$paymoney = $order_details->where($map)->sum('total');
		$this->assign('gooddata',$gooddata);
		$this->assign('paycount',intval($paycount));
		$this->assign('buycount',intval($buycount));
		$this->assign('paymoney',intval($paymoney));
    	$this->display();
    }
	//优惠券下载
    public function downcoupons(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
		$config = C('sysconfig');
		$goods = D('Goods');
 		$gooddata = $goods->getOne($id);
		
		$coupon = D('Coupon');
        $map['gid'] = array('eq',$id);
		$couponsdata = $coupon->getDataAll($map);
  		$keynames = array(
			'sn' => L('voucher_sn'),
			'username' => L('voucher_username'),
			'pass' => L('voucher_pass'),
			'date' => L('voucher_date'),
			'status' => L('voucher_status'),
		);
		$data =array();
		foreach($couponsdata as $key=>$value) {
			$data[$key]['sn'] = $value['sn'];
			$data[$key]['username'] = $value['buyer']['name'];
			$data[$key]['pass'] = '******';
			$data[$key]['date'] = date('Y-m-d', $value['starttime']).'～'.date('Y-m-d', $value['endtime']);
			$data[$key]['status'] = getCouponstatus($value['status']);
		}
  		
  		exportExcel($data,$keynames,$gooddata['short_title'].''.$config['site_couponname'].date('Ymd'));
    }
	//卖出的优惠券
    public function sellcoupons(){
		$this->_check_business();
    	$data = Init_GP(array('filter','title','sn'));
		$coupon = D('Coupon');
		//获取用户优惠券
		$map['promulgator'] = array('eq',$this->memberinfo['id']);
		$now = time();
		if($data['filter'] == 'unused'){
		    $map['status'] = array('eq',0);
		}elseif($data['filter'] =='used'){
		    $map['status'] = array('eq',1);
		}elseif($data['filter'] =='freeze'){
			$map['status'] = array('eq',2);
		}elseif($data['filter'] =='expired'){
			$map['status'] = array('eq',0);
		    $map['endtime'] = array('lt',$now);
		}
		
		if(!empty($data['title'])){
			$goods = D('Goods');
			$goodsmap['_string'] = "LOCATE('{$data['title']}',`title`)>0";
			$ids = $goods->getGather($goodsmap);
			$map['gid'] = array('in',$ids);
		}
    	if(!empty($data['sn'])){
			$map['sn'] = array('like',"%{$data['sn']}%");
		}
		
    	$count = $coupon->getCount($map);
    	$limit = $this->page($count,'',$data);
    	$couponsdata = $coupon->getDataAll($map,$limit);
    	$this->assign('now',$now);
		$this->assign('filter',$data['filter']);
		$this->assign('title',$data['title']);
		$this->assign('sn',$data['sn']);
    	$this->assign('couponsdata',$couponsdata);
    	$this->display();
    }
	//消费登记
    public function verifycoupon(){
		$this->_check_business();
    	$this->display();
    }
	//查询优惠券
    public function querycoupon(){
		$this->_check_business();
	    $data = Init_GP(array('sn'));
		$config = C('sysconfig');
		if(empty($data['sn']))$this->error(L('member_querycoupon_empty_sn').$config['site_couponname'].L('voucher_sn'));
		
		$coupon = D('Coupon');
		$map['sn'] = array('eq',$data['sn']);
		$map['promulgator'] = array('eq',$this->memberinfo['id']);
		$coupondata = $coupon->getOne($map);
		if(empty($coupondata)) { 
			$msg = "#{$data['sn']}&nbsp;".L('member_querycoupon_invalid');
		}elseif($coupondata['status'] == 1){
			$msg = $config['site_couponname'].L('member_querycoupon_used').date('Y-m-d H:i:s',$coupondata['consume_time']);
		}elseif($coupondata['status'] == 2){
			$msg = $config['site_couponname'].L('member_querycoupon_freeze');
		}elseif($coupondata['endtime'] < strtotime(date('Y-m-d'))) {
			$msg = "#{$data['sn']}&nbsp;".L('member_querycoupon_expired').date('Y-m-d', $coupon['endtime']);
		}else{
			$msg = "#{$data['sn']}&nbsp;".L('member_querycoupon_effective').":{$coupondata['good']['short_title']}<br />".L('member_querycoupon_validity')."&nbsp;".date('Y-m-d',$coupondata['starttime'])."～".date('Y-m-d',$coupondata['endtime']);
		}
		$this->success($msg);
    }
	//消费优惠券
    public function consumecoupon(){
		$this->_check_business();
	   	$data = Init_GP(array('sn','pass'));
		$config = C('sysconfig');
		if(empty($data['sn']))$this->error(L('member_querycoupon_empty_sn').$config['site_couponname'].L('voucher_sn'));
		if(empty($data['pass']))$this->error(L('member_querycoupon_empty_sn').$config['site_couponname'].L('voucher_pass'));
		
		$coupon = D('Coupon');
		$map['sn'] = array('eq',$data['sn']);
		$map['promulgator'] = array('eq',$this->memberinfo['id']);
		$coupondata = $coupon->getOne($map);
		
		if(empty($coupondata)) { 
			$msg = "#{$data['sn']}&nbsp;".L('member_querycoupon_invalid')."<br />".L('member_consumecoupon_error');
			$this->error($msg);
		}elseif($coupondata['pass']!=$data['pass']) {
			$msg = $config['site_couponname'].L('member_consumecoupon_pass_error').'<br />'.L('member_consumecoupon_error');
			$this->error($msg);
    	}elseif($coupondata['status'] == 1){
			$msg = "#{$data['sn']}&nbsp;".L('member_querycoupon_used').date('Y-m-d H:i:s',$coupondata['consume_time'])."<br />".L('member_consumecoupon_error');
			$this->error($msg);
		}elseif($coupondata['status'] == 2){
			$msg = $config['site_couponname'].L('member_querycoupon_freeze');
		}elseif($coupondata['starttime'] > strtotime(date('Y-m-d'))) {
			$msg = "#{$data['sn']}&nbsp;".L('member_consumecoupon_not_yet')."&nbsp;".date('Y-m-d',$coupondata['starttime'])."～".date('Y-m-d',$coupondata['endtime']);
			$this->error($msg);
		}elseif($coupondata['endtime'] < strtotime(date('Y-m-d'))) {
			$msg = "#{$data['sn']}&nbsp;".L('member_querycoupon_expired').date('Y-m-d',$coupondata['endtime'])."<br />".L('member_consumecoupon_error');
			$this->error($msg);
		}else{
		    $now = time();
		    $tip = $coupon->where($map)->setField('status',1);
			$tip = $coupon->where($map)->setField('consume_time',$now);
			$coupon->consume_sms($coupondata['id']);
			$coupon->consume_mail($coupondata['id']);
			$msg = $config['site_couponname'].L('member_querycoupon_effective')."{$coupondata['good']['short_title']}<br />".L('member_consumecoupon_time').date('Y-m-d H:i:s',$now)."<br />".L('member_consumecoupon_success');
			$commission = D('Commission');
			$commission->distribution($coupondata);
			$this->success($msg);
		}
    }
	//提现
	public function withdraw(){
		$this->display();
	}
	//增加提现请求
	public function addwithdraw(){
	    $data = Init_GP(array('cash','bank_id','realname','bank_card','remark'));
		$data['uid'] = $this->memberinfo['id'];
		if(toPrice($data['cash']) <= 0)$this->error(L('member_addwithdraw_cash'));
		if(empty($data['bank_id']))$this->error(L('member_addwithdraw_bank_id'));
		if(empty($data['bank_card']))$this->error(L('member_addwithdraw_bank_card'));
		if(toPrice($data['cash']) > toPrice($this->memberinfo['cash']))$this->error(L('member_addwithdraw_cash_lt'));
		$withdraw = D('Withdraw');
		$tip = $withdraw->insert($data);
		if($tip){
  			$member = D('Member');
  			$member->setDec('cash',"id={$data['uid']}",toPrice($data['cash']));
  			$log = D('Cash_log');
  			$logdata = array(
  				'uid'=>$data['uid'],
  				'val'=>-$data['cash'],
  				'content'=>'[withdraw]',
  				'addtime'=>time(),
  			);
  			$log->insert($logdata);
			$this->success(L('member_addwithdraw_success'));
		}else{
			$this->error(L('member_addwithdraw_error'));
		}
	} 
	//提现记录
	public function withdraw_log(){
	    $withdraw = D('Withdraw');
    	$map['uid'] = array('eq',$this->memberinfo['id']);
    	$map['cash'] = array('gt',0);
    	$count = $withdraw->getCount($map);
    	$limit = $this->page($count);
    	$withdrawdata = $withdraw->getDataAll($map,$limit);
    	$this->assign('withdrawdata',$withdrawdata);
    	$this->display();
	}
    //查看提现
	public function view_withdraw(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
		$withdraw = D('Withdraw');
		$withdrawdata = $withdraw->getOne($id);
		if($withdrawdata['uid'] != $this->memberinfo['id'])$this->error(L('operational_error'));
		$this->assign('withdrawdata',$withdrawdata);
		$this->display();
	} 
	//撤销提现
	public function undo_withdraw(){
	    $data = Init_GP(array('id'));
		$id = intval($data['id']);
		$withdraw = D('Withdraw');
		$withdrawdata = $withdraw->getOne($id);
		if($withdrawdata['uid'] != $this->memberinfo['id'])$this->error(L('operational_error'));
		if($withdrawdata['status'] >0)$this->error(L('operational_error'));
  		$withdrawdata['status'] = 3;
  		$info = $withdraw->update($withdrawdata);
  		if($info !== false){
  			$member = D('Member');
  			$tip = $member->setInc('cash',"id={$withdrawdata['uid']}",toPrice($withdrawdata['cash']));
  			$log = D('Cash_log');
  			$logdata = array(
  				'uid'=>$withdrawdata['uid'],
  				'val'=>$withdrawdata['cash'],
  				'content'=>'[undo_withdraw]',
  				'addtime'=>time(),
  			);
  			$log->add($logdata);
  			$this->success(L('revocation_success'));
  		}else{
  			$this->error(L('revocation_error'));
  		}
	}
    //账户日志
	public function cashlogs(){
		$cash_log = D('Cash_log');
    	$map['uid'] = array('eq',$this->memberinfo['id']);
    	$count = $cash_log->getCount($map);
    	$limit = $this->page($count);
    	$cash_logsdata = $cash_log->getDataAll($map,$limit);
    	$this->assign('cash_logsdata',$cash_logsdata);
    	$this->display();
	}
    //聊天日志
	public function chatLog(){
	    $data = Init_GP(array('uid','name'));
	    if(!empty($data['name'])){
	    	$member = D('Member');
	    	$membermap['name'] = array('like',"%{$data['name']}%");
	    	$memberdata = $member->getOne($membermap);
	    	if($memberdata){
	    		$uid = $memberdata['id'];
	    	}
	    }
		$chatlog = D('Chat_log');
		//获取用户提醒
		$uid = isset($uid)?$uid:intval($data['uid']);
		if(empty($uid) && empty($data['name'])){
			$chatlogwhere = array(
				'send' =>array('eq',$this->memberinfo['id']),
				'receive' =>array('eq',$this->memberinfo['id']),
				'_logic'=>'or',
			);
			$chatlogmap['_complex'] = $chatlogwhere;
			$chatlogmap['delid'] = array('neq',$this->memberinfo['id']);
			$count = $chatlog->getCount($chatlogmap);
	    	$limit = $this->page($count,'',$data); 
			$chatlogsdata = $chatlog->getData($chatlogmap,$limit);
		}else{
			$count = $chatlog->getDialogueCount($uid,$this->memberinfo['id']);
			$limit = $this->page($count,'',$data);
			$chatlogsdata = $chatlog->getDialogue($uid,$this->memberinfo['id'],$limit);
		}
		
		$this->assign('chatlogsdata',$chatlogsdata);
		$this->assign('name',$data['name']);
		$this->display();
	}
	
	public function delChatLog(){
		$data = Init_GP(array('id'));
		$id = intval($data['id']);
		$chatlog = D('Chat_log');
		$chatlogdata = $chatlog->getOne($id);
		
		if(!empty($chatlogdata) && ($chatlogdata['send'] == $this->memberinfo['id'] || $chatlogdata['receive'] == $this->memberinfo['id'])){
			if(empty($chatlogdata['delid'])){
				$logdata = array(
					'id'=>$chatlogdata['id'],
					'delid'=>$this->memberinfo['id'],
				);
				$info = $chatlog->update($logdata);
			}else{
				$chatlog->delete($id);
			}
			$this->success(L('delete_success'));
		}else{
			$this->error(L('delete_error'));
		}
	}
	public function drawback(){
	    $data = Init_GP(array('id'));
		$config = C('sysconfig');
		if($config['site_refund_isallow']==0)$this->error (L('member_drawback_isallow'));
		$id = intval($data['id']);
	    $uid = $this->memberinfo['id'];
	
		$order_details = D('Order_details');
		$o_detailsdata = $order_details->getOne($id);
		
		if($o_detailsdata['uid'] != $uid){
			$this->error (L('order_not_belong_you'));
		}
		if($o_detailsdata['refund_state'] ==1){
		    $this->error (L('member_drawback_already_apply'));
		}
		if($o_detailsdata['refund_state'] ==2){
		    $this->error (L('member_drawback_refunded'));
		}
		if($o_detailsdata['refund_state'] ==3){
		    $this->error (L('member_drawback_through'));
		}
		$this->assign('o_detailsdata',$o_detailsdata);
		$this->display();
	}
	public function applyrefund(){
	    $data = Init_GP(array('id','refund_reason'));
		$config = C('sysconfig');
		if($config['site_refund_isallow']==0)$this->error (L('member_drawback_isallow'));
		$id = intval($data['id']);
	    $uid = $this->memberinfo['id'];
	   
		$order_details = D('Order_details');
		$o_detailsdata = $order_details->getOne($id);
		if($o_detailsdata['uid'] != $uid){
			$this->error (L('order_not_belong_you'));
		}
		if($o_detailsdata['refund_state'] ==1){
		    $this->error (L('member_drawback_already_apply'));
		}
		if($o_detailsdata['refund_state'] ==2){
		    $this->error (L('member_drawback_refunded'));
		}
		if($o_detailsdata['refund_state'] ==3){
		    $this->error (L('member_drawback_through'));
		}
		$coupon = D('Coupon');
		//获取用户优惠券
		$map['uid'] = array('eq',$this->memberinfo['id']);
		$map['gid'] = array('eq',$o_detailsdata['gid']);
		$map['promulgator'] = array('eq',$o_detailsdata['good']['promulgator']['id']);
		$map['oid'] = array('eq',$o_detailsdata['id']);
		$couponsdata = $coupon->getDataAll($map);
		if(!empty($couponsdata)){
			$consume = true;
			foreach($couponsdata as $value){
				if($value['status'] == 1) $consume = $consume && true;
				elseif($value['status'] == 0) $consume = $consume && false;
			}
			if($consume)$this->error ($config['site_couponname'].L('member_applyrefund_consume'));
		}
		$data['refund_state'] = 1;
		$data['refund_applytime'] = time();
		$tip = $order_details->update($data);
		if($tip !== false){
		    $map['status'] = array('eq',0);
		    $succ = $coupon->where($map)->setField('status',2);
		    $this->success(L('member_applyrefund_success'));
		}else{
			$this->error(L('member_applyrefund_error'));
		}

	}
	
	public function doTalk_about(){
		$data = Init_GP(array('gid','imgs','content'));
		if(empty($data['gid']) && empty($data['content']) && empty($data['imgs'])){
			$this->error(L('release_error'));
		}
		if(empty($data['content'])){
			$this->error(L('release_error'));
		}
		$data['uid'] = $this->memberinfo['id'];
		$talk_about = D('Talk_about');
		$info = $talk_about->insert($data);
		if($info){
			$loginport = D('Login_port');
			if($_SESSION['sina']['bind']){
				$loginportdata = $loginport->getOne(1);
				if($loginportdata['status'] == 1){
					import("@.ORG.Loginport.WeiboAuth");
					$weiboauth = new WeiboAuth($loginportdata['appkey'],$loginportdata['appsecret']);
					$weiboauth->sendWeibo($data['content'],$_SESSION['sina']['access_token']);
				}
			}
			if($_SESSION['qq']['bind']){
				$loginportdata = $loginport->getOne(5);
				if($loginportdata['status'] == 1){
					import("@.ORG.Loginport.QQAuth");
					$qqauth = new QQAuth($loginportdata['appkey'],$loginportdata['appsecret']);
					$qqauth->sendWeibo($data['content'],$_SESSION['qq']['access_token'],$_SESSION['qq']['openid']);
				}
			}
			$this->success($info);
		}else{
			$this->error(L('release_error'));
		}
	}
	
	//说说喜欢
	public function talk_aboutLike(){
		$tid = intval($_REQUEST['tid']);
		if($tid){
			$talk_about_like = D('Talk_about_like');
			$map = array(
					'tid'=>array('eq',$tid),
					'uid'=>array('eq',$this->memberinfo['id']),
					);
			if($talk_about_like->isExist($map)){
				$this->error(L('have_been_like'));
			}
			$talk_about = D('Talk_about');
			$info = $talk_about->setInc('likes',"id={$tid}");
			if($info){
				$talk_about_likedata = array(
							'tid'=>$tid,
							'uid'=>$this->memberinfo['id'],
						);
				$talk_about_like->insert($talk_about_likedata);
				$this->success(L('operational_success'));
			}else{
				$this->error(L('operational_error'));
			}
		}
	}
	
	//说说评论
	public function doTalk_about_comment(){
		$data = Init_GP(array('tid','content'));
		if(empty($data['content'])){
			$this->error(L('release_error'));
		}
		if(empty($data['tid'])){
			$this->error(L('operational_error'));
		}
		$talk_about_comment = D('Talk_about_comment');
		$data['uid'] = $this->memberinfo['id'];
		$info = $talk_about_comment->insert($data);
		if($info){
			$this->success($info);
		}else{
			$this->error(L('operational_error'));
		}
	}
	
	public function doTalk_about_tabroadcast(){
		$data = Init_GP(array('tid','content'));
		if(empty($data['content']) || empty($data['tid'])){
			$this->error(L('release_error'));
		}
		$data['uid'] = $this->memberinfo['id'];
		$talk_about = D('Talk_about');
		$info = $talk_about->forwarding($data);
		if($info){
			$this->success($info);
		}else{
			$this->error(L('operational_error'));
		}
	}
	
	//获取当前用户的头像
	public function myHeader(){
		$this->success($this->memberinfo['header']);
	}
	
	public function administration(){
		$this->display();
	}
	
	//收到 的推荐
	public function businessInvitation(){
		$this->_check_business();
		$config = C('sysconfig');
		$message_tpl = D('Message_tpl');
		$referencesname = $message_tpl->getBody('sharereferences'); //选择模板
		$referencesname = str_replace('[webname]',$config['site_name'], $referencesname );
		$references_urllink = HOST.U('Member/addreferences/uid/'.$this->memberinfo['id']);
		$references_name = urlencode($referencesname);
		$references_pic = HOST.__ROOT__.$config['site_logo'];
		
		$this->assign('references_urllink',$references_urllink);
		$this->assign('references_name',$references_name);
		$this->assign('references_pic',$references_pic);
		$this->display();
	}
	
	//收到的评价
	public function incomeEvaluation(){
		$this->_check_business();
		$this->display();
	}
	
	//编辑常用标签
	public function editLabel(){
		$this->display();
	}

	//绑定微博
	public function bindWeibo(){
		if(empty($_SESSION['sina']['openid'])){
			$this->error(U('Login_port/index/id/1'));
		}else{
			$_SESSION['sina']['bind'] = true;
			$this->success(L('operational_success'));
		}
	}

	//绑定qq
	public function bindQQ(){
		if(empty($_SESSION['qq']['openid'])){
			$this->error(U('Login_port/index/id/5'));
		}else{
			$_SESSION['qq']['bind'] = true;
			$this->success(L('operational_success'));
		}
	}

	//移除绑定微博
	public function removeWeibo(){
		if(!empty($_SESSION['sina']['openid'])){
			$_SESSION['sina']['bind'] = false;
		}
		$this->success(L('operational_success'));
	}

	//移除qq
	public function removeQQ(){
		if(!empty($_SESSION['qq']['openid'])){
			$_SESSION['qq']['bind'] = false;
		}
		$this->success(L('operational_success'));
	}
	
	//申请商家
	public function apply_seller(){
		$apply = D('Apply');
		$map = array(
			'uid'=>array('eq',$this->memberinfo['id']),
			'status'=>array('eq',1),
		);
		if($apply->isExist($map)){
			$this->error('不需要重复操作');
		}

		if(!empty($_GET['re'])){
			$this->assign('applying',false);
			$map = array(
				'uid'=>array('eq',$this->memberinfo['id']),
				'status'=>array('eq',0),
			);
			$apply->setField('status',2,$map);
		}

		$this->display();
	}

	public function do_apply_seller(){
		$data = Init_GP(array('name','fz_name','fz_name','companyname','logo','tel','opening','type','characteristic','services','address','longitude','latitude','zoom'));

		foreach($data as $val){
			if(empty($val)){
				$this->error('参数错误');
			}
		}

		$apply = D('Apply');

		$map = array(
			'uid'=>array('eq',$this->memberinfo['uid']),
		);
		if($apply->isExist($map)){
			$this->error('不能重复提交申请');
		}

		$data['addtime'] = time();
		$data['uid'] = $this->memberinfo['id'];
		$info = $apply->add($data);
		if($info){
			$this->success('申请成功，请等待审核');
		}else{
			$this->error('操作失败');
		}
	}



}
?>