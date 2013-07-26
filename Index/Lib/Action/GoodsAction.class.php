<?php
class GoodsAction extends CommonAction
{
	public function _initialize(){
		parent::_initialize();
		import('@.ORG.Lately');
	}
    public function index()
    {
    	//获取查询条件
    	$data = Init_GP(array('id'));
    	$id = GetNum($data['id']);
    	$goods = D('Goods');
		$goodsdata = $goods->getOne($id);
    	if(empty($goodsdata) || $goodsdata['status'] != 1 || $goodsdata['audit'] != 0){
    		$this->error(L('goods_not_exist'));
    	}
    	$evaluate_data = $goods->getEvaluate($id);
    	//获取同类产品 类型一样的10个
    	$goods_category = D('Goods_category');
    	$category_arr = $goods_category->getChild($goodsdata['cid']);
    	$category_ids = $category_arr[0]['child']; 	
    	$similarmap = array(
    		'cid'=>array('in',$category_ids),
    		'id'=>array('neq',$id),
    		'status'=>array('eq',1),
    		'audit'=>array('eq',0)
    	);
    	$similar = $goods->getDataAll($similarmap,'0,10');
    	
    	//如果用户存在 获取用户的收藏和举报
    	if(!empty($this->memberinfo)){
	    	$complaint = D('Complaint');
	    	$complaintmap = array(
	    		'uid'=>array('eq',$this->memberinfo['id']),
	    		'gid'=>array('eq',$id),
	    	);
	    	$isComplaint = $complaint->isExist($complaintmap);
	    	$collection = D('Collection');
	    	$collectionmap = array(
	    		'uid'=>array('eq',$this->memberinfo['id']),
	    		'gid'=>array('eq',$id),
	    	);
	    	$isCollection = $collection->isExist($collectionmap);
    	}else{
			$isComplaint = false;
			$isCollection = false;
		}
    	
    	$attachment = D('Attachment');
		$member_expand = $attachment->getExpand($goodsdata['promulgator']['id']);
		
		$refname=$goodsdata['title'];
		$ref_urllink = HOST.U('Goods/index?id='.$id);
		$ref_name = urlencode($refname);
		$ref_pic = HOST.$goodsdata['accessory'][0]['path'];
		$this->assign('ref_urllink',$ref_urllink);
		$this->assign('ref_name',$ref_name);
		$this->assign('ref_pic',$ref_pic);
		$this->assign('member_expand',$member_expand);
    	$this->assign('title',$goodsdata['title']);
    	$this->assign('keywords',$goodsdata['keywords']);
    	$this->assign('description',$goodsdata['description']);
    	$this->assign('isComplaint',$isComplaint);
    	$this->assign('isCollection',$isCollection);
    	$this->assign('similar',$similar);
    	$this->assign('evaluate_data',$evaluate_data);
    	$this->assign('data',$goodsdata);
    	$locate = getCrrLatlng();
    	Lately::addVal($id);
		$this->display();
    }
    
    public function view(){
    	/*if(!$_SESSION [C ( 'USER_AUTH_KEY' )]){
	    	if(empty($this->memberinfo)){
	    		$this->redirect('User/signin');
	    	}
    	}*/
    	
    	$id = intval($_REQUEST['id']);
		$goods = D('Goods');
    	if($id){
	    	$data = $goods->getOne($id);
			if(empty($data)){
				$this->error(L('goods_not_exist'));
			}
			/*if($data['promulgator']['id'] != $this->memberinfo['id']){
				$this->error(L('operational_error'));
			}*/
    	}else{
    	
	    	$data = Init_GP(array('title','short_title','cid','category_name','rid','region_name','original','payment','price','num','onenum','pre','starttime','endtime','tel','address','longitude','latitude','zoom','keywords','description','egid'));
	    	$data['detail'] = h($_POST['detail']);
	    	$data['cid'] = intval($data['cid']);
	    	if(!empty($data['cid'])){
	    		$goods_category = D('Goods_category');
	    		$goods_categorydata = $goods_category->getOne($data['cid']);
	    		if(!empty($goods_categorydata)){
	    			$data['category_name'] = $goods_categorydata['name'];
	    		}else{
	    			$data['category_name'] = '';
	    		}
	    	}else{
	    		$data['category_name'] = '';
	    	}
	    	if(!empty($data['rid'])){
	    		$region = D('Region');
	    		$regiondata = $region->getOne($data['cid']);
	    		if(!empty($regiondata)){
	    			$data['region_name'] = $regiondata['name'];
	    		}else{
	    			$data['region_name'] = '';
	    		}
	    	}else{
	    		$data['region_name'] = '';
	    	}
	    	
	    	$data['promulgator'] = $this->memberinfo;
	    	$accessory = D('Accessory');
	    	if(!empty($_REQUEST['imgs'])){
	    		foreach ($_REQUEST['imgs'] as $val){
	    			$val = intval($val);
	    			if(!empty($val)){
	    				$accessorydata = $accessory->getOne($val);
	    				$data['accessory'][] = $accessorydata;
	    			}
	    		}
	    	}
	    	
	    	$post_data = $_POST;
	    	$upload_list = $accessory->imgUpload(0,"goods");
	    	if($upload_list){
	    		foreach($upload_list as $upload_item){
	    			$post_data[$upload_item['key']] = $upload_item['recpath'].$upload_item['savename'];
	    		}
	    	}
	    	$expand = D('Expand');
	    	foreach($post_data as $k=>$value){//分离数据
	    		if(is_array($value))$value= implode(",",$value);
	    		if(intval($k)){
	    			$expanddata = $expand->getOne($k);
	    			if(!empty($expanddata)){
	    				$expanddata['val'] = $value;
	    			}
	    			$data['expand'][]=$expanddata;
	    		}
	    	}
    	}
    	
    	$evaluate_data = $goods->getEvaluate(0);
    	
    	$goods_category = D('Goods_category');
    	$category_arr = $goods_category->getChild($goodsdata['cid']);
    	$category_ids = $category_arr[0]['child'];
    	$similarmap = array(
    			'cid'=>array('in',$category_ids),
    			'id'=>array('neq',$id)
    	);
    	$similar = $goods->getDataAll($similarmap,'0,10');
    	
    	$attachment = D('Attachment');
    	$member_expand = $attachment->getExpand($this->memberinfo['id']);
    	
    	
    	$this->assign('member_expand',$member_expand);
    	$this->assign('title',$data['title']);
    	$this->assign('keywords',$data['keywords']);
    	$this->assign('description',$data['description']);
    	$this->assign('similar',$similar);
    	$this->assign('evaluate_data',$evaluate_data);
    	$this->assign('data',$data);
    	$this->display();
    }
    
    //购买
 	public function buy(){
 		$data = Init_GP(array('id'));
 		$id = intval($data['id']);
 		$goods = D('Goods');
 		$map = array(
 			'id'=>array('eq',$id),
 			'status'=>array('eq',1),
 			'audit'=>array('eq',0),
 		);
 		$goodsdata = $goods->getOne($id);
 		if(!empty($goodsdata)){
 			$sy = $goodsdata['num'] - $goodsdata['crrnum'];
 			$shop = ShoppingCart::getOne($id);
 			$restriction = $goodsdata['onenum'] - $goods->getUserQuantity($goodsdata['id'],$this->memberinfo['id']);
 			if($restriction < 0)$restriction =0;
 			if($sy <= 0 && $goodsdata['num'] != 0){
 				ShoppingCart::delOne($id);
 				$this->error(L('goods_inadequate_wait'));
 			}elseif($shop['num'] >= $restriction && !empty($goodsdata['onenum'])){
    			$num = $restriction;
    		}elseif($shop['num'] >= $sy && $goodsdata['num'] != 0){
    			$num = $sy;
    		}
    		
    		if($num){
    			$data['num'] = $num;
    			ShoppingCart::editVal($id, $data);
    		}elseif($num === 0){
    			$this->error(L('goods_purchase_limit')."{$goodsdata['onenum']}");
    		}elseif($num === null){
    			ShoppingCart::addVal($id);
    		}
 		}else{
 			$this->error(L('goods_not_exist'));
 		}
 		if($this->isAjax()){
 			$this->success(L('success_add_shoppingcart'));
 		}else{
 			$this->redirect('Goods/shoppingCart');
 		}
    }
    
    public function shoppingCart(){
    	$cartdata = ShoppingCart::getVal();
 		foreach ($cartdata as $value){
 			$ids[] = $value['id'];
 			$nums[$value['id']] = $value['num'];
 		}
 		$goods = D('Goods');
 		$goodsmap['id'] = array('in',$ids);
 		$goodsdata = $goods->getDataAll($goodsmap);
 		
 		$lately = Lately::getVal();
 		$latelymap['id'] = array('in',$lately);
 		$latelydata = $goods->getDataAll($latelymap);
 		$this->assign('nums',$nums);
 		$this->assign('goodsdata',$goodsdata);
 		$this->assign('latelydata',$latelydata);
 		$this->display();
    }
    
    public function updateNum(){
    	$data = Init_GP(array('id','num'));
    	$val = array(
    		'id' => intval($data['id']),
    		'num' => intval($data['num']),
    	);
    	if(!empty($val['id'])){
    		$goods = D('Goods');
    		$goodsdata = $goods->getOne($val['id']);
    		$sy = $goodsdata['num'] - $goodsdata['crrnum'];
    		$restriction = $goodsdata['onenum'] - $goods->getUserQuantity($goodsdata['id'],$this->memberinfo['id']);
    		if($restriction < 0)$restriction =0;
    		if($sy <= 0 && $goodsdata['num'] != 0){
    			$val['num'] = 0;
    			$result['msg'] = L('goods_inadequate_del');
    			$result['num'] = 0;
    		}elseif($val['num'] > $restriction && !empty($goodsdata['onenum'])){
    			$val['num'] = $restriction;
    			$result['msg'] = L('goods_purchase_limit_tip')."{$val['num']}";
    			$result['num'] = $val['num'];
    		}elseif($val['num'] > $sy && $goodsdata['num'] != 0){
    			$val['num'] = $sy;
    			$result['msg'] = L('goods_purchase_limit_tip')."{$val['num']}";
    			$result['num'] = $val['num'];
    		}
	    	if($val['num'] <= 0){
	    		ShoppingCart::delOne($val['id']);
	    	}else{
	    		ShoppingCart::editVal($val['id'], $val);
	    	}
	    	$this->success($result);
    	}else{
    		$this->error(L('operational_error'));
    	}
    }

	public function shoppingCartDel(){
		$ids = Char_cv($_REQUEST['ids']);
        foreach($ids as $id){
            ShoppingCart::delOne($id);
        }
        $this->success(L('operational_success'));
	}
    
    public function release(){
    	$data = Init_GP(array('id'));
    	$id = intval($data['id']);
    	
    	if(!C('sysconfig.release_open')){
    		$this->error(L('operational_error'));
    	}
    	if(empty($this->memberinfo)){
    		$this->redirect('User/signin');
    	}

		$this->_check_business();
    	
    	$expand_group =	D("Expand_group");
    	$expand_groupList =	$expand_group->where('status=1')->select();
    	
    	if(!empty($id)){
    		$goods = D('Goods');
    		$goodsdata = $goods->getOne($id);
    		if($goodsdata['audit'] == 0){
    			$this->error(L('operational_error'));
    		}
    		$expand = $goodsdata['expand'];
    		foreach($expand as &$v)
    		{
    			if(!empty($v['enum']))$v['enum'] = explode(",",$v['enum']);
    			if($v['type']==4)$v['val'] = explode(",",$v['val']);
    		}
    		$this->assign('expand',$expand);
    		$this->assign('goodsdata',$goodsdata);
    	}
    	$this->assign('expand_groupList',$expand_groupList);
    	$this->display();
    }
    
    public function expand(){
    	$id = intval($_REQUEST['id']);
    	if($id){
    		$expand_group =	D("Expand_group");
    		$expand_groupdata =	$expand_group->find($id);
    		$map['id'] =array('in',$expand_groupdata['expand_ids']);
    		$expand	=	D("Expand");
    		if(empty($gid)){
    			$expandlist	=	$expand->where($map)->select();
    			foreach($expandlist as &$v)
    			{
    				if(!empty($v['enum']))$v['enum'] = explode(",",$v['enum']);
    			}
    		
    		}
    		$this->assign('expand',$expandlist);
    		$data = $this->fetch();
    		$this->success($data);
    	}else{
    		$this->error(L('operational_error'));
    	}
    }
    
    public function getCategory(){
    	
    }
    
    public function doRelease(){
    	if(!C('sysconfig.release_open')){
    		$this->error(L('operational_error'));
    	}
    	if(empty($this->memberinfo)){
    		$this->error(L('not_logged'));
    	}
		$this->_check_business();
    	$model = D ('Goods');
    	$data = $_POST;
    	if(empty($data['tos_confirm'])){
    		$this->error(L('please_agree_terms_use'));
    	}
    	$id = intval($data['id']);
    	if($id){
    		$goodsmap['id'] = array('eq',$id);
    		$goodsdata = $model->where($goodsmap)->find();
    		if($goodsdata['audit'] == 0){
    			$this->error(L('goods_dorelease_audit'));
    		}
    		if($goodsdata['promulgator'] != $this->memberinfo['id']){
    			$this->error(L('operational_error'));
    		}
    	}
    	
    	$accessory = D('Accessory');
    	$upload_list = $accessory->imgUpload(0,"goods");
    	if($upload_list){
    		foreach($upload_list as $upload_item){
    			$data[$upload_item['key']] = $upload_item['recpath'].$upload_item['savename'];
    		}
    	}
    	
    	$medata=array();//主表数据
    	$me_atdata=array();//扩展数据
    	$img_data = $data['imgs']; //图片数据
    	
    	foreach($data as $k=>$value){//分离数据
    		if(is_array($value))$value= implode(",",$value);
    		if(intval($k)){
    			$me_atdata[$k]=$value;
    		}else{
    			$medata[$k]=$value;
    		}
    	}
    	
    	
    	if (false === ($medata = $model->create ($medata))) {
    		$this->error ( $model->getError () );
    	}
    	if(C('sysconfig.release_audit') == 1){
    		$medata['audit'] = 1;
    	}
    	if($id){
    		$list=$model->save($medata);
    	}else{
    		$medata['status'] = 1;
    		$medata['promulgator'] = $this->memberinfo['id'];
    		//保存当前数据对象
    		$list=$model->add ($medata);
    	}
    	if ($list!==false) { //保存成功
    		$goods_expand = D ('Goods_expand');
    		$accessory_relation = D('Accessory_relation');
    		if($id){
    			$list = $id;
    			$goods_expandmap['gid'] = array('eq',$list);
    			$goods_expand->where($goods_expandmap)->delete();
    			$accessory_relationmap = array(
    					'relationid'=>array('eq',$list),
    					'table'=>array('eq','Goods'),
    					);
    			$accessory_relation->where($accessory_relationmap)->delete();
    		}
    		MakeGoodMap($list);
    		
    		foreach($me_atdata as $k=>$value){
    			$metadata = array(
    					'gid'=>$list,
    					'aid'=>$k,
    					'val'=>$value
    			);
    			$metadata = $goods_expand->create($metadata);
    			$result=$goods_expand->add($metadata);
    			unset ($metadata, $result);
    		}
    		
    		foreach($img_data as $vo){
    			$vo = GetNum($vo);
    			if($vo){
    				$ardata = array(
    						'accessoryid'=>$vo,
    						'relationid'=>$list,
    						'table'=>'Goods',
    				);
    				$ardata = $accessory_relation->create($ardata);
    				$accessory_relation->add($ardata);
    				unset ($ardata);
    			}
    		}
    		$this->success (L('goods_dorelease_success'));
    	} else {
    		//失败提示
    		$this->error (L('release_error'));
    	}
    }
    
}
?>