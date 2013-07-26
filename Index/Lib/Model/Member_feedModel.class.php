<?php
//系统配置
class Member_feedModel extends CommonModel {
	protected $_filter = array(
				'id'=>array('GetNum'),
				'uid'=>array('GetNum'),
			    'content'=>array('Char_cv'),
			    'type'=>array('Char_cv'),
			    'rel_id'=>array('GetNum'),
			    'rel_module'=>array('Char_cv'),
	);
	protected $_auto = array ( 
		array('addtime','time',1,'function'), // 对addtime字段在新增的时候写入当前时间戳
		array('status','1'),  // 新增的时候把status字段设置为1
	);
	//获取多个的所有数据
	function getDataAll($map='',$limit=''){
		$data = $this->getData($map,$limit,'id desc');
		foreach($data as &$value){
		  $value = $this->formatFeed($value);
		}
		return $data;
	}
	//获取统计值
	function getCount($map){
		return $this->where($map)->count();
	}
    /**
     *  记录会员动态
     *
     * @access    public
	 * @param     string  $uid  会员id
     * @param     string  $type 动态类型array('info','avatar','good','friend','attention','order','comment','recommend','commentreply','commented','recommended')其中之一
     * @param     string  $rel_id 涉及到的内容的id
	 * @param     string  $rel_module 设计到的操作
     * @return    string
     */
	function addFeed($uid,$type,$rel_id,$rel_module){
	    if (in_array($type,array('info','avatar','good','friend','attention','order','comment','recommend','commentreply','commented','recommended'))){
			$member_info = D('Member_info');
			$infodata = $member_info->getInfo($uid);
			if(empty($infodata)){
				$data['uid'] = $uid;
				$id = $member_info->insert($data);
				$infodata = $member_info->getOne($id);
			}
			//确定是否需要记录
			if ($infodata[$type.'_isfeed'] == 1){
				if($type=="info"){//更新个人资料
					$content = '[actor] [text]';
				}elseif($type=="avatar"){//更新头像
					$content = '[actor] [text]';
				}elseif($type=="good"){//发布商品
					$content = '[actor] [text] [goodurl]';
				}elseif($type=="friend"){//添加好友
					$content = '[actor] [text_before] [touser] [text_after]';
				}elseif($type=="attention"){//关注用户
					$content = '[actor] [text] [touser]';	
				}elseif($type=="order"){//购买商品
					$content = '[actor] [text] [goodurl]';
				}elseif($type=="comment"){//发表评论
				    if($rel_module=="Goods"){
						$content = '[actor] [text] [goodurl]';
					}elseif($rel_module=="Member"){
						$content = '[actor] [text] [touser]';
					}
				}elseif($type=="recommend"){//发表推荐
					$content = '[actor] [text] [goodurl]';
				}elseif($type=="commentreply"){//回复评论
					$content = '[actor] [text_before] [goodurl] [text_after]';
				}elseif($type=="commented"){//获得评论
				    if($rel_module=="Goods"){;
						$content = '[actor] [text_before] [goodurl] [text_after]';
					}elseif($rel_module=="Member"){
						$content = '[actor] [text_before] [touser] [text_after]';
					}
				}elseif($type=="recommended"){//获得推荐
					$content = '[actor] [text_before] [goodurl] [text_after]';
				}
				$feeddata = array(
					'uid'=>$uid,
					'content'=>$content,
					'type'=>$type,
					'rel_id'=>$rel_id,
					'rel_module'=>$rel_module,
				);
				$tip = $this->insert($feeddata);
				return $tip; 
			}else{
				return true;
			}
		}else{
			return false;
		}
    }
	//格式化动态数据
	function formatFeed($feeddata){
		$member = D('Member');
		$memberdata = $member->getOne($feeddata['uid']);
		$sapceurl = U('User/space/id/'.$feeddata['uid']);
		if($feeddata['type']=="info"){//更新个人资料
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[text]',L('member_formatfeed_info_text'), $feeddata['content']);
		}elseif($feeddata['type']=="avatar"){//更新头像
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[text]',L('member_formatfeed_avatar_text'), $feeddata['content']);
		}elseif($feeddata['type']=="good"){//发布商品
			$goods = D('Goods');
			$gooddata = $goods->getOne($feeddata['rel_id']);
			$goodurl = U('Goods/index/id/'.$feeddata['rel_id']);
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>！', $feeddata['content']);
			$feeddata['content'] = str_replace('[text]',L('member_formatfeed_good_text'), $feeddata['content']);
		}elseif($feeddata['type']=="friend"){//添加好友
			$frienddata = $member->getOne($feeddata['rel_id']);
			$f_sapceurl = U('User/space/id/'.$feeddata['rel_id']);
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[touser]','<a target="_blank" href="'.$f_sapceurl.'">'.$frienddata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[text_before]',L('member_formatfeed_friend_text_before'), $feeddata['content']);
			$feeddata['content'] = str_replace('[text_after]',L('member_formatfeed_friend_text_after'), $feeddata['content']);
		}elseif($feeddata['type']=="attention"){//关注用户
			$attentiondata = $member->getOne($feeddata['rel_id']);
			$a_sapceurl = U('User/space/id/'.$feeddata['rel_id']);
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[touser]','<a target="_blank" href="'.$a_sapceurl.'">'.$attentiondata['name'].'</a>！', $feeddata['content']);
			$feeddata['content'] = str_replace('[text]',L('member_formatfeed_attention_text'), $feeddata['content']);
		}elseif($feeddata['type']=="order"){//购买商品
			$goods = D('Goods');
			$gooddata = $goods->getOne($feeddata['rel_id']);
			$goodurl = U('Goods/index/id/'.$feeddata['rel_id']);
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>！', $feeddata['content']);
			$feeddata['content'] = str_replace('[text]',L('member_formatfeed_order_text'), $feeddata['content']);
		}elseif($feeddata['type']=="comment"){//发表评论
			if($feeddata['rel_module']=="Goods"){
				$goods = D('Goods');
				$gooddata = $goods->getOne($feeddata['rel_id']);
				$goodurl = U('Goods/index/id/'.$feeddata['rel_id']);
				$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
				$feeddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>！', $feeddata['content']);
				$feeddata['content'] = str_replace('[text]',L('member_formatfeed_comment_goods_text'), $feeddata['content']);
			}elseif($feeddata['rel_module']=="Member"){
				$userdata = $member->getOne($feeddata['rel_id']);
				$u_sapceurl = U('User/space/id/'.$feeddata['rel_id']);
				$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
                $feeddata['content'] = str_replace('[touser]','<a target="_blank" href="'.$u_sapceurl.'">'.$userdata['name'].'</a>！', $feeddata['content']);
				$feeddata['content'] = str_replace('[text]',L('member_formatfeed_comment_member_text'), $feeddata['content']);
			}
		}elseif($feeddata['type']=="recommend"){//发表推荐
			$goods = D('Goods');
			$gooddata = $goods->getOne($feeddata['rel_id']);
			$goodurl = U('Goods/index/id/'.$feeddata['rel_id']);
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>！', $feeddata['content']);
			$feeddata['content'] = str_replace('[text]',L('member_formatfeed_recommend_text'), $feeddata['content']);
		}elseif($feeddata['type']=="commentreply"){//回复评论
			$goods = D('Goods');
			$gooddata = $goods->getOne($feeddata['rel_id']);
			$goodurl = U('Goods/index/id/'.$feeddata['rel_id']);
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[text_before]',L('member_formatfeed_commentreply_text_before'), $feeddata['content']);
			$feeddata['content'] = str_replace('[text_after]',L('member_formatfeed_commentreply_text_after'), $feeddata['content']);
		}elseif($feeddata['type']=="commented"){//获得评论
			if($feeddata['rel_module']=="Goods"){
				$goods = D('Goods');
				$gooddata = $goods->getOne($feeddata['rel_id']);
				$goodurl = U('Goods/index/id/'.$feeddata['rel_id']);
				$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
				$feeddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>', $feeddata['content']);
				$feeddata['content'] = str_replace('[text_before]',L('member_formatfeed_commented_goods_text_before'), $feeddata['content']);
				$feeddata['content'] = str_replace('[text_after]',L('member_formatfeed_commented_goods_text_after'), $feeddata['content']);
			}elseif($feeddata['rel_module']=="Member"){
				$userdata = $member->getOne($feeddata['rel_id']);
				$u_sapceurl = U('User/space/id/'.$feeddata['rel_id']);
				$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
                $feeddata['content'] = str_replace('[touser]','<a target="_blank" href="'.$u_sapceurl.'">'.$userdata['name'].'</a>', $feeddata['content']);
				$feeddata['content'] = str_replace('[text_before]',L('member_formatfeed_commented_member_text_before'), $feeddata['content']);
				$feeddata['content'] = str_replace('[text_after]',L('member_formatfeed_commented_member_text_after'), $feeddata['content']);
			}
		}elseif($feeddata['type']=="recommended"){//获得推荐
			$goods = D('Goods');
			$gooddata = $goods->getOne($feeddata['rel_id']);
			$goodurl = U('Goods/index/id/'.$feeddata['rel_id']);
			$feeddata['content'] = str_replace('[actor]','<a target="_blank" href="'.$sapceurl.'">'.$memberdata['name'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[goodurl]','<a target="_blank" href="'.$goodurl.'">'.$gooddata['title'].'</a>', $feeddata['content']);
			$feeddata['content'] = str_replace('[text_before]',L('member_formatfeed_recommended_text_before'), $feeddata['content']);
			$feeddata['content'] = str_replace('[text_after]',L('member_formatfeed_recommended_text_after'), $feeddata['content']);
		}
        return $feeddata;
	} 
}
?>