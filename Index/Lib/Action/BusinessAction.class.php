<?php
class BusinessAction extends CommonAction
{
	public function index(){
		$data = Init_GP(array('search_key','lid'));
		$txtsch = $data['search_key'];
		$member = D('Member');	
		$locate = getCrrLatlng();
		$map = $member->_defaultbusinessWhere($map);
		if(!empty($txtsch) && $txtsch != L('search_input_tip')){
    		$map = $member->_schdefaultbusinessWhere($map,$txtsch);
    	}
    	//共多少商家
		$count = $member->getCount($map);
		$nerbyfriend = $member->getBusiness($locate,$map,$limit);
        //var_dump($nerbyfriend[0]['business']['name']);
        //var_dump($nerbyfriend[0]['business']);
        $result['page'] = $this->get('page');
		$this->assign('nerbyfriend',$nerbyfriend);
		$this->assign('condition',json_encode($data));
		$this->display();		

	}

public function ajaxBusiness(){
		$data = Init_GP(array('search_key','lid'));
		$txtsch = $data['search_key'];
		$member = D('Member');	
		$locate = getCrrLatlng();
		$map = $member->_defaultbusinessWhere($map);
		if(!empty($txtsch) && $txtsch != L('search_input_tip')){
    		$map = $member->_schdefaultbusinessWhere($map,$txtsch);
    	}
    	//共多少商家
		$count = $member->getCount($map);
		$nerbyfriend = $member->getBusiness($locate,$map,$limit);
        //var_dump($nerbyfriend[0]['business']['name']);
        //var_dump($nerbyfriend[0]['business']);
		$this->assign('nerbyfriend',$nerbyfriend);
		$this->assign('condition',json_encode($data));
		$result['page'] = $this->get('page');
		$this->success($result);
	}


}
?>