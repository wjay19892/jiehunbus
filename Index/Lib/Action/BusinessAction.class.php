<?php
class BusinessAction extends CommonAction
{
	public function index(){
		$data = Init_GP(array('search_key','lid'));
		
		$member = D('Member');	
		$locate = getCrrLatlng();
		$map = $member->_defaultbusinessWhere($map);
		//共多少商家
		$count = $member->getCount($map);
		$nerbyfriend = $member->getBusiness($locate,$map,$limit);


        //var_dump($nerbyfriend[0]['business']['name']);
        //var_dump($nerbyfriend[0]['business']);
		$this->assign('nerbyfriend',$nerbyfriend);
		$this->display();		

	}
}
?>