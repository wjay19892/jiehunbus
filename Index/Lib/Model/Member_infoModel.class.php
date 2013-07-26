<?php
//系统配置
class Member_infoModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
			    'index_privacy'=>array('GetNum'),
			    'info_privacy'=>array('GetNum'),
			    'friend_privacy'=>array('GetNum'),
			    'good_privacy'=>array('GetNum'),
			    'comment_privacy'=>array('GetNum'),
			    'recommend_privacy'=>array('GetNum'),
			    'info_isfeed'=>array('GetNum'),
			    'avatar_isfeed'=>array('GetNum'),
			    'good_isfeed'=>array('GetNum'),
			    'friend_isfeed'=>array('GetNum'),
				'attention_isfeed'=>array('GetNum'),
			    'order_isfeed'=>array('GetNum'),
			    'comment_isfeed'=>array('GetNum'),
			    'recommend_isfeed'=>array('GetNum'),
			    'commentreply_isfeed'=>array('GetNum'),
			    'commented_isfeed'=>array('GetNum'),
			    'recommended_isfeed'=>array('GetNum'),
	);
	
	function getInfo($uid){
		if($uid){
			if(is_array($uid)){
				$data = $this->where($uid)->find();
			}else{
			    $map["uid"] = array('eq',$uid);
				$data = $this->where($map)->find();
			}
		}else{
			$data = array();
		}
		return $data;
	}
}
?>