<?php
class GoodsAction extends CommonAction {  
	// 获取配置类型
	public function _before_add() {
		$model = D("Goods_category");
		$list =	$model->order('`path` asc')->select();
		$region	= D("Region");
		$regionlist	= $region->order('`path` asc')->select();
		$expand_group =	D("Expand_group");
		$expand_groupList =	$expand_group->where('status=1')->select();
		
		$release = D('Release');
		$releaseid = intval($_REQUEST['release']);
		if($releaseid){
		  $releasedata = $release->find($releaseid);
		  $this->assign('releasedata',$releasedata);
		}
		//$location = IP();
		//$this->assign('location',$location);
		$this->assign('expand_groupList',$expand_groupList);
		$this->assign('list',$list);
		$this->assign('region',$regionlist);
	}
	
	public function _filter(&$map){
		if(empty($map['audit'])){
			$map['audit'] = array('eq',0);
		}
	}
	
	function insert() {
		//B('FilterString');
		$data = $_POST;
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
		
		$name=$this->getActionName();
		$model = D ($name);
		if (false === ($medata = $model->create ($medata))) {
			$this->error ( $model->getError () );
		}
		//保存当前数据对象
		$list=$model->add ($medata);
		
		if ($list!==false) { //保存成功
		    MakeGoodMap($list);
		    $goods_expand = D ('Goods_expand');
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
			$accessory_relation = D('Accessory_relation');
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
			$module = $_REQUEST['navTabId'];
			if(empty($module)){
				$module = $name;
			}
			$this->assign ( 'jumpUrl', U($module.'/index'));
			$this->success ('新增成功!');
		} else {
			//失败提示
			$this->error ('新增失败!');
		}
	}
	
	
	public function _before_edit() {
		$model	=	D("Goods_category");
		$list	=	$model->order('`path` asc')->select();
		$region	=	D("Region");
		$regionlist	=	$region->order('`path` asc')->select();
		
		$expand_group =	D("Expand_group");
		$expand_groupList =	$expand_group->where('status=1')->select();
		
		$egid = getParent('Goods',$_REQUEST['id'],'egid');
		$expand_groupdata =	$expand_group->find($egid);
		$map['id'] =array('in',$expand_groupdata['expand_ids']);
		$expand	=	D("Expand");
		$expandlist=$expand->getdata($map,$_REQUEST['id']);
		foreach($expandlist as &$v)
		{
			if(!empty($v['enum']))$v['enum'] = explode(",",$v['enum']);
			if($v['type']==4)$v['val'] = explode(",",$v['val']);
		}
		$accessory_relation = D('Accessory_relation');
		$imgmap['AR.relationid'] = $_REQUEST['id'];
		$imgmap['AR.table'] = 'Goods';
		$ardata = $accessory_relation->getData($imgmap);
		
		$this->assign('ardata',$ardata);
		$this->assign('expand_groupList',$expand_groupList);
		$this->assign('expand',$expandlist);
		$this->assign('list',$list);
		$this->assign('region',$regionlist);
	}
	
	function update() {
		//B('FilterString');
		$data = $_POST;
		
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
		
		$name=$this->getActionName();
		$model = D ( $name );
		if (false === $model->create ($medata)) {
			$this->error ( $model->getError () );
		}
		// 更新数据
		$list=$model->save ($medata);
		if (false !== $list) {
			//成功提示
			MakeGoodMap($data['id'],array(),true);
			$goods_expand = D ('Goods_expand');
			$expand_group =	D("Expand_group");
			$expand_groupdata =	$expand_group->find($data['egid']);
		    $delmap['id'] =array('notin',$expand_groupdata['expand_ids']);
			$delmap['gid'] =array('notin',$medata['id']);
			$tip =$goods_expand->where($delmap)->delete();
			
			foreach($me_atdata as $k=>$value){
			    $where = 'aid='.$k.' and gid='.$medata['id'];
				$matarray = $goods_expand->where($where)->find();
				$metadata = array(
					'gid'=>$medata['id'],
					'aid'=>$k,
					'val'=>$value
				);
				$metadata = $goods_expand->create($metadata);
				if(empty($matarray)){
					$result=$goods_expand->add($metadata);
				}else{
					$result=$goods_expand->where($where)->save($metadata);
				}
				unset ($where, $matarray, $metadata, $result);
			}
			
			$accessory_relation = D('Accessory_relation');
			$map = array(
				'relationid'=>$medata['id'],
				'table'=>'Goods',
			);
			
			$accessory_relation->where($map)->delete();
			foreach($img_data as $vo){
				$vo = GetNum($vo);
				if($vo){
					$ardata = array(
						'accessoryid'=>$vo,
						'relationid'=>$medata['id'],
						'table'=>'Goods',
					);
					$ardata = $accessory_relation->create($ardata);
					$accessory_relation->add($ardata);
					unset ($ardata);
				}
			}
			
			$module = $_REQUEST['navTabId'];
			if(empty($module)){
				$module = $name;
			}
			$this->assign ( 'jumpUrl', U($module.'/index'));
			$this->success ('编辑成功!');
		} else {
			//错误提示
			$this->error ('编辑失败!');
		}
	}
	
	public function batch(){
		$this->display();
	}
	
    public function doBatch(){
	    $id = intval($_REQUEST['id']);  //如果提交商品ID
		$name=$this->getActionName();
		$model = D ( $name );
	    if($id==0){
	    	$res = $model->where('status=1')->order("id asc")->limit(1)->find();  //查出第一个   	
	    }else {
	    	$res = $model->where("status=1 and id>".$id)->order("id asc")->limit(1)->find();  //查出第二个
	    }
		if($res){
		    $info = MakeGoodMap(0,$res,true);
		    if($info){
		    		$result['html'] = $info."<br />";
		    		$result['id'] = intval($res['id']);
		    }else {
		    		$result['html'] = "";
		    		$result['id'] = intval($res['id']);
		    }	
		}else {
			$result['html'] = '';
			$result['id'] = 0;
		}
	    echo json_encode($result);
	}
	
	public function expand(){
	    $id = intval($_REQUEST['id']);
		$gid = intval($_REQUEST['gid']);
		
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

		}else{
			$expandlist=$expand->getdata($map,$gid);
			foreach($expandlist as &$v)
			{
				if(!empty($v['enum']))$v['enum'] = explode(",",$v['enum']);
				if($v['type']==4)$v['val'] = explode(",",$v['val']);
			}
		}
		$this->assign('expand',$expandlist);
		$this->display();
	}
	
	public function clearList(){
		$cid = intval($_REQUEST['cid']);
		if($cid){
			$name=$this->getActionName();
			$model = D($name);
			$modelmap['cid'] = array('eq',$cid);
			$info = $model->where($modelmap)->delete();
			if($info){
				$this->success('清空成功');
			}else{
				$this->error('清空失败');
			}
		}else{
			$this->error('清空失败');
		}
	}
	
}
?>