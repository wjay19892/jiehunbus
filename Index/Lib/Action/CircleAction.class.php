<?php
class CircleAction extends CommonAction
{
	public function index(){
		$data = Init_GP(array('search_key','lid'));
		$circle = D('Circle');
		$circledata = $circle->getData();
		$this->assign('circledata',$circledata);
		$this->assign('condition',json_encode($data));
		$this->display();
	}
	
	public function ajaxCircle(){
		$data = Init_GP(array('search_key','lid','uid','attention','wasAttention','friends','at','like'));
		$map = $this->_filters($data);
		
		$talk_about = D('Talk_about');
		$talk_about_count = $talk_about->getCount($map);
		$limit = $this->page($talk_about_count,'',$data);
		$talk_aboutdata = $talk_about->getDataAll($map,$limit);
		$this->assign('talk_aboutdata',$talk_aboutdata);
		$result['html'] = $this->fetch('list');
		$result['page'] = $this->get('page');
		$this->success($result);
	}
	
	protected function _filters($data){
		$search_key = $data['search_key'];
		$map = array();
		if(!empty($search_key) && $search_key != L('search_input_tip')){
			$key_array = preg_split('/[\s|\,|\+|\-]/i', $search_key);
			foreach($key_array as &$value){
				$value = "LOCATE('{$value}',`content`)>0";
			}
			$map['_string'] = implode(' and ', $key_array);
		}
		$lid = intval($data['lid']);
		if($lid){
			$label_relation = D('Label_relation');
			$label_relationmap['lid'] = array('eq',$lid);
			$ids = $label_relation->getGather($label_relationmap,'tid');
			$map['id'] = array('in',$ids);
		}
		
		$uid = intval($data['uid']);
		if($uid){
			$map['uid'] = array('eq',$uid);
		}
		
		$attention = intval($data['attention']);
		if($attention){
			$attentionmodel = D('Attention');
			$attentionmap['was'] = array('eq',$attention);
			$map['uid'] = array('in',$attentionmodel->getGather($attentionmap,'main'));
		}
		
		$wasAttention = intval($data['wasAttention']);
		if($wasAttention){
			$attentionmodel = D('Attention');
			$attentionmap['main'] = array('eq',$wasAttention);
			$map['uid'] = array('in',$attentionmodel->getGather($attentionmap,'was'));
		}
		
		$friends = intval($data['friends']);
		if($friends){
			$friendsmodel = D('Friends');
			$friendsmap['main'] = array('eq',$friends);
			$map['uid'] = array('in',$friendsmodel->getGather($friendsmap,'friend'));
		}
		
		//提到我的
		if($data['at']){
			$talk_about_relation = D('Talk_about_relation');
			$talk_about_relationmap['uid'] = array('eq',$this->memberinfo['id']);
			$map['id'] = array('in',$talk_about_relation->getGather($talk_about_relationmap,'tid'));
		}
		
		//我喜欢的
		if($data['like']){
			$talk_about_like = D('Talk_about_like');
			$talk_about_likemap['uid'] = array('eq',$this->memberinfo['id']);
			$map['id'] = array('in',$talk_about_like->getGather($talk_about_likemap,'tid'));
		}
		
		return $map;
	}
	
	public function randomSys(){
		$circle = D('Circle');
		$lids = $circle->getGather('','lids');
		$lids_arr = explode(',', $lids);
		$lids_arr = array_unique($lids_arr);
		if(count($lids_arr) > 15){
			$arr = array_rand($lids_arr,15);
			foreach($arr as $val){
				$d[] = $lids_arr[$val];
			}
			$lids_arr = $d;
		}
		$label = D('Label');
		$labelmap['id'] = array('in',$lids_arr);
		$labeldata = $label->getData($labelmap);
		shuffle($labeldata);
		$this->assign('labeldata',$labeldata);
		$this->display();
	}
	
	public function randomLabel(){
		$circle = D('Circle');
		$lids = $circle->getGather('','lids');
		$lids_arr = explode(',', $lids);
		$lids_arr = array_unique($lids_arr);
		$label = D('Label');
		$labelmap['id'] = array('not in',$lids_arr);
		$labeldata = $label->getData($labelmap,15,'rand()');
		$this->assign('labeldata',$labeldata);
		$this->display();
	}
}
?>