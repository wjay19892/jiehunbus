<?php
class NearbyAction extends CommonAction
{
	public function index(){
		//获得分类信息 和二级分类信息
		$goods_category = D('Goods_category');
		$goods_categorymap['level'] = array('eq',0);
		$goods_categorydata = $goods_category->getData($goods_categorymap);
		foreach ($goods_categorydata as &$value){
			$map['pid'] = array('eq',$value['id']);
			$value['child'] = $goods_category->getData($map);
			unset($map);
		}
		$this->assign('goods_categorydata',$goods_categorydata);
		$this->display();
	}
	
	public function ajaxNearby(){
		$goods = D('Goods');
		$locate = getCrrLatlng();
		$goods = D('Goods');
		
		if(isset($_REQUEST['sort'])){
			$sort = trim(Char_cv($_REQUEST['sort']));
		}
		if(!empty($sort)){
			$arr = explode(' ', $sort);
			$sc = array('asc','desc');
			if(in_array($arr[0], $fields)){
				if($arr[0] == 'price')$arr[0] = 'cast(`price` as DECIMAL)';
				if(in_array($arr[1], $sc)){
					$order = $arr[0].' '.$arr[1];
				}
			}
		}
		$map = $goods->_defaultWhere();
		
		if(isset($_REQUEST['category'])){
			$cid = intval($_REQUEST['category']);
			if($cid){
				$category = D('Goods_category');
				$category_map['id'] = array('in',"{$cid}");
				$categorydata = getFieldAll($category->getChild($category_map),'child');
				$cids = implode(',', $categorydata);
				$map['cid'] = array('in',"{$cids}");
			}
		}
		
		
		$count = $goods->where($map)->count();
		$limit = $this->page($count);
		if($sort){
			$nerbygoods = $goods->getDataAll($map,$limit,$sort);
		}else{
			$nerbygoods = $goods->getNearby($locate,$map,$limit);
		}
		$this->assign('nerbygoods',$nerbygoods);
		$result['html'] = $this->fetch('list');
		$result['page'] = $this->get('page');
		$this->success($result);
	}
	
	public function friend(){
		$this->display();
	}
	
	public function ajaxFriend(){
		$member = D('Member');
		$locate = getCrrLatlng();
		
		if(isset($_REQUEST['sort'])){
			$sort = trim(Char_cv($_REQUEST['sort']));
		}
		
		if(!empty($sort)){
			$arr = explode(' ', $sort);
			$sc = array('asc','desc');
			if(in_array($arr[0], $fields)){
				if($arr[0] == 'price')$arr[0] = 'cast(`price` as DECIMAL)';
				if(in_array($arr[1], $sc)){
					$order = $arr[0].' '.$arr[1];
				}
			}
		}
		
		if($_REQUEST['sex'] !== ''){
			$sex = intval($_REQUEST['sex']);
			$map['sex'] = array('eq',$sex);
		}

		$map = $member->_defaultWhere($map);
		$count = $member->getCount($map);
		$limit = $this->page($count);
		$nerbyfriend = $member->getNearby($locate,$map,$limit);
		$this->assign('nerbyfriend',$nerbyfriend);
		$result['html'] = $this->fetch('friendList');
		$result['page'] = $this->get('page');
		$this->success($result);
	}
}
?>