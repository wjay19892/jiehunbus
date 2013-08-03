<?php
class BusinessAction extends CommonAction
{
	public function index(){
		$data = Init_GP(array('search_key','lid'));
		
		$member = D('Member');
		$memberarr=$member->select();
		var_dump($memberarr);
		//$this->display();
	
	
	}
}
?>