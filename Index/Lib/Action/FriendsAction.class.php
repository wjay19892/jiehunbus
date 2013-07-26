<?php
class FriendsAction extends CommonAction
{
	public function ajaxSpaceFriends(){
    //获取查询条件
    	$data = Init_GP(array('uid','limit'));
    	$uid = intval($data['uid']);
		$limit = intval($data['limit']);
		$allshownum = $limit+8;
		$limit = $limit.",8";
        
	    $friends = D('Friends');
		$friendsnum = $friends->getFriendsCount($uid);
		$memb_frimap['main'] = array('eq',$uid);
		$friendsdata = $friends->getDataAll($memb_frimap,$limit);
		
		$this->assign('friendsdata',$friendsdata);
		$this->assign('allshownum',$allshownum);
		$this->assign('friendsnum',$friendsnum);
		$result = $this->fetch('spacelist');
		$this->ajaxReturn($result,'',1);
    }
    
}
?>