<?php
class RemindModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
				'opposite'=>array('GetNum'),
			    'content'=>array('Char_cv'),
			    'type'=>array('Char_cv'),
			    'good_id'=>array('GetNum'),
	);
	protected $_auto = array ( 
	    array('new','1'),  // 新增的时候把status字段设置为1
		array('addtime','time',1,'function'), // 对addtime字段在新增的时候写入当前时间戳
	);
    //获取提醒
    function getDataAll($map='',$limit=''){
		$data = $this->getData($map,$limit,'id desc');
		if($data){
			foreach($data as &$value){
			  $value = $this->formatRemind($value);
			}
		}
		return $data;
	}
	//获取统计值
	function getCount($map){
		return $this->where($map)->count();
	}
	/**
     *  增加会员提醒
     *
     * @access    public
	 * @param     string  $uid  会员id
     * @param     string  $type 提醒类型array('friend_request','friend','good','attention','order','commentreplyed','commented','recommended')其中之一
     * @param     string  $opposite 涉及到的用户的id
	 * @param     string  $good_id 涉及到的商品的id
	 * @param     string  $note 请求添加好友的附言
     * @return    string
     */
	function addRemind($uid,$opposite,$type,$good_id=0,$note=''){
		if (in_array($type,array('friend_request','friend','good','attention','order','commented','recommended','commentreplyed'))){
			if($type=="friend_request"){//好友请求
			    if(!empty($note))$note="[pre]：".$note;
				$content = '[actor] [text]'.$note.'&nbsp;&nbsp;[addurl]';
			}elseif($type=="friend"){//成为好友
				$content = '[actor] [text]';
			}elseif($type=="good"){//商品审核通过
				$content = '[text_before] [goodurl] [text_after]';
			}elseif($type=="attention"){//被关注
				$content = '[actor] [text]';
			}elseif($type=="order"){//商品被购买
				$content = '[actor] [text] [goodurl]';
			}elseif($type=="commented"){//被评论
				if(empty($good_id)){
				    $content = '[actor] [text]';
				}else{
					$content = '[actor] [text] [goodurl]';
				}
			}elseif($type=="recommended"){//商品被推荐
				$content = '[actor] [text] [goodurl]';
			}elseif($type=="commentreplyed"){//评论被回复
				$content = '[actor] [text_before] [goodurl] [text_after]';
			}
			$reminddata = array(
				'uid'=>$uid,
				'opposite'=>$opposite,
				'content'=>$content,
				'type'=>$type,
				'good_id'=>$good_id,
			);
			$tip = $this->insert($reminddata);
			return $tip;
		}else{
			return false;
		}
	}
	//格式化动态数据
	function formatRemind($reminddata){
		$member = D('Member');
		$memberdata = $member->getOne($reminddata['opposite']);
		$sapceurl = U('User/space/id/'.$reminddata['opposite']);
		if($reminddata['type']=="friend_request"){//好友请求
			$addurl = U('Member/friendadd/id/'.$reminddata['opposite']);
			$reminddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[addurl]','<a class="addfriend" href="'.$addurl.'">'.L('member_formatremind_friend_request_addurl').'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[text]',L('member_formatremind_friend_request_text'), $reminddata['content']);
			$reminddata['content'] = str_replace('[pre]',L('member_formatremind_friend_request_pre'), $reminddata['content']);
		}elseif($reminddata['type']=="friend"){//成为好友
			$reminddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[text]',L('member_formatremind_friend_friend_text'), $reminddata['content']);
		}elseif($reminddata['type']=="good"){//商品审核通过
			$goods = D('Goods');
			$gooddata = $goods->getOne($reminddata['good_id']);
			$goodurl = U('Goods/index/id/'.$reminddata['good_id']);
			$reminddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[text_before]',L('member_formatremind_good_text_before'), $reminddata['content']);
			$reminddata['content'] = str_replace('[text_after]',L('member_formatremind_good_text_after'), $reminddata['content']);
		}elseif($reminddata['type']=="attention"){//被关注
			$reminddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[text]',L('member_formatremind_attention_text'), $reminddata['content']);
		}elseif($reminddata['type']=="order"){//商品被购买
			$goods = D('Goods');
			$gooddata = $goods->getOne($reminddata['good_id']);
			$goodurl = U('Goods/index/id/'.$reminddata['good_id']);
			$reminddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>！', $reminddata['content']);
			$reminddata['content'] = str_replace('[text]',L('member_formatremind_order_text'), $reminddata['content']);
		}elseif($reminddata['type']=="commented"){//被评论
			if(empty($reminddata['good_id'])){
				$reminddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $reminddata['content']);
				$reminddata['content'] = str_replace('[text]',L('member_formatremind_commented_text'), $reminddata['content']);
			}else{
				$goods = D('Goods');
				$gooddata = $goods->getOne($reminddata['good_id']);
				$goodurl = U('Goods/index/id/'.$reminddata['good_id']);
				$reminddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $reminddata['content']);
				$reminddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>！', $reminddata['content']);
				$reminddata['content'] = str_replace('[text]',L('member_formatremind_commented_goods_text'), $reminddata['content']);
			}
		}elseif($reminddata['type']=="recommended"){//商品被推荐
			$goods = D('Goods');
			$gooddata = $goods->getOne($reminddata['good_id']);
			$goodurl = U('Goods/index/id/'.$reminddata['good_id']);
			$reminddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>！', $reminddata['content']);
			$reminddata['content'] = str_replace('[text]',L('member_formatremind_recommended_text'), $reminddata['content']);
		}elseif($reminddata['type']=="commentreplyed"){//评论被回复
			$goods = D('Goods');
			$gooddata = $goods->getOne($reminddata['good_id']);
			$goodurl = U('Goods/index/id/'.$reminddata['good_id']);
			$reminddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>', $reminddata['content']);
			$reminddata['content'] = str_replace('[text_before]',L('member_formatremind_commentreplyed_text_before'), $reminddata['content']);
			$reminddata['content'] = str_replace('[text_after]',L('member_formatremind_commentreplyed_text_after'), $reminddata['content']);
		}
		
        return $reminddata;
	} 
}
?>